<?php

require __DIR__ . '/config/connect.php';
require __DIR__ . '/config/session.php';
require __DIR__ . '/config/form.php';
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/middleware/hasAuth.php';

use Models\Wilayah;
use Models\Hasil;
use Models\Kriteria;
use Models\Varietas;

//array map digunakan untuk mengolah setiap element di array/object dan kemudian menghasilkan array/object baru

$wilayahModel = new Wilayah($pdo);
$hasilModel = new Hasil($pdo);
$varietasModel = new Varietas($pdo);

$id = input_form($_GET['id'] ?? null);
$item = $wilayahModel->find($id);

$hasilItems = $hasilModel->index($id);
$bobotAlternatifItems = $varietasModel->getBobotIn(array_column($hasilItems, 'alternatif_id'));

$hasilItems = array_map(function ($item) use ($bobotAlternatifItems) {
    $item['bobot'] = array_filter($bobotAlternatifItems, function ($bobot) use ($item) {
        return $item['alternatif_id'] == $bobot['alternatif_id'];
    });

    return $item;
}, $hasilItems);

$kriteriaModel = new Kriteria($pdo);
$kriteriaItems = $kriteriaModel->index();

if ($item === null) {
    $_SESSION['type'] = 'danger';
    $_SESSION['message'] = 'Data Tidak Ditemukan';

    header('location: hasil.php');
    die();
}

ob_start();

extract([
    'hasilItems' => $hasilItems,
    'kriteriaItems' => $kriteriaItems
]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hasil Rekomendasi Wilayah</title>

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
                            <a href="varietas.php" class="nav-link ">
                                <p> Data Varietas </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="hasil.php" class="nav-link active">
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
                    <div class="col-sm-6">
                        <h1 class="m-0">Rekomendasi Wilayah <?php echo $item['nama'] ?></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="hasil.php">Wilayah Rekomendasi</a></li>
                            <li class="breadcrumb-item active">Hasil Rekomendasi</li>
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

                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" id="perhitungan" data-id="<?php echo $item['id'] ?>">Mulai Perhitungan</button>
                        <a href="hapus_perhitungan.php?id=<?php echo $item['id'] ?>" class="btn btn-danger mr-2">Hapus Perhitungan</button>
                        <a href="hasil_download.php?id=<?php echo $item['id'] ?>" class="btn btn-primary" target="_blank">Download PDF</a>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Varietas</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Varietas</th>
                                        <th>Rangking</th>
                                        <th>Nilai</th>
                                        <?php foreach ($kriteriaItems as $kriteriaItem) { ?>
                                            <th><?php echo $kriteriaItem['nama'] ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody id="hasil_perhitungan">
                                    <?php foreach ($hasilItems as $index => $hasilItem) { ?>
                                        <?php $nilai = json_decode($hasilItem['nilai'], true); ?>
                                        <?php
                                            $bobot = array_values($hasilItem['bobot']);
                                        ?>
                                        <tr>
                                            <td><?php echo $index + 1 ?></td>
                                            <td><?php echo $hasilItem['nama'] ?></td>
                                            <td><?php echo $hasilItem['no'] ?></td>
                                            <td><?php echo $nilai['nilai_akhir'] ?></td>
                                            <?php foreach ($kriteriaItems as $kriteriaItem) { ?>
                                                <?php $bobotKey = array_search($kriteriaItem['id'], array_column($bobot, 'kriteria_id')); ?>
                                                <td><?php echo $bobotKey !== false ? $bobot[$bobotKey]['bobot'] : null ?></td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
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

    <script>
        $('#perhitungan').on('click', function (e) {
            let el = $(this);

            el.attr('disabled', 'disabled');

            let id = el.data('id');

            $.ajax({
                url: 'perhitungan.php',
                data: {
                    wilayah_id: id
                },
                type: 'POST',
                dataType: 'json',
            }).then(function (response) {
                if (response.status) {
                    $('#hasil_perhitungan').html(response.result_data_view);
                }  

                el.removeAttr('disabled');
            }).catch(function () {
                alert('Gagal');
                el.removeAttr('disabled');
            });
        });
    </script>

</body>
</html>

<?php

$view = ob_get_clean();

reset_session_flash();

echo $view;

?>