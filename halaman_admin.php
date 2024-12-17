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
                            <a href="halaman_admin.php" class="nav-link active">
                                <p> Dashboard </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <p>Kriteria Varietas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="kriteria.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Kriteria</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="sub_kriteria.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Sub Kriteria</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="wilayah.php" class="nav-link ">
                                <p> Data Wilayah </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pengguna.php" class="nav-link">
                                <p>Data Pengguna</p>
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
                                    <div class="img-logo mb-5">
                                        <img src="<?php echo 'dist/img/kelapa_sawit_1.jpg' ?>" alt="">
                                    </div>
                                    <h3 class="mb-3">
                                        Sistem pendukung keputusan Pemilihan Varietas Unggul Kelapa Sawit Menggunakan Metode Simple Additive Weighting
                                    </h3>
                                    <p>“Kelapa sawit merupakan salah satu komoditas hasil perkebunan dengan peran penting dalam kegiatan perekonomian di Indonesia sebagai penghasil minyak nabati yang banyak dibutuhkan oleh sektor industri. Setiap jenis varietas kelapa sawit memiliki keunggulan yang berbeda-beda, agar dapat mencapai perkebunan yang berkelanjutan bahan tanam merupakan salah satu syarat yang mutlak untuk mencapai keberhasilan budidaya.”</p>
                                    <p>"Dengan demikian dibuatlah sebuah sistem yang dapat membantu pihak perkebunan dalam menentukan varietas kelapa sawit yang layak dijadikan sebagai bahan tanam untuk meningkatkan hasil produksi perkebunan menggunakan metode Simple Additive Weighting, dengan menggunakan 5 kriteria pilihan berdasarkan karakteristik dari varietas kelapa sawit. "    
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
