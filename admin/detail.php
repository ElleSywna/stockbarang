<?php
require '../function.php';
require '../cek.php';
//mendapatkan id barang
$idbarang = $_GET['id'];
//get informasi database
$get = mysqli_query($conn, "select * from stock, kode_barang where idbarang='$idbarang'");
$fetch = mysqli_fetch_assoc($get);

//set var
$namabarang = $fetch['namabarang'];
$deskripsi = $fetch['deskripsi'];
$stock = $fetch['stock'];

//cek gambar
$gambar = $fetch['image'];
if ($gambar == null) {
    //jika tidak ada gambar
    $img = "No Photo";
} else {
    //jika ada gambar
    $img = '<img src="../images/' . $gambar . '" class="zoomable">';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Stock- Detail Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .zoomable {
            width: 150px;
            height: 150px;
        }

        .zoomable:hover {
            transform: scale(1.5);
            transition: 0.3s ease;

        }
    </style>
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
                        <a class="nav-link" href="dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="kodeBarang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                            Kode Barang
                        </a>
                        <a class="nav-link active" href="stockBarang.php">
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
            <main>
                <div class="container-fluid px-4">
                    <h1 class="">Detail Barang</h1>
                    
                    <div class="card mb-5 mt-4">
                        
                        <div class="card-header">
                            <h2 class="mb-4"><?= $namabarang; ?> </h2>
                            <?= $img ?>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">Deskripsi</div>
                                <div class="col-md-9">: <?= $deskripsi; ?></div>
                            </div>


                            <div class="row">
                                <div class="col-md-3">Stock</div>
                                <div class="col-md-9">: <?= $stock; ?></div>
                            </div>
                            <br><br>
                            <!-- BarangMasuk -->
                            <h3>Barang Masuk</h3>
                            <table class="table table-bordered" id="barangMasuk">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambildatamasuk = mysqli_query($conn, "select * from masuk where idbarang='$idbarang'");
                                    $i = 1;
                                    while ($fetch = mysqli_fetch_array($ambildatamasuk)) {
                                        //untuk nge-get tgl, ket, qty
                                        $tanggal = $fetch['tanggal'];
                                        $keterangan = $fetch['keterangan'];
                                        $quantity = $fetch['qty'];


                                    ?>

                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $tanggal; ?></td>
                                            <td><?= $keterangan; ?></td>
                                            <td><?= $quantity; ?></td>
                                        </tr>


                                    <?php
                                    };
                                    ?>
                                </tbody>
                            </table>
                            <br><br>
                            <!-- Barang Keluar -->
                            <h3 class="mt-4">Barang Keluar</h3>
                            <table class="table table-bordered bg-light" id="barangkeluar">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Penerima</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambildatakeluar = mysqli_query($conn, "select * from keluar where idbarang='$idbarang'");
                                    $i = 1;
                                    while ($fetch = mysqli_fetch_array($ambildatakeluar)) {
                                        $tanggal = $fetch['tanggal'];
                                        $penerima = $fetch['penerima'];
                                        $quantity = $fetch['qty'];
                                    ?>

                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $tanggal; ?></td>
                                            <td><?= $penerima; ?></td>
                                            <td><?= $quantity; ?></td>
                                        </tr>


                                    <?php
                                    };
                                    ?>
                                </tbody>
                            </table>
                            <br><br>

                            <!-- Barang Retur -->
                            <h3 class="mt-4">Barang Retur</h3>
                            <table class="table table-bordered" id="barangkeluar">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambildatakeluar = mysqli_query($conn, "select * from retur where idbarang='$idbarang'");
                                    $i = 1;
                                    while ($fetch = mysqli_fetch_array($ambildatakeluar)) {
                                        $tanggal = $fetch['tanggal'];
                                        $keterangan = $fetch['keterangan'];
                                        $quantity = $fetch['qty'];
                                    ?>

                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $tanggal; ?></td>
                                            <td><?= $keterangan; ?></td>
                                            <td><?= $quantity; ?></td>
                                        </tr>

                                    <?php
                                    };
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </main>

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