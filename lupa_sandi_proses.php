<?php

require __DIR__ . '/config/connect.php';
require __DIR__ . '/config/session.php';
require __DIR__ . '/config/form.php';
require __DIR__ . '/vendor/autoload.php';

use Models\User;

// proses tambah user 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $telpon = input_form($_POST['telpon'] ?? null);
    $password = input_form($_POST['password'] ?? null);

    $kriteriaModel = new User($pdo);
    $item = $kriteriaModel->forget([
        'telpon' => $telpon,
        'password' => $password
    ]);
    
    switch ($item) {
        case 'success':
            
            $_SESSION['type'] = 'success';
            $_SESSION['message'] = 'Password Berhasil Diubah';

            header('location: lupa_sandi.php');
            die();
            break;
        case 'fail':
            $_SESSION['type'] = 'danger';
            $_SESSION['message'] = 'Nomor Telepon Tidak Terdaftar';
            break;
        case 'validation':
            $_SESSION['type'] = 'danger';
            $_SESSION['message'] = 'Semua bidang isian wajib diisi';
            break;
    }

    header('location: lupa_sandi.php');
    die();
}

$_SESSION['type'] = 'danger';
$_SESSION['message'] = 'Terjadi Kesalahan Proses Data';

header('location: registrasi.php');
die();