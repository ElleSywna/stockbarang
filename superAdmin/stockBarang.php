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
    <title>Stock barang</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .zoomable {
            width: 100px;
        }

        .zoomable:hover {
            transform: scale(1.5);
            transition: 0.3s ease;
        }

        a {
            text-decoration: none;
            color: black;
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
                        <a class="nav-link" href="admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
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
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 mb-4">Stock Barang</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Tambah Barang
                            </button>
                            <a href="export.php" class="btn btn-info">Export Data</a>
                        </div>
                        <div class="card-body">
                            <?php
                            $ambildatastock = mysqli_query($conn, "select * from stock where stock < 10");
                            while ($fetch = mysqli_fetch_array($ambildatastock)) {
                                $barang = $fetch['namabarang'];

                            ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    <strong>Warning</strong> Stock <?= $barang; ?> Sudah kurang dari 10
                                </div>
                            <?php
                            }
                            ?>
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Gambar</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Deskripsi</th>
                                        <th>Stock</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambilsemuadatakode = mysqli_query($conn, "select * from stock s,kode_barang kb where kb.idkodebarang = s.idkodebarang order by idbarang DESC");
                                    $i = 1;

                                    while ($data = mysqli_fetch_array($ambilsemuadatakode)) {
                                        $namakodebarang = $data['namakodebarang'];
                                        $deskripsi = $data['deskripsi'];
                                        $namabarang = $data['namabarang'];
                                        $harga = $data['harga'];
                                        $stock = $data['stock'];
                                        $idb = $data['idbarang'];
                                        $idkb = $data['idkodebarang'];

                                        //cek gambar
                                        $gambar = $data['image'];
                                        if ($gambar == null) {
                                            //jika tidak ada gambar
                                            $img = "No Photo";
                                        } else {
                                            //jika ada gambar
                                            $img = '<img src="../images/' . $gambar . '" class="zoomable">';
                                        }

                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $namakodebarang; ?></td>
                                            <td><?= $img; ?></td>
                                            <td><a href="detail.php?id=<?= $idb; ?>"><?= $namabarang; ?></a></td>
                                            <td><?= $harga; ?></td>
                                            <td><?= $deskripsi; ?></td>
                                            <td><?= $stock; ?></td>

                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $idb; ?>">
                                                    Edit
                                                </button>

                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $idb; ?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit<?= $idb; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="post" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <input type="text" name="namabarang" value="<?= $namabarang; ?>" class="form-control mb-3" required>
                                                            <input type="text" name="harga" value="<?= $harga; ?>" class="form-control mb-3" required>
                                                            <input type="file" name="file" class="form-control">
                                                            <br>
                                                            <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                            <button type="submit" class="btn btn-primary" name="updatebarang">Submit</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="delete<?= $idb; ?>">
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
                                                            <br><br>
                                                            <button type="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>
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
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <select name="kodebarangnya" class="form-control mb-3" required>
                        <option value="" hidden>Pilih Kode Barang</option>
                        <?php
                        $ambilsemuadatanya = mysqli_query($conn, "select * from kode_barang");
                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                            $namakodebarangnya = $fetcharray['namakodebarang'];
                            $idkodebarangnya = $fetcharray['idkodebarang'];
                        ?>
                            <option value="<?= $idkodebarangnya; ?>"><?= $namakodebarangnya; ?></option>
                        <?php

                        }
                        ?>
                    </select>
                    <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control mb-3" required>
                    <input type="text" name="harga" placeholder="Harga Barang" class="form-control mb-3" required>
                    <input type="number" name="stock" placeholder="QTY" class="form-control mb-3" required>
                    <input type="file" name="file" class="form-control">
                    <br>
                    <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

</html>