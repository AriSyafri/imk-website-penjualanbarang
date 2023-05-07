<?php
    session_start();
    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    $role = $_SESSION["role"];

    if ($_SESSION["role"] != "owner") {
        echo "<script>
            alert('Anda bukan Owner');
            document.location.href = 'index.php';
            </script>";
    }

    require 'functions.php';

    $pegawai = query("SELECT * FROM pegawai");

    // aksi cari
    if(isset($_POST["cari"])){
        $pegawai = cariPegawai($_POST["keyword"]); 
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
        <title>Menampilkan Pegawai</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Toko AnekaSuka</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="" method="post">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Masukkan keyword" name="keyword" aria-label="" aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-search" id="cari" type="submit" name="cari"><i class="fas fa-search"></i></button>
                </div>           
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i> Hai <?= $_SESSION["namapegawai"];?> </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                        <div class="sb-sidenav-menu-heading">Halaman Utama</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-house-door-fill"></i></div>
                                HOME
                            </a>

                            <div class="sb-sidenav-menu-heading">Menu</div>

                            <?php if ($role == "spv" || $role == "kasir") { ?>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTransaksi" aria-expanded="false" aria-controls="collapseTransaksi">
                                    <div class="sb-nav-link-icon"><i class="bi bi-currency-dollar"></i></div>
                                    Transaksi
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseTransaksi" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="transaksi.php">Menampilkan Transaksi</a>
                                        <a class="nav-link" href="menambahTransaksi.php">Menambah Transaksi</a>
                                        <a class="nav-link" href="menghitungTransaksi.php">Hitung Transaksi</a>
                                    </nav>
                                </div>

                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseKonsumen" aria-expanded="false" aria-controls="collapseInventori">
                                    <div class="sb-nav-link-icon"><i class="bi bi-people-fill"></i></div>
                                    Konsumen
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseKonsumen" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="konsumen.php">Menampilkan Konsumen</a>
                                        <a class="nav-link" href="menambahKonsumen.php">Menambah Konsumen</a>
                                    </nav>
                                </div>

                            <?php }?>

                            <?php if ($role == "owner") { ?>

                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTransaksiPer" aria-expanded="false" aria-controls="collapseTransaksiPer">
                                <div class="sb-nav-link-icon"><i class="bi bi-cash"></i></div>
                                Pendapatan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseTransaksiPer" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">                                        <a class="nav-link" href="transaksiHari.php">Harian</a>
                                        <a class="nav-link" href="transaksiBulan.php">Bulanan</a>
                                        <a class="nav-link" href="transaksiTahun.php">Tahunan</a>
                                    </nav>
                                </div>


                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePegawai" aria-expanded="false" aria-controls="collapsePegawai">
                                    <div class="sb-nav-link-icon"><i class="bi bi-people"></i></div>
                                    Pegawai
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapsePegawai" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="pegawai.php">Menampilkan Pegawai</a>
                                        <a class="nav-link" href="menambahPegawai.php">Menambah Pegawai</a>
                                    </nav>
                                </div>

                            <?php }?>

                            <?php if ($role == "pegawai") { ?>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseInventori" aria-expanded="false" aria-controls="collapseInventori">
                                    <div class="sb-nav-link-icon"><i class="bi bi-check2-square"></i></div>
                                    Inventori
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseInventori" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="barang.php">Menampilkan Inventori</a>
                                        <a class="nav-link" href="menambahBarang.php">Menambah Inventori</a>
                                    </nav>
                                </div>
                            <?php }?>


                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Menampilkan Data Pegawai</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Data Pegawai</li>
                        </ol>
                        <div class="div">
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Nama Pegawai</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No HP</th>
                            <th scope="col" style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($pegawai as $row) : ?>
                            <tr>
                            <td><?= $row["idpegawai"]?></td>
                            <td><?= $row["namapegawai"]?></td>
                            <td><?= $row["role"]?></td>
                            <td><?= $row["alamat"]?></td>
                            <td><?= $row["nohp"]?></td>
                            <td style="text-align: center;">
                                <!-- <a class="btn btn-secondary">Ubah</a>  -->
                                <a class="btn btn-success" href="mengubahPegawai.php?idpegawai=<?= $row["idpegawai"]; ?>"><i class="bi bi-pencil-fill"></i></a> 
                                <!-- <a class="btn btn-danger"> Hapus</a> -->
                                <a class="btn btn-danger" href="hapusPegawai.php?idpegawai=<?= $row["idpegawai"]; ?>"onclick="return confirm('yakin?');"> <i class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                            <?php endforeach; ?>
                        </tbody>
                        </table>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Kelompok 4 IF-2</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
