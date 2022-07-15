<?php
session_start();

//koneksi database
$conn = mysqli_connect("localhost", "root", "", "stockbarang");


//Dashboard
// $sqlx2="SELECT COUNT(userna_me) as data FROM stock";
// $hasilx2=mysqli_query($conn,$sqlx2);
// $row=mysqli_fetch_assoc($hasilx2);
// $datax1=$row['data'];


//Menambah barang baru
if (isset($_POST['addnewbarang'])) {
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];


    //gambar
    $allowed_extension = array('png', 'jpg');
    $nama = $_FILES['file']['name']; //ambil nama file 
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); //ambil ekstensi
    $ukuran = $_FILES['file']['size']; //ambil size file
    $file_tmp = $_FILES['file']['tmp_name']; //ambil lokasi file
    //penamaan file
    $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi; //menghubungkan file 


    //validasi sudah ada atau belum
    $cek = mysqli_query($conn, "select * from stock where namabarang='$namabarang'");
    $hitung = mysqli_num_rows($cek);

    if ($ukuran == 0) {
        $addtotable = mysqli_query($conn, "insert into stock (namabarang,deskripsi,stock)values('$namabarang','$deskripsi','$stock')");
        if ($addtotable) {
            header('location:stockBarang.php');
        } else {
            header('location:stockBarang.php');
        }

        if ($hitung < 1) {
            //proses gambar
            if (in_array($ekstensi, $allowed_extension) === true) {
                //validasi ukuran file 
                if ($ukuran < 15000000) {
                    move_uploaded_file($file_tmp, '../images/' . $image);
                    $addtotable = mysqli_query($conn, "insert into stock (namabarang,deskripsi,stock,image)values('$namabarang','$deskripsi','$stock','$image')");
                    if ($addtotable) {
                        header('location:stockBarang.php');
                    } else {
                        echo 'gagal';
                        header('location:stockBarang.php');
                    }
                } else {
                    //kalau ukuran lebih dr 1.5mb
                    echo '
                <script>
                    alert("Ukuran terlalu besar");
                    window.location.href="stockBarang.php";
                </script>
                ';
                }
            } else {
                //jika file bukan png/jpg
                echo '
        <script>
            alert("File Harus png/jpg");
            window.location.href="stockBarang.php";
        </script>
        ';
            }
        } else {
            //jika sudah ada
            echo '
        <script>
            alert("Nama Barang Sudah Ada");
            window.location.href="stockBarang.php";
        </script>
        ';
        }
    }
}




//menambah barang
if (isset($_POST['barangmasuk'])) {
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $cekstocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $cekstocksekarang + $qty;

    $addtomasuk = mysqli_query($conn, "insert into masuk(idbarang,keterangan,qty) values('$barangnya','$penerima','$qty')");
    $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity'where idbarang='$barangnya'");

    if ($addtomasuk && $updatestockmasuk) {
        header('location:masuk.php');
    } else {
        header('location:masuk.php');
    }
}

//menambah barang keluar
if (isset($_POST['addbarangkeluar'])) {
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $cekstocksekarang = $ambildatanya['stock'];
    if ($cekstocksekarang >= $qty) {
        //barang cukup
        $tambahkanstocksekarangdenganquantity = $cekstocksekarang - $qty;

        $addtokeluar = mysqli_query($conn, "insert into keluar(idbarang,penerima,qty) values('$barangnya','$penerima','$qty')");
        $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity'where idbarang='$barangnya'");

        if ($addtokeluar && $updatestockmasuk) {
            header('location:keluar.php');
        } else {
            header('location:keluar.php');
        }
    } else {
        //barang tidak cukup
        echo '
        <script>
            alert("Stock tidak cukup");
            window.location.href="keluar.php";
        </script>
        ';
    }
}



//Update info barang
if (isset($_POST['updatebarang'])) {
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];

    //gambar
    $allowed_extension = array('png', 'jpg');
    $nama = $_FILES['file']['name']; //ambil nama file 
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); //ambil ekstensi
    $ukuran = $_FILES['file']['size']; //ambil size file
    $file_tmp = $_FILES['file']['tmp_name']; //ambil lokasi file
    //penamaan file
    $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi; //menghubungkan file 
    if ($ukuran === 0) {
        //jika tidak ingin upload
        $update = mysqli_query($conn, "update stock set namabarang='$namabarang' ,deskripsi='$deskripsi',image='$image'where idbarang='$idb'");
        if ($update) {
            header('location:stockBarang.php');
        } else {
            header('location:stockBarang.php');
        }
    } else {
        //jika upload
        move_uploaded_file($file_tmp, '../images/' . $image);
        $update = mysqli_query($conn, "update stock set namabarang='$namabarang' ,deskripsi='$deskripsi', image='$image'where idbarang='$idb'");
        if ($update) {
            header('location:stockBarang.php');
        } else {
            header('location:stockBarang.php');
        }
    }
}

//menghapus barang dari stock
if (isset($_POST['hapusbarang'])) {
    $idb = $_POST['idb'];
    $gambar = mysqli_query($conn, "select * from stock where idbarang='$idb' ");
    $get = mysqli_fetch_array($gambar);
    $img = '../images/' . $get['image'];
    unlink($img);
    $hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");
    if ($hapus) {
        header('location:stockBarang.php');
    } else {
        header('location:stockBarang.php');
    }
}




//Mengubah data barang masuk
if (isset($_POST['updatebarangmasuk'])) {
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $deskripsi = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if ($qty > $qtyskrg) {
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");
        if ($kurangistocknya && $updatenya) {
            header('location:masuk.php');
        } else {
            echo 'Gagal';
            header('location:masuk.php');
        }
    } else {
        $selisih = $qtyskrg - $qty;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang ='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty',keterangan='$deskripsi' where idmasuk='$idm'");
        if ($kurangistocknya && $updatenya) {
            header('location:masuk.php');
        } else {
            echo 'Gagal';
            header('location.masuk.php');
        }
    }
}
//menghapus barang masuk
if (isset($_POST['hapusbarangmasuk'])) {
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm'];

    $getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok - $qty;

    $update = mysqli_query($conn, "update stock set stock='$selisih'where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");

    if ($update && $hapusdata) {
        header('location:masuk.php');
    } else {
        header('location:masuk.php');
    }
}




//Mengubah data barang keluar
if (isset($_POST['updatebarangkeluar'])) {
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if ($qty > $qtyskrg) {
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
        if ($kurangistocknya && $updatenya) {
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    } else {
        $selisih = $qtyskrg - $qty;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang ='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set qty='$qty',penerima='$penerima' where idkeluar='$idk'");
        if ($kurangistocknya && $updatenya) {
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location.keluar.php');
        }
    }
}
//menghapus barang keluar
if (isset($_POST['hapusbarangkeluar'])) {
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idk = $_POST['idk'];

    $getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok + $qty;

    $update = mysqli_query($conn, "update stock set stock='$selisih'where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");

    if ($update && $hapusdata) {
        header('location:keluar.php');
    } else {
        header('location:keluar.php');
    }
}



/********************
 * Add barang retur
 ********************/
if (isset($_POST['addbarangretur'])) {
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $cekstocksekarang = $ambildatanya['stock'];

    if ($cekstocksekarang >= $qty) {
        //barang cukup
        $tambahkanstocksekarangdenganquantity = $cekstocksekarang - $qty;

        $addtoretur = mysqli_query($conn, "insert into retur(idbarang,penerima,qty) values('$barangnya','$penerima','$qty')");
        $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity'where idbarang='$barangnya'");

        if ($addtoretur && $updatestockmasuk) {
            header('location:retur.php');
        } else {
            header('location:retur.php');
        }
    } else {
        //barang tidak cukup
        echo '
        <script>
            alert("Stock tidak cukup");
            window.location.href="retur.php";
        </script>
        ';
    }
}


/********************
 * Edit barang retur
 ********************/
if (isset($_POST['updatebarangretur'])) {
    $idb = $_POST['idb'];
    $idr = $_POST['idr'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "select * from retur where idretur='$idr'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if ($qty > $qtyskrg) {
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update retur set qty='$qty', penerima='$penerima' where idretur='$idr'");
        if ($kurangistocknya && $updatenya) {
            header('location:retur.php');
        } else {
            echo 'Gagal';
            header('location:retur.php');
        }
    } else {
        $selisih = $qtyskrg - $qty;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang ='$idb'");
        $updatenya = mysqli_query($conn, "update retur set qty='$qty',penerima='$penerima' where idretur='$idr'");
        if ($kurangistocknya && $updatenya) {
            header('location:retur.php');
        } else {
            echo 'Gagal';
            header('location.retur.php');
        }
    }
}


/********************
 * Delete barang retur
 ********************/
if (isset($_POST['hapusbarangretur'])) {
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idr = $_POST['idr'];

    $getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok + $qty;

    $update = mysqli_query($conn, "update stock set stock='$selisih'where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from retur where idretur='$idr'");

    if ($update && $hapusdata) {
        header('location:retur.php');
    } else {
        header('location:retur.php');
    }
}


/********************
 * Add data supplier
 ********************/
if (isset($_POST['barangsupplier'])) {
    $namasupplier = $_POST['namasupplier'];
    $alamat = $_POST['alamat'];
    $kontak = $_POST['kontak'];

    $addtosupplier = mysqli_query($conn, "insert into supplier (namasupplier, alamat, kontak)values('$namasupplier','$alamat','$kontak')");

    if ($addtosupplier) {
        header('location:supplier.php');
    } else {
        header('location:supplier.php');
    }
}

/********************
 * Edit data supplier
 ********************/
if (isset($_POST['updatesupplier'])) {
    $ids = $_POST['ids'];
    $namasupplier = $_POST['namasupplier'];
    $alamat = $_POST['alamat'];
    $kontak = $_POST['kontak'];

    $updatetosupplier = mysqli_query($conn, "update supplier set namasupplier='$namasupplier',alamat='$alamat',kontak='$kontak' where idsupplier='$ids'");

    if ($updatetosupplier) {
        header('location:supplier.php');
    } else {
        header('location:supplier.php');
    }
}


/********************
 * Delete data supplier
 ********************/
if (isset($_POST['hapussupplier'])) {
    $ids = $_POST['ids'];

    $deletesupplier = mysqli_query($conn, "delete from supplier where idsupplier='$ids'");
    if ($querydelete) {
        header('location:supplier.php');
    } else {
        header('location:supplier.php');
    }
}




/********************
 * Add kode barang
 ********************/
if (isset($_POST['kodebarang'])) {
    $namakodebarang = $_POST['namakodebarang'];
    $deskripsi = $_POST['deskripsi'];

    //validasi sudah ada atau belum
    $cekkodebarang = mysqli_query($conn, "select * from kode_barang where namakodebarang='$namakodebarang'");
    $hitungkodebarang = mysqli_num_rows($cekkodebarang);


    $addtokodebarang = mysqli_query($conn, "insert into kode_barang (namakodebarang, deskripsi)values('$namakodebarang','$deskripsi')");
    if ($addtokodebarang) {
        header('location:kodeBarang.php');
    } else {
        header('location:kodeBarang.php');
    }
}


/********************
 * Edit kode barang
 ********************/
if (isset($_POST['updatekodebarang'])) {
    $idkb = $_POST['idkb'];
    $namakodebarang = $_POST['namakodebarang'];
    $deskripsi = $_POST['deskripsi'];

    $updatetokodebarang = mysqli_query($conn, "update kode_barang set namakodebarang='$namakodebarang',deskripsi='$deskripsi' where idkodebarang='$idkb'");

    if ($updatesupplier) {
        header('location:kodeBarang.php');
    } else {
        header('location:kodeBarang.php');
    }
}


/********************
 * Delete kode barang
 ********************/
if (isset($_POST['hapuskodebarang'])) {
    $idkb = $_POST['idkb'];

    $deletekodebarang = mysqli_query($conn, "delete from kode_barang where idkodebarang='$idkb'");
    if ($deletekodebarang) {
        header('location:kodeBarang.php');
    } else {
        header('location:kodeBarang.php');
    }
}




//menambah admin baru
if (isset($_POST['addadmin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $queryinsert = mysqli_query($conn, "insert into login (email, password)values('$email','$password')");

    if ($queryinsert) {
        header('location:admin.php');
    } else {
        header('location:admin.php');
    }
}


//edit data admin
if (isset($_POST['updateadmin'])) {
    $emailbaru = $_POST['emailadmin'];
    $passwordbaru = $_POST['passwordbaru'];
    $idnya = $_POST['id'];

    $queryupdate = mysqli_query($conn, "update login set email='$emailbaru',password='$passwordbaru' where iduser='$idnya'");

    if ($queryupdate) {
        header('location:admin.php');
    } else {
        header('location:admin.php');
    }
}

//hapus admin
if (isset($_POST['hapusadmin'])) {
    $id = $_POST['id'];

    $querydelete = mysqli_query($conn, "delete from login where iduser='$id'");
    if ($querydelete) {
        header('location:admin.php');
    } else {
        header('location:admin.php');
    }
}
