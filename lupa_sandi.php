<?php

require __DIR__ . '/config/connect.php';
require __DIR__ . '/config/session.php';
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/middleware/checkAuth.php';

ob_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Lupa Kata Sandi</title>
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
    <!-- /.login-logo --> 
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Form Lupa Kata Sandi</p>

                <?php require_once __DIR__ . '/components/flash.php' ?>

                <form action="lupa_sandi_proses.php" method="post">
                    <div class="form-group mb-3">
                        <input type="text" name="telpon" class="form-control" placeholder="Nomor Telepon" maxlength="12" onkeypress="return hanyaAngka(event)" required>
                        <script>
                            function hanyaAngka(evt){
                                var charCode = (evt.which) ? evt.which : event.keyCode
                                if (charCode > 31 && (charCode < 48 || charCode >57))

                                return false;
                                return true;
                            }
                        </script>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control" placeholder="Kata Sandi Baru" name="password" required>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-block">Ubah</button>
                    </div>

                    <div class="separator">
                        <span class="separator-in">Atau</span>
                    </div>

                    <div class="text-center">
                        <p>Sudah Mengingat Kata Sandi ? <br><a href="index.php" >Masuk</a></p>
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