<?php
require '../function.php';
require '../cek.php';
?>
<html>

<head>
    <title>Laporan Barang Keluar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
    <div class="container mt-4">
        <h2>Laporan Barang Keluar</h2>
        <h4>(Inventori)</h4>
        <div class="data-tables datatable-dark">
            <div class="card" style="width: 28rem; background:beige; margin:15px; margin-top:20px">
                <form method="post" class="d-flex w-50 my-3 mx-3">
                    <input type="date" name="tgl_mulai" class="d-flex form-control">
                    <input type="date" name="tgl_selesai" class="d-felx form-control mx-2">
                    <button type="submit" name="filter_tgl" class="btn btn-info"> Filter </button>
                </form>
            </div>
            <div class="card-body">
                <table id="mauexportkeluar">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Penerima</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_POST['filter_tgl'])) {
                            $mulai = $_POST['tgl_mulai'];
                            $selesai = $_POST['tgl_selesai'];

                            if ($mulai != null || $selesai != null) {
                                $ambilsemuadatastock = mysqli_query($conn, "select * from keluar k,stock s where s.idbarang = k.idbarang and tanggal BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY) order by idkeluar DESC");
                            } else {
                                $ambilsemuadatastock = mysqli_query($conn, "select * from keluar k,stock s where s.idbarang = k.idbarang order by idkeluar DESC");
                            }
                        } else {
                            $ambilsemuadatastock = mysqli_query($conn, "select * from keluar k,stock s where s.idbarang = k.idbarang order by idkeluar DESC");
                        }

                        while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                            $idk = $data['idkeluar'];
                            $idb = $data['idbarang'];
                            $tanggal = $data['tanggal'];
                            $namabarang = $data['namabarang'];
                            $qty = $data['qty'];
                            $penerima = $data['penerima'];

                        ?>
                            
                            <tr>
                                <td><?php echo $tanggal ?></td>
                                <td><?php echo $namabarang; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $penerima; ?></td>

                            </tr>

                        <?php
                        };
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#mauexportkeluar').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>



</body>

</html>