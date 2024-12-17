<?php

require __DIR__ . '/config/connect.php';
require __DIR__ . '/config/session.php';
require __DIR__ . '/config/form.php';
require __DIR__ . '/vendor/autoload.php';

use Models\User;

// proses tambah user 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = input_form($_POST['nama'] ?? null);
    $username = input_form($_POST['username'] ?? null);
    $password = input_form($_POST['password'] ?? null);
    $telpon = input_form($_POST['telpon'] ?? null);
    $alamat = input_form($_POST['alamat'] ?? null);
    $level = input_form($_POST['level'] ?? null);

    $kriteriaModel = new User($pdo);
    $item = $kriteriaModel->create([
        'nama' => $nama,
        'username' => $username,
        'password' => $password,
        'telpon' => $telpon,
        'alamat' => $alamat,
        'level' => "0"
    ]);

    if (strlen($nama) < 1) {
        $namaerror = "Nama Wajib Di Isi";
    } else {
        $namavalid = $nama;
    }

    switch ($item) {
        case 'success':
            
            $_SESSION['type'] = 'success';
            $_SESSION['message'] = 'Data Berhasil Ditambah';

            header('location: registrasi.php');
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

    header('location: registrasi.php');
    die();
}

$_SESSION['type'] = 'danger';
$_SESSION['message'] = 'Terjadi Kesalahan Proses Data';

header('location: registrasi.php');
die();