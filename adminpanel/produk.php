<?php 
    require "session.php";
    require "../koneksi.php";

    $query = mysqli_query($connect, "SELECT a.*, b.nama_Kategori FROM produk a JOIN kategori_produk b
                            ON a.kategori_Id = b.kategori_Id");
    $jumlahProduk = mysqli_num_rows($query);

    $queryKategori = mysqli_query($connect, "SELECT * FROM kategori_produk");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fa/css/fontawesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<style>
    .no-decoration{
        text-decoration: none;
    }
</style>
<body>

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


    
<div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php" class="no-decoration text-muted"><i class="fas fa-home"></i> Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-box"></i> Produk
                </li>
            </ol>
        </nav>

        

        <div class="container mt-3">
            <h2>List Produk</h2>
                <div class="table-responsive mt-5 mx-auto" style="max-width:900px;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="ms-auto">
                        <a href="tambah-produk.php" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Produk</a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if($jumlahProduk == 0){
                                    ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Data Produk Tidak Tersedia</td>
                                    </tr>
                                    <?php
                                } else {
                                    $number = 1;
                                    while($data = mysqli_fetch_array($query)){
                                ?>
                                        <tr>
                                            <td><?php echo $number;?></td>
                                            <td><?php echo $data['nama_Produk'];?></td>
                                            <td><?php echo $data['nama_Kategori'];?></td>
                                            <td><?php echo $data['harga'];?></td>
                                            <td><?php echo $data['stok'];?></td>
                                            <td>
                                                <a href="produk-detail.php?q=<?php echo $data['produk_Id']; ?>" 
                                                class="btn btn-info"><i class="fas fa-search"></i></a>
                                            </td>
                                        </tr>
                                <?php 
                                        $number++;
                                    } 
                                }
                            ?>
                        </tbody>
                    </table>
                </div>


        </div>


</div>

<script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
<script src="../fa/js/all.min.js"></script>
</body>
</html>