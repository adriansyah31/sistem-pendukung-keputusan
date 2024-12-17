<?php

require __DIR__ . '/config/connect.php';
require __DIR__ . '/config/session.php';
require __DIR__ . '/vendor/autoload.php';

ob_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Varietas Unggul Kelapa Sawit</title>
<style type="text/css">

body {
background: url(dist/img/kelapa_sawit.png) no-repeat fixed;
   -webkit-background-size: 100% 100%;
   -moz-background-size: 100% 100%;
   -o-background-size: 100% 100%;
   background-size: 100% 100%;
}

</style>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <style>
        .separator {
            position: relative;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .separator:before {
            background: #ddd;
            content: "";
            display: block;
            height: 1px;
            position: absolute;
            top: 50%;
            width: 100%;
            z-index: 0;
        }
        .separator-in {
            line-height: 1.4;
            background: #fff;
            color: #bbb;
            padding: 0 1em;
            position: relative;
        }
    </style>
    
</head>
<body class="hold-transition login-page">
    <div class="login-logo">
       <strong><b>Sistem Pendukung Keputusan<br>Pemilihan Varietas Unggul Kelapa Sawit</b></strong>
    </div> 
    <!-- /.login-logo --> 
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Diharapkan Mengisi Nama Pengguna beserta Kata sandi </p>

                <?php require_once __DIR__ . '/components/flash.php' ?>

                <form action="login_proses.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nama Pengguna" name="username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Kata Sandi" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-right">
                        <p><a href="lupa_sandi.php">Lupa Akun ?</a></p>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                    </div>

                    <div class="separator">
                        <span class="separator-in">Atau</span>
                    </div>

                    <div class="text-center">
                        <p>Belum Memiliki Akun ? <br><a href="registrasi.php" >Daftar</a></p>

                        <!-- Modal -->
                        <div class="modal fade" id="modal-help" data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">BANTUAN</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Jika anda tidak masuk ke dalam sistem, harap hubungi Kepala Kantor Untuk mengkonfirmasi akun
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
</body>
</html>


<?php

$view = ob_get_clean();

reset_session_flash();

echo $view;

?>