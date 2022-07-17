<?php
require 'function.php';

//cek login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    //cocokin database dan cek user
    $cekdatabase = mysqli_query($conn, "SELECT * FROM login where username='$username' and password='$password'");
    //hitung rownya
    $hitung = mysqli_num_rows($cekdatabase);

    if ($hitung > 0) {
        //kalau data ditemukan
        $ambildatarole = mysqli_fetch_array($cekdatabase);
        $role = $ambildatarole['role'];

        if ($role == 'superadmin') {
            $_SESSION['log'] = 'logged';
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'superadmin';
            header('location:superAdmin/dashboard.php');
        } else {
            $_SESSION['log'] = 'logged';
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'admin';
            header('location:admin/dashboard.php');
        }
    } else {
        header('location:login.php');
    };
};


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login </title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/main.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="login-bg">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 login-picture">
                            <img src="/images/login.svg">
                            <div class="circle">
                                <span class="dot m-2"></span>
                                <span class="dot m-2"></span>
                                <span class="dot m-2"></span>
                            </div>
                            <h4 class="login-text">Sistem Inventori Lancar Abadi</h4>
                            <p class="login-text2">#memudahkan dalam melakukan pencatatan dan tracking data barang</p>                 
                        </div>
                        <div class="col-lg-5 login-form">
                            <div class="card shadow-lg border-0 rounded-lg">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="username" id="inputUsername" type="username" placeholder="nama user" />
                                            <label for="inputEmail">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary w-100" name="login">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>