<?php

require __DIR__ . '/config/connect.php';
require __DIR__ . '/config/session.php';
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/form.php';
require __DIR__ . '/middleware/hasAuth.php';

use Models\Varietas;
use Models\Wilayah;
use Models\Kriteria;

$varietasModel = new Varietas($pdo);

$id = input_form($_GET['id'] ?? null);
$item = $varietasModel->find($id);

$itemBobot = $varietasModel->getBobot($id);
$itemBobot = array_reduce($itemBobot, function ($output, $carry) {
    $output[$carry['kriteria_id']] = $carry['sub_kriteria_id'];

    return $output;
}, []);

$wilayahModel = new wilayah($pdo);
$wilayahItems = $wilayahModel->index();

$kriteriaModel = new Kriteria($pdo);
$kriteriaItems = $kriteriaModel->getKriteriaAndSubKriteria();

if ($item === null) {
    $_SESSION['type'] = 'danger';
    $_SESSION['message'] = 'Data Tidak Ditemukan';

    header('location: varietas.php');
    die();
}

ob_start();

extract([
    'wilayahItems' => $wilayahItems
]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Varietas</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <style>
        .gambar-varietas {
            width: 250px;
            height: 200px;
            position: relative;
        }

        .gambar-varietas img {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="dist/img/logo_sistem.png" alt="AdminLTELogo" height="150" width="200">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light">
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
                    <div class="row mb-2">
                    <div class="col-sm-6"></div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="varietas.php">Data Varietas</a></li>
                            <li class="breadcrumb-item active">Ubah Data Varietas</li>
                        </ol>
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <?php require_once __DIR__ . '/components/flash.php' ?>

                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Varietas</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="edit_varietas_proses.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Varietas</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $item['nama'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Wilayah</label>
                                    <select name="wilayah_id" id="" class="form-control" required>
                                        <option value="">Pilih Wilayah</option>
                                        <?php foreach ($wilayahItems as $wilayahItem) { ?>
                                            <option value="<?php echo $wilayahItem['id'] ?>" <?php echo $wilayahItem['id'] == $item['wilayah_id'] ? 'selected' : null ?>><?php echo $wilayahItem['nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <hr>
                                <?php foreach ($kriteriaItems as $kriteriaItem) { ?>
                                    <div class="form-group">
                                        <label for=""><?php echo $kriteriaItem['nama'] ?></label>
                                        <?php if ($kriteriaItem['status_sub'] == 1) { ?>
                                            <select name="kriteria[<?php echo $kriteriaItem['id'] ?>]" id="" class="form-control" required>
                                                <option value=""><?php echo $kriteriaItem['nama'] ?></option>
                                                <?php foreach ($kriteriaItem['sub_kriteria'] as $sub_kriteria) { ?>
                                                    <option value="<?php echo $sub_kriteria['id'] ?>" <?php echo ($itemBobot[$kriteriaItem['id']] ?? 0) == $sub_kriteria['id'] ? 'selected' : null ?>><?php echo $sub_kriteria['nama'] ?></option>
                                                <?php } ?>
                                            </select>
                                        <?php } else { ?>
                                            <input type="number" name="kriteria[<?php echo $kriteriaItem['id'] ?>]" class="form-control" min="0" placeholder="<?php echo $kriteriaItem['nama'] ?>" value="<?php echo $itemBobot[$kriteriaItem['id']] ?? 0 ?>" required>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
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

<?php

$view = ob_get_clean();

reset_session_flash();

echo $view;

?>