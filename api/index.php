<?php
    require "koneksi.php";

    $queryProduk = mysqli_query($connect, "SELECT produk_Id, nama_Produk, harga, foto, detail_Produk FROM produk LIMIT 6");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HadMarket | Home</title>
    
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="fa/css/all.min.css"> 
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <?php require "navbar.php"; ?>    

    <!-- Banner -->
    <div class="container-fluid d-flex align-items-center banner">
        <div class="container text-center text-white">
            <h1>Toko Barang Second</h1>
            <h3>Mau Cari Apa?</h3>
            <div class="col-md-8 offset-md-2">
                <form method="get" action="produk.php">
                    <div class="input-group input-group-lg my-3">
                        <input type="text" class="form-control" placeholder="Nama Barang" name="keyword">
                        <button type="submit" class="btn warna6 text-white">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Kategori -->
    <div class="cardkategori-container ">
        <div class="container text-center mb-3">
        <h3><b>Kategori Terpopuler</b></h3>
        </div>
        <a href="produk.php?kategori=Pakaian">
            <div class="cardkategori">
                <img src="asset/kategoriP.jpg" alt="">
                <div class="cardkategori-content">
                    <h2>Pakaian</h2>
            </div>
        </a>
        </div>
        <div class="cardkategori">
            <a href="produk.php?kategori=Furniture">
            <img src="asset/furniture.jpg" alt="">
            <div class="cardkategori-content">
                <h2>Furniture</h2>
            </div>
            </a>
        </div>
        <div class="cardkategori">
            <a href="produk.php?kategori=Alat Elektronik">
            <img src="asset/elektronik.jpg" alt="">
            <div class="cardkategori-content">
                <h2>Elektronik</h2>
            </div>
            </a>
        </div>
    </div>



    <!-- About Us -->
    <div class="container-fluid warna6 py-5 mt-5">
        <div class="container text-center">
            <h3><b>Sedikit Tentang HadMarket</b></h3>
            <p class="fs-5 mt-4">HadMarket dirancang sebagai marketplace yang memungkinkan kamu untuk menjual dan membeli berbagai jenis barang bekas, mulai dari pakaian, elektronik, hingga furniture. Dengan antarmuka yang menarik, kamu dapat dengan mudah menavigasi situs untuk menemukan barang yang kamu cari atau menjual barang yang kamu inginkan. Situs ini juga dilengkapi dengan fitur-fitur yang memudahkan kamu dalam mencari barang yang kamu inginkan, seperti fitur pencarian, filter produk berdasarkan kategori, serta pengurutan produk berdasarkan harga.</p>
        </div>
    </div>


    <!-- Produk -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3><b>Produk</b></h3>
            <div class="row mt-5">
                <?php while ($data = mysqli_fetch_array($queryProduk)) { ?>
                <div class="col-sm-6 col-md-4 mb-4">
                    <div class="cardproduk h-100">
                        <div class="image-box">
                            <img src="img/<?php echo $data['foto']; ?>" class="cardproduk-img-top" alt="...">
                        </div>
                        <div class="cardproduk-body mt-3">
                            <h4 class="cardproduk-title"><?php echo $data['nama_Produk']; ?></h4>
                            <p class="cardproduk-text text-truncate"><?php echo $data['detail_Produk']; ?></p>
                            <p class="cardproduk-text text-harga">Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></p>
                            <a href="produk-detail.php?nama=<?php echo $data['nama_Produk']; ?>" class="btn warna6 text-white mb-4">Detail</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            
        </div>

    </div>

    <div class="container-fluid py-5 mt-5">
        <div class="container text-center">
            <h3>Tertarik dengan Produk lain?</h3>
            <p class="fs-5 mt-4"><b>Klik dibawah ini!</b></p> 
            <a class="btn warna6 mt-3 p-3 text-white" href="produk.php">See More</a></p>
        </div>
    </div>

    <?php require "footer.php"; ?>

    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="fa/js/all.min.js"></script>
</body>
</html>
