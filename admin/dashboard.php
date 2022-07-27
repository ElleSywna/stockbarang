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
    <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color:#1f9c7d;">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" style="font-weight:bold ;" href="dashboard.php">Lancar Abadi</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <div class="collapse navbar-collapse justify-content-end">
            <i class="fa-solid fa-circle-user m-2" style="color:white ; height:25px"></i>
            <h6 style="margin: 5px 35px 5px 5px; font-size:18px; color:white">
                <?php
                echo $_SESSION['username'];
                ?>
            </h6>
        </div>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark mt-3" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <a class="nav-link active" href="dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="kodeBarang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                            Kode Barang
                        </a>
                        <a class="nav-link" href="stockBarang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-boxes-stacked"></i></div>
                            Stock Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-plus"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-minus"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link" href="retur.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-balance-scale"></i></div>
                            Barang Retur
                        </a>
                        <a class="nav-link" href="supplier.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                            Supplier
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
                        <div class="card text-dark bg-primary mb-4 text-white" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5>Stock Barang</h5>
                                <div class="d-flex">
                                    <?php
                                    $dash_stockbarang_query = "SELECT * from stock";
                                    $dash_stockbarang_query_run = mysqli_query($conn, $dash_stockbarang_query);

                                    if ($stockbarang_total = mysqli_num_rows($dash_stockbarang_query_run)) {
                                        echo '<h2 class="mx-2">' . $stockbarang_total . '</h2>';
                                    } else {
                                        echo '<h4 class="mt-2">No data</h4>';
                                    }
                                    ?>
                                    <i class="fa-solid fa-box icon-dashboard1 ms-auto align-self-center"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <a href="/superAdmin/stockBarang.php" class="small-box-footer text-white">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="card text-dark bg-success mb-4 text-white" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5>Barang Masuk</h5>
                                <div class="d-flex">
                                    <?php
                                    $dash_barangmasuk_query = "SELECT * from masuk";
                                    $dash_barangmasuk_query_run = mysqli_query($conn, $dash_barangmasuk_query);

                                    if ($barangmasuk_total = mysqli_num_rows($dash_barangmasuk_query_run)) {
                                        echo '<h2 class="mx-2">' . $barangmasuk_total . '</h2>';
                                    } else {
                                        echo '<h4 class="mt-2">No data</h4>';
                                    }
                                    ?>
                                    <i class="fa-solid fa-boxes-stacked icon-dashboard1 ms-auto align-self-center"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <a href="/superAdmin/masuk.php" class="small-box-footer text-white">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="card text-dark bg-danger mb-4 text-white" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5>Barang Keluar</h5>
                                <div class="d-flex">
                                    <?php
                                    $dash_barangkeluar_query = "SELECT * from keluar";
                                    $dash_barangkeluar_query_run = mysqli_query($conn, $dash_barangkeluar_query);

                                    if ($barangkeluar_total = mysqli_num_rows($dash_barangkeluar_query_run)) {
                                        echo '<h2 class="mx-2">' . $barangkeluar_total . '</h2>';
                                    } else {
                                        echo '<h4 class="mt-2">No data</h4>';
                                    }
                                    ?>
                                    <i class="fa-solid fa-truck-ramp-box icon-dashboard1 ms-auto align-self-center"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <a href="/superAdmin/keluar.php" class="small-box-footer text-white">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="card text-dark bg-warning mb-4 text-white" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5>Barang Retur</h5>
                                <div class="d-flex">
                                    <?php
                                    $dash_barangretur_query = "SELECT * from retur";
                                    $dash_barangretur_query_run = mysqli_query($conn, $dash_barangretur_query);

                                    if ($barangretur_total = mysqli_num_rows($dash_barangretur_query_run)) {
                                        echo '<h2 class="mx-2">' . $barangretur_total . '</h2>';
                                    } else {
                                        echo '<h4 class="mt-2">No data</h4>';
                                    }
                                    ?>
                                    <i class="fa-solid fa-recycle icon-dashboard1 ms-auto align-self-center"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <a href="/superAdmin/retur.php" class="small-box-footer text-white">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="card text-dark bg-secondary mb-4 text-white" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5>Supplier</h5>
                                <div class="d-flex">
                                    <?php
                                    $dash_supplier_query = "SELECT * from supplier";
                                    $dash_supplier_query_run = mysqli_query($conn, $dash_supplier_query);

                                    if ($supplier_total = mysqli_num_rows($dash_supplier_query_run)) {
                                        echo '<h2 class="mx-2">' . $supplier_total . '</h2>';
                                    } else {
                                        echo '<h4 class="mt-2">No data</h4>';
                                    }
                                    ?>
                                    <i class="fa-solid fa-shop icon-dashboard1 ms-auto align-self-center"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <a href="/superAdmin/supplier.php" class="small-box-footer text-white">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="card text-dark bg-info mb-4 text-white" style="max-width: 18rem;">
                            <div class="card-body">
                                <h5>User</h5>
                                <div class="d-flex">
                                    <?php
                                    $dash_user_query = "SELECT * from login";
                                    $dash_user_query_run = mysqli_query($conn, $dash_user_query);

                                    if ($user_total = mysqli_num_rows($dash_user_query_run)) {
                                        echo '<h2 class="mx-2">' . $user_total . '</h2>';
                                    } else {
                                        echo '<h4 class="mt-2">No data</h4>';
                                    }
                                    ?>
                                    <i class="fa-solid fa-users icon-dashboard1 ms-auto align-self-center"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <a href="/superAdmin/admin.php" class="small-box-footer text-white">More info <i class="fa fa-arrow-circle-right"></i></a>
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