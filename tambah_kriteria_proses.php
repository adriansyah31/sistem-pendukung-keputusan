<?php

require __DIR__ . '/config/connect.php';
require __DIR__ . '/config/session.php';
require __DIR__ . '/config/form.php';
require __DIR__ . '/vendor/autoload.php';

use Models\Kriteria;

// proses tambah kriteria 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = input_form($_POST['nama'] ?? null);
    $bobot = input_form($_POST['bobot'] ?? null);
    $status = input_form($_POST['status'] ?? null);
    $sub = input_form($_POST['sub'] ?? null);

    $kriteriaModel = new Kriteria($pdo);
    $item = $kriteriaModel->create([
        'nama' => $nama,
        'bobot' => "0",
        'status' => $status,
        'sub' => $sub
    ]);

    switch ($item) {
        case 'success':
            $itemLatest = $kriteriaModel->findLatest();

            if ($itemLatest !== null) {
                $kriteriaModel->updateBobotToNol($itemLatest['id']);
            }
            
            $_SESSION['type'] = 'success';
            $_SESSION['message'] = 'Data Berhasil Ditambah';

            header('location: kriteria.php');
            die();
            break;
        case 'fail':
            $_SESSION['type'] = 'danger';
            $_SESSION['message'] = 'Data Gagal Ditambah';
            break;
        case 'validation':
            $_SESSION['type'] = 'danger';
            $_SESSION['message'] = 'Semua bidang isian wajib diisi';
            break;
    }

    header('location: tambah_kriteria.php');
    die();
}

$_SESSION['type'] = 'danger';
$_SESSION['message'] = 'Terjadi Kesalahan Proses Data';

header('location: tambah_kriteria.php');
die();