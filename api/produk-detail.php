<?php
    require "koneksi.php";

    $nama = htmlspecialChars($_GET['nama']);
    $queryProduk = mysqli_query($connect, "SELECT * FROM produk WHERE nama_Produk='$nama'");
    $produk = mysqli_fetch_array($queryProduk);

    $queryProdukTerkait = mysqli_query($connect, "SELECT * FROM produk WHERE kategori_Id ='$produk[kategori_Id]' AND produk_Id != '$produk[produk_Id]' LIMIT 3");

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HadMarket | Detail Produk</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="fa/css/all.min.css"> 
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php require "navbar.php"; ?>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <!-- Gambar Produk -->
            <div class="col-lg-5 mb-5">
                <img src="img/<?php echo $produk['foto']; ?>" class="w-100 produk-image" alt="Gambar Produk">
            </div>
            <!-- Detail Produk -->
            <div class="col-lg-6 offset-lg-1">
                <h1><?php echo $produk['nama_Produk']; ?></h1>
                <p class="fs-5">
                    <?php echo $produk['detail_Produk']; ?>
                </p>
                <p class="text-harga fs-4 text-success">
                    Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?>
                </p>
                <p class="fs-5">Status Ketersediaan: <strong><?php echo $produk['stok']; ?></strong></p>
                <a href="https://wa.me/<?php echo $produk['nomor_telfon']; ?>?text=Hai,%20saya%20tertarik%20dengan%20<?php echo urlencode($produk['nama_Produk']); ?>" 
                   class="btn warna6 text-white"><i class="fa-brands fa-whatsapp"></i> Tanyakan Penjual</a>
            </div>
        </div>
    </div>
</div>

<!-- Produk Terkait -->
<div class="container-fluid py-5 warna4 mt-1">
    <div class="container">
        <h2 class="jTerkait text-center mb-5">Produk Terkait</h2>
        <div class="row justify-content-center">
            <?php while ($data = mysqli_fetch_array($queryProdukTerkait)) { ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card-terkait">
                    <a href="produk-detail.php?nama=<?php echo $data['nama_Produk']; ?>">
                        <img src="img/<?php echo $data['foto']; ?>" 
                             class="img-fluid img-thumbnail produk-terkait-image" 
                             alt="<?php echo $data['nama_Produk']; ?>">
                        <h5 class="mt-2 text-center"><?php echo $data['nama_Produk']; ?></h5>
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="container-fluid py-5"></div>

<?php require "footer.php"; ?>
<script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
<script src="fa/js/all.min.js"></script>
</body>
</html>
