<?php
require '../function.php';
require '../cek.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="../css/main.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="stockBarang.php">Lancar Abadi</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="stockBarang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stock Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link" href="retur.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Retur
                        </a>
                        <a class="nav-link" href="supplier.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Supplier
                        </a>
                        <a class="nav-link" href="kodeBarang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Kode Barang
                        </a>
                        <a class="nav-link" href="admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Kelola Admin
                        </a>
                        <a class="nav-link" href="../logout.php">
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
        </div>


        <div id="layoutSidenav_content">
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Dashboard</h1>
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <div class="card text-dark bg-info mb-3" style="max-width: 18rem;">
                            <div class="card-body">
                                <h3><?php echo $datax1; ?></h3>
                                <h5 class="card-title">Info card title</h5>
                            </div>
                            <div class="d-flex">
                                <h6 class="card-text mx-3 mt-3">Stock Barang</h6>
                                <i class="fa-solid fa-box icon-dashboard1 ms-auto px-4 align-self-center"></i>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <a href="/superAdmin/stockBarang.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="card text-dark bg-success mb-3" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Info card title</h5>
                            </div>
                            <div class="d-flex">
                                <h6 class="card-text mx-3 mt-3">Barang Masuk</h6>
                                <i class="fa-solid fa-boxes-stacked icon-dashboard1 ms-auto px-4 align-self-center"></i>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <a href="/superAdmin/stockBarang.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="card text-dark bg-danger mb-3" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Info card title</h5>
                            </div>
                            <div class="d-flex">
                                <h6 class="card-text mx-3 mt-3">Barang Keluar</h6>
                                <i class="fa-solid fa-truck-ramp-box icon-dashboard1 ms-auto px-4 align-self-center"></i>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <a href="/superAdmin/stockBarang.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="card text-dark bg-primary mb-3" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Info card title</h5>
                            </div>
                            <div class="d-flex">
                                <p class="card-text mx-3 mt-3">Admin</p>
                                <i class="fa-solid fa-users icon-dashboard1 ms-auto px-4 align-self-center"></i>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <a href="/superAdmin/stockBarang.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Info card title</h5>
                            </div>
                            <div class="d-flex">
                                <p class="card-text mx-3 mt-3">Sales</p>
                                <i class="fa-solid fa-shop icon-dashboard1 ms-auto px-4 align-self-center"></i>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <a href="/superAdmin/stockBarang.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>