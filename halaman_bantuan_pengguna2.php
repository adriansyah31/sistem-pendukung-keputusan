<?php

require __DIR__ . '/config/connect.php';
require __DIR__ . '/config/session.php';
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/middleware/hasAuth.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="dist/img/logo_sistem.png" alt="AdminLTELogo" height="150" width="200">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a class="brand-link">
                <img src="dist/img/logo1.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Varietas Unggul</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/user.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $_SESSION['nama'] ?? '-' ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="halaman_pengguna.php" class="nav-link ">
                                <p> Dashboard </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="varietas.php" class="nav-link active">
                                <p> Data Varietas </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="hasil.php" class="nav-link">
                                <p>Hasil Rekomendasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">
                                <p>Keluar</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="section-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <h3 class="mb-3">
                                        <b>Bantuan</b>
                                    </h3>
                                </div>
                                <div class="text-justify">
                                    <b>Halaman Data Varietas</b>
                                    <p><b>1.</b> Pada halaman ini pengguna dapat mengakses setiap fungsi yang tersedia pada sistem seperti menambahkan, mengubah serta menghapus data varietas kelapa sawit.
                                    <br><b>2.</b> Pada saat menambah atau mengubah data, pengguna diharapkan untuk memastikan informasi yang telah diperoleh mencangkup karakteristik varietas kelapa sawit, berupa Potensi TBS, Potensi CPO, Rendemen Minyak, Umur Mulai Panen dan Adaptasi Pada Daerah Marjinal sebagai kriteria yang telah ditentukan pada sistem.
                                    <br><b>3.</b> Menghapus data varietas kelapa sawit, apabila terdapat data varietas kelapa sawit yang tidak ingin dijadikan sebagai bahan perbandingan untuk data varietas kelapa sawit lainnya.</p>   
                                    <div class="text-center">
                                        <div class="img-logo mb-5">
                                            <img src="<?php echo 'dist/img/fitur_pengguna.png' ?>" height="200" width="900">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        <footer class="main-footer">
            <strong>Sistem Pendukung Keputusan</strong>
            SIMPLE ADDITIVE WEIGHTING.
            <div class="float-right d-none d-sm-inline-block">
            <b>Varietas Unggul</b>
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
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