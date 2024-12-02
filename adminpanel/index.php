<?php 
    require "session.php";
    require "../koneksi.php";

    $queryKategori = mysqli_query($connect, "SELECT * FROM kategori_produk");
    $jumlahKategori = mysqli_num_rows($queryKategori);
    
    $queryProduk = mysqli_query($connect, "SELECT * FROM produk");
    $jumlahProduk = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fa/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<style>
    .summary-kategori {
        background-color: #2596be;
        border-radius: 10px;
        color: white;
    }
    .summary-produk {
        background-color: #e28743;
        border-radius: 10px;
        color: white;
    }
</style>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="sidebar">
        <nav class="nav flex-column">
            <a href="../adminpanel" class="nav-link">
                <span class="icon">
                <i class="fas fa-home"></i> 
                </span>
                <span class="description">Dashboard</span>
            </a>
            <a href="kategori.php" class="nav-link">
                <span class="icon">
                <i class="fas fa-align-justify"></i> 
                </span>
                <span class="description">Kategori</span>
            </a>
            <a href="produk.php" class="nav-link">
                <span class="icon">
                <i class="fas fa-box"></i> 
                </span>
                <span class="description">Produk</span>
            </a>

            <a href="logout.php" class="nav-link">
                <span class="icon">
                <i class="fa-solid fa-right-from-bracket"></i> 
                </span>
                <span class="description">Logout</span>
            </a>
        </nav>
    </div>

        <!-- Main content -->
        <div class="col-md-9 col-lg-10 p-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-home"></i> Dashboard
                    </li>
                </ol>
            </nav>
            <h1>Selamat datang, <?php echo $_SESSION['username']; ?></h1>

            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="summary-kategori p-3">
                            <div class="row">
                                <div class="col-6">
                                    <i class="fas fa-align-justify fa-4x"></i>
                                </div>
                                <div class="col-6">
                                    <h3 class="fs-2">Kategori</h3>
                                    <p class="fs-4"><?php echo $jumlahKategori; ?> Kategori</p>
                                    <p><a href="kategori.php" class="text-white">Lihat Detail</a></p>
                                </div>
                            </div>  
                        </div> 
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="summary-produk p-3">
                            <div class="row">
                                <div class="col-6">
                                    <i class="fas fa-box fa-4x"></i>
                                </div>
                                <div class="col-6">
                                    <h3 class="fs-2">Produk</h3>
                                    <p class="fs-4"><?php echo $jumlahProduk; ?> Produk</p>
                                    <p><a href="produk.php" class="text-white">Lihat Detail</a></p>
                                </div>
                            </div>  
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
<script src="../fa/js/all.min.js"></script>
</body>
</html>
