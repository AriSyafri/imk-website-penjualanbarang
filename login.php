<?php
    session_start();
    if( isset($_SESSION["login"]) ) {
        header("Location: index.php");
        exit;
    }

    

    // manggil fungsi
    require 'functions.php';

    if( isset($_POST["login"]) ) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($conn,"SELECT * FROM pegawai WHERE
            idpegawai = '$username'");
        
        if(mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // membuat session 
            $_SESSION["role"]=$row["role"];
            $_SESSION["namapegawai"]=$row["namapegawai"];

            if(password_verify($password, $row["pass"])) {
                // set session
                $_SESSION["login"] = true;
                exit(header("Location: index.php"));
            } else {
                echo 
                "<script>
                    alert('Password salah');
                </script>";
                $error = true;
            }
        } else {
            echo 
                "<script>
                    alert('Username tidak ada');
                </script>";
            $error = true;
        }
    }

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="css/login.css" rel="stylesheet" />
</head>
  <body>

    <section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="assets/img/img1.svg"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form action="" method="post">

            <div class="divider d-flex align-items-center my-4">
                <h1 class="text-center fw-bold mx-3 mb-0">Selamat Datang</h1>
            </div>
            <div class="divider d-flex align-items-center my-4">
                <h2 class="text-center fw-bold mx-3 mb-0">di Website Penjualan </h2>
            </div>

            <!-- username input -->
            <div class="form-outline mb-4">
                <input type="username" id="username" name="username" class="form-control form-control-lg"
                placeholder="Masukkan Username" />
                <label class="form-label" for="username">Username</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
                <input type="password" id="password" name="password" class="form-control form-control-lg"
                placeholder="Enter password" />
                <label class="form-label" for="password">Password</label>
            </div>


            <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" name="login" class="btn btn-warning btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">Masuk</button>
            </div>

            </form>
        </div>
        </div>
    </div>

</section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>
