<?php
require '../function.php';
require '../cek.php';
//mendapatkan id barang
$idbarang=$_GET['id'];
//get informasi database
$get=mysqli_query($conn,"select * from stock where idbarang='$idbarang'");
$fetch=mysqli_fetch_assoc($get);
//set var
$namabarang=$fetch['namabarang'];
$deskripsi=$fetch['deskripsi'];
$stock=$fetch['stock'];
 
//cek gambar
$gambar=$fetch['image'];
 if($gambar==null){
     //jika tidak ada gambar
     $img="No Photo";
 }else{
     //jika ada gambar
     $img='<img src="../images/'.$gambar.'" class="zoomable">'; 
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
            .zoomable{
                width:200px;
                height:200px;
            }
            .zoomable:hover{
                transform:scale(1.5);
                transition:0.3s ease;

            }
        </style>
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
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4 mb-4">Detail Barang</h1>
                        <div class="card mb-4 mt-4">
                            <div class="card-header">
                                <h2><?=$namabarang;?> </h2>
                                <?=$img?>                      
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">Deskripsi</div>
                                    <div class="col-md-9">:<?=$deskripsi;?></div>
                                </div>


                                <div class="row">
                                    <div class="col-md-3">Stock</div>
                                    <div class="col-md-9">:<?=$stock;?></div>
                                </div>
                                <br><br>
                                <!-- BarangMasuk -->
                                <h3>Barang Masuk</h3>
                                <table class="table table-bordered" id="barangMasuk">
                                    <thead>
                                        <tr>
                                            <th>No</th> 
                                            <th>Tanggal</th>
                                            <th>Deskripsi</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $ambildatamasuk=mysqli_query($conn,"select * from masuk where idbarang='$idbarang'");
                                            $i=1; 
                                            while($fetch=mysqli_fetch_array($ambildatamasuk)){
                                                //untuk nge-get tgl, ket, qty
                                                $tanggal=$fetch['tanggal'];
                                                $keterangan=$fetch['keterangan'];
                                                $quantity=$fetch['qty'];


                                        ?>

                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$tanggal;?></td>
                                            <td><?=$keterangan;?></td>
                                            <td><?=$quantity;?></td>
                                        </tr>
                                              
                                                
                                        <?php
                                        };
                                        ?>
                                    </tbody>
                                </table>
                                <br><br>
                                <!-- Barang Keluar -->
                                <h3>Barang Keluar</h3>
                                <table class="table table-bordered" id="barangkeluar">
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
                                            $ambildatakeluar=mysqli_query($conn,"select * from keluar where idbarang='$idbarang'");
                                            $i=1; 
                                            while($fetch=mysqli_fetch_array($ambildatakeluar)){
                                                $tanggal=$fetch['tanggal'];
                                                $penerima=$fetch['penerima'];
                                                $quantity=$fetch['qty'];


                                        ?>

                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$tanggal;?></td>
                                            <td><?=$keterangan;?></td>
                                            <td><?=$quantity;?></td>
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
                        <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control mb-3" required>
                        <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control mb-3" required>
                        <input type="number" name="stock" placeholder="QTY"class="form-control mb-3" required>
                        <input type="file" name="file" class="form-control">
                        <br>
                        <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
                    </div>
                    </form>

                    <!-- Modal footer -->
                    

                    </div>
                </div>
            </div>

</html>