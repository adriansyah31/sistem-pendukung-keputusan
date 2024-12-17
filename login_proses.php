<?php

require __DIR__ . '/config/connect.php';
require __DIR__ . '/config/session.php';
require __DIR__ . '/config/form.php';
require __DIR__ . '/vendor/autoload.php';

use Models\User;

// ngambil data database user
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = input_form($_POST['username'] ?? null);
    $password = input_form($_POST['password'] ?? null);

    $userModel = new User($pdo);
    $item = $userModel->find($username, $password);

    if ($item !== null) {
        if ($item['level'] == "1"){
            $_SESSION['is_login'] = 1;
            $_SESSION['nama'] = $item['nama'];
            $_SESSION['level'] = $item["level"];
            header('location: halaman_admin.php');
        }elseif ($item['level'] == "0"){
            $_SESSION['is_login'] = 1;
            $_SESSION['nama'] = $item['nama'];
            $_SESSION['level'] = $item["level"];
            header('location: halaman_pengguna.php');
        }
    }else {
        $_SESSION['type'] = 'danger';
        $_SESSION['message'] = 'Data Tidak Ditemukan';
        header('location: index.php');
    }

    die();
}

$_SESSION['type'] = 'danger';
$_SESSION['message'] = 'Terjadi Kesalahan Proses Data';

header('location: index.php');
die();