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
    <title>Barang Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
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
                        <a class="nav-link" href="dashboard.php">
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
                        <a class="nav-link active" href="masuk.php">
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
                    <h1 class="mt-4 mb-4">Barang Masuk</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Tambah Barang
                            </button>
                            <a href="exportMasuk.php" class="btn btn-info">Export Data</a>
                            <br>
                            <form method="post" class="d-flex w-50 mt-3 mb-2">
                                <input type="date" name="tgl_mulai" class="d-flex form-control">
                                <input type="date" name="tgl_selesai" class="d-felx form-control mx-2">
                                <button type="submit" name="filter_tgl" class="btn btn-info"> Filter </button>
                            </form>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (isset($_POST['filter_tgl'])) {
                                        $mulai = $_POST['tgl_mulai'];
                                        $selesai = $_POST['tgl_selesai'];

                                        if ($mulai != null || $selesai != null) {
                                            $ambilsemuadatastock = mysqli_query($conn, "select * from masuk m, stock s where s.idbarang = m.idbarang and tanggal BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY) order by idmasuk DESC");
                                        } else {
                                            $ambilsemuadatastock = mysqli_query($conn, "select * from masuk m, stock s where s.idbarang = m.idbarang order by idmasuk DESC");
                                        }
                                    } else {
                                        $ambilsemuadatastock = mysqli_query($conn, "select * from masuk m, stock s where s.idbarang = m.idbarang order by idmasuk DESC");
                                    }

                                    while ($data = mysqli_fetch_assoc($ambilsemuadatastock)) {
                                        $idb = $data['idbarang'];
                                        $idm = $data['idmasuk'];
                                        $tanggal = $data['tanggal'];
                                        $namabarang = $data['namabarang'];
                                        $qty = $data['qty'];
                                        $keterangan = $data['keterangan'];

                                    ?>
                                        <tr>
                                            <td><?= $tanggal ?></td>
                                            <td><?= $namabarang; ?></td>
                                            <td><?= $qty; ?></td>
                                            <td><?= $keterangan; ?></td>
                        
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $idm; ?>">
                                                    Edit
                                                </button>

                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $idm; ?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit<?= $idm; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Barang Masuk</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">

                                                            <input type="text" name="keterangan" placeholder="Keterangan" value="<?= $keterangan; ?>" class="form-control mb-3" required>
                                                            <input type="number" name="qty" placeholder="QTY" value="<?= $qty; ?>" class="form-control mb-3" required>
                                                            <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                            <input type="hidden" name="idm" value="<?= $idm; ?>">
                                                            <button type="submit" class="btn btn-primary" name="updatebarangmasuk">Submit</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="delete<?= $idm; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Barang?</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            Apakah anda yakin menghapus <?= $namabarang; ?>?
                                                            <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                            <input type="hidden" name="kty" value="<?= $qty; ?>">
                                                            <input type="hidden" name="idm" value="<?= $idm; ?>">
                                                            <br><br>
                                                            <button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Hapus</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
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
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang Masuk</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <select name="barangnya" class="form-control mb-3" required>
                    <option hidden value="">Pilih Barang</option>
                        <?php
                        $ambilsemuadatanya = mysqli_query($conn, "select * from stock");
                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                            $namabarangnya = $fetcharray['namabarang'];
                            $idbarangnya = $fetcharray['idbarang'];
                        ?>
                            <option value="<?= $idbarangnya; ?>"><?= $namabarangnya; ?></option>
                        <?php

                        }
                        ?>
                    </select>
                    <input type="number" name="qty" placeholder="QTY" class="form-control mb-3" required>
                    <input type="text" name="penerima" placeholder="Keterangan" class="form-control mb-3" required>
                    <button type="submit" class="btn btn-primary" name="barangmasuk">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

</html>