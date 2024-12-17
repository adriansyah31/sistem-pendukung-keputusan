<?php

require __DIR__ . '/config/connect.php';
require __DIR__ . '/config/session.php';
require __DIR__ . '/config/form.php';
require __DIR__ . '/vendor/autoload.php';

use Models\Hasil;

$wilayah_id = input_form($_GET['id'] ?? null);

if ($wilayah_id !== "") {
    $hasilModel = new Hasil($pdo);
    $hasilModel->delete($wilayah_id);
}

$_SESSION['type'] = 'success';
$_SESSION['message'] = 'Data Berhasil Dihapus';

header('location: hasil_perhitungan.php?id=' . $wilayah_id);
die();