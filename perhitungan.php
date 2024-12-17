<?php

require __DIR__ . '/config/connect.php';
require __DIR__ . '/config/session.php';
require __DIR__ . '/config/form.php';
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/middleware/hasAuth.php';

use Models\Varietas;
use Models\Kriteria;
use Models\Hasil;

$wilayah_id = input_form($_POST['wilayah_id'] ?? null);

$status = false;
$resultDataView = '';

if ($wilayah_id !== "") {
    $hasilModel = new Hasil($pdo);
    $kriteriaModel = new Kriteria($pdo);
    $varietasModel = new Varietas($pdo);

    $kriteriaItems = $kriteriaModel->index();
    $varietasItems = $varietasModel->getAlternatifAndBobot($wilayah_id);

    // Perhitungan SAW

    // Hitung Total Bobot Kriteria
    $totalKriteriaBobot = array_reduce($kriteriaItems, function ($output, $carry) {
        $output += $carry['bobot'];

        return $output;
    }, 0);

    // Hitung Normalisasi Bobot Kriteria
    $kriteriaItems = array_map(function ($kriteria) use ($totalKriteriaBobot) {
        $kriteria['nilai_normalisasi'] = number_format($kriteria['bobot'] / $totalKriteriaBobot, 3);

        return $kriteria;
    }, $kriteriaItems);

    // Matrik Keputusan
    $kriteriaItems = array_map(function ($kriteria) use ($varietasItems) {
        $nilai_matrik = 0;

        if ($kriteria['status'] == 'benefit') {
            $nilai_matrik = max(
                array_map(function ($varietas) use ($kriteria) {
                    return $varietas['bobot'][$kriteria['id']]['nilai'] ?? 0;
                }, $varietasItems)
            );
        } else if ($kriteria['status'] == 'cost') {
            $nilai_matrik = min(
                array_map(function ($varietas) use ($kriteria) {
                    return $varietas['bobot'][$kriteria['id']]['nilai'] ?? 0;
                }, $varietasItems)
            );
        }

        $kriteria['nilai_matrik'] = $nilai_matrik;

        return $kriteria;
    }, $kriteriaItems);

    // Normalisasi Id Kriteria
    $kriteriaIdItems = [];

    foreach ($kriteriaItems as $kriteriaItem) {
        $kriteriaIdItems[$kriteriaItem['id']] = $kriteriaItem;
    }

    $kriteriaItems = $kriteriaIdItems;

    // Normalisasi Nilai Bobot dari Matrik Keputusan
    $varietasItems = array_map(function ($varietas) use ($kriteriaItems) {
        $bobotItems = array_map(function ($bobot) use ($kriteriaItems) {
            $nilai_normalisasi = 0;

            if ($kriteriaItems[$bobot['kriteria_id']]['status'] == 'benefit') {
                $bobot['nilai_normalisasi'] = $nilai_normalisasi = number_format($bobot['nilai'] / $kriteriaItems[$bobot['kriteria_id']]['nilai_matrik'], 3);   
            } else if ($kriteriaItems[$bobot['kriteria_id']]['status'] == 'cost') {
                $bobot['nilai_normalisasi'] = $nilai_normalisasi = number_format($kriteriaItems[$bobot['kriteria_id']]['nilai_matrik'] / $bobot['nilai'], 3);   
            }
    // Hitung Nilai Preferensi
            $bobot['nilai_hasil'] = number_format($nilai_normalisasi * $kriteriaItems[$bobot['kriteria_id']]['nilai_normalisasi'], 3);
            
            return $bobot;
        }, $varietas['bobot']);
    // hitung nilai total penambahan seluruh nilai kriteria
        $total = array_reduce($bobotItems, function ($output, $carry) {
            $output += $carry['nilai_hasil'];

            return $output;
        }, 0);

        $varietas['bobot'] = $bobotItems;
        $varietas['total'] = $total;

        return $varietas;
    }, $varietasItems);

    $varietasHasilItems = [];
    foreach ($varietasItems as $varietasItem) {
        $varietasHasilItems[$varietasItem['id']] = $varietasItem['total'];
    }	

    arsort($varietasHasilItems);

    $hasilModel->delete($wilayah_id);

    $no = 1;
    foreach ($varietasHasilItems as $varietasId => $varietasHasilItem) {

        $nilai = json_encode([
            'nilai_akhir' => number_format(input_form($varietasHasilItem), 3),
        ]);

        $hasilModel->create([
            'alternatif_id' => input_form($varietasId),
            'no' => input_form($no),
            'nilai' => $nilai,
            'wilayah_id' => $wilayah_id
        ]);

        $no++;
    }

    $hasilItems = $hasilModel->index($wilayah_id);
    $bobotAlternatifItems = $varietasModel->getBobotIn(array_column($hasilItems, 'alternatif_id'));

    $hasilItems = array_map(function ($item) use ($bobotAlternatifItems) {
        $item['bobot'] = array_filter($bobotAlternatifItems, function ($bobot) use ($item) {
            return $item['alternatif_id'] == $bobot['alternatif_id'];
        });

        return $item;
    }, $hasilItems);

    foreach ($hasilItems as $index => $hasilItem) {

        $nilai = json_decode($hasilItem['nilai'], true);
        $bobot = array_values($hasilItem['bobot']);

        $bobotKriteria = "";

        foreach ($kriteriaItems as $kriteriaItem) {
            $bobotKey = array_search($kriteriaItem['id'], array_column($bobot, 'kriteria_id'));
            $bobotKriteria .= '<td>' . ($bobotKey !== false ? $bobot[$bobotKey]['bobot'] : null) . '</td>';
        }

        $resultDataView .= '<tr>' . 
                                '<td>' . ($index + 1) . '</td>' . 
                                '<td>' . $hasilItem['nama'] . '</td>' .  
                                '<td>' . $hasilItem['no'] . '</td>' .
                                '<td>' . $nilai['nilai_akhir'] . '</td>' .
                                $bobotKriteria .
                            '</tr>';
    }

    $status = true;
}

echo json_encode([
    'status' => $status,
    'result_data_view' => $resultDataView,
]);