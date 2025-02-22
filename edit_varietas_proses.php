<?php

require __DIR__ . '/config/connect.php';
require __DIR__ . '/config/session.php';
require __DIR__ . '/config/form.php';
require __DIR__ . '/vendor/autoload.php';

use Models\Varietas;

$id = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = input_form($_POST['id'] ?? null);
    $nama = input_form($_POST['nama'] ?? null);
    $wilayah_id = input_form($_POST['wilayah_id'] ?? null);
    $kriteria = $_POST['kriteria'] ?? null;

    $varietasModel = new Varietas($pdo);
    $item = $varietasModel->find($id);

    $itemUpdated = $varietasModel->update([
        'nama' => $nama,
        'wilayah_id' => $wilayah_id,
        'id' => $id,
        'kriteria' => $kriteria,
    ]);

    switch ($itemUpdated) {
        case 'success':
            $_SESSION['type'] = 'success';
            $_SESSION['message'] = 'Data Berhasil Diedit';
            header('location: varietas.php');
            die();
            break;
        case 'fail':
            $_SESSION['type'] = 'danger';
            $_SESSION['message'] = 'Data Gagal Diedit';
            break;
        case 'validation':
            $_SESSION['type'] = 'danger';
            $_SESSION['message'] = 'Semua bidang isian wajib diisi';
            break;
    }

    header('location: edit_pemohon.php?id=' . $id);
    die();
}

$_SESSION['type'] = 'danger';
$_SESSION['message'] = 'Terjadi Kesalahan Proses Data';

header('location: edit_pemohon.php?id=' . $id);
die();