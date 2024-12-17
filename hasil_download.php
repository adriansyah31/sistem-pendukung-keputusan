<?php

require __DIR__ . '/config/connect.php';
require __DIR__ . '/config/form.php';
require __DIR__ . '/vendor/autoload.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Models\Hasil;
use Models\Wilayah;
use Models\Kriteria;
use Models\Varietas;

// instantiate and use the dompdf class
$wilayah_id = input_form($_GET['id'] ?? null);

if ($wilayah_id !== "") {
    $dompdf = new Dompdf();
    $wilayahModel = new wilayah($pdo);
    $hasilModel = new Hasil($pdo);
    $varietasModel = new Varietas($pdo);
    $kriteriaModel = new Kriteria($pdo);

    $item = $wilayahModel->find($wilayah_id);
    $hasilItems = $hasilModel->index($wilayah_id);
    $bobotAlternatifItems = $varietasModel->getBobotIn(array_column($hasilItems, 'alternatif_id'));

    $hasilItems = array_map(function ($item) use ($bobotAlternatifItems) {
        $item['bobot'] = array_filter($bobotAlternatifItems, function ($bobot) use ($item) {
            return $item['alternatif_id'] == $bobot['alternatif_id'];
        });

        return $item;
    }, $hasilItems);

    $kriteriaItems = $kriteriaModel->index();

    ob_start();

    extract([
        'hasilItems' => $hasilItems,
        'item' => $item,
        'kriteriaItems' => $kriteriaItems
    ]);

    include 'hasil_download_template.php';

    $view = ob_get_clean();

    $dompdf->loadHtml($view);

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
} else {
    echo 'Terjadi Kesalahan Export PDF';
    die();
}