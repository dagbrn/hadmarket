<?php
    require "koneksi.php";

    $nama = htmlspecialChars($_GET['nama']);
    $queryProduk = mysqli_query($connect, "SELECT * FROM produk WHERE nama_Produk='$nama'");
    $produk = mysqli_fetch_array($queryProduk);

    $queryProdukTerkait = mysqli_query($connect, "SELECT * FROM produk WHERE kategori_Id ='$produk[kategori_Id]' AND produk_Id != '$produk[produk_Id]' LIMIT 4");

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HadMarket | Detail Produk</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="fa/css/all.min.css"> 
    <link rel="stylesheet" href="style.css">
    <style>
        /* Warna Utama */
        .warna1 { background-color: #9EDF9C; }
        .warna2 { background-color: #62825D; }
        .warna3 { background-color: #526E48; }

        /* Gambar Produk */
        .produk-image {
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .produk-image:hover {
            transform: scale(1.05);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3);
        }

        /* Tombol */
        .btn {
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Produk Terkait */
        .produk-terkait-image {
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            object-fit: cover;
            height: 200px;
        }
        .produk-terkait-image:hover {
            transform: scale(1.05);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Card Produk Terkait */
        .card-terkait {
            border: none;
            background-color: transparent;
            text-align: center;
        }
    </style>
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
                <a href="https://wa.me/?text=Hai,%20saya%20tertarik%20dengan%20<?php echo urlencode($produk['nama_Produk']); ?>" 
                   class="btn warna3 text-white"><i class="fa fa-whatsapp"></i> Tanyakan Penjual</a>
            </div>
        </div>
    </div>
</div>

<!-- Produk Terkait -->
<div class="container-fluid py-5 warna2">
    <div class="container">
        <h2 class="text-center text-white mb-5">Produk Terkait</h2>
        <div class="row">
            <?php while ($data = mysqli_fetch_array($queryProdukTerkait)) { ?>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card-terkait">
                    <a href="produk-detail.php?nama=<?php echo $data['nama_Produk']; ?>">
                        <img src="img/<?php echo $data['foto']; ?>" 
                             class="img-fluid img-thumbnail produk-terkait-image" 
                             alt="<?php echo $data['nama_Produk']; ?>">
                    </a>
                    <h5 class="text-white mt-2"><?php echo $data['nama_Produk']; ?></h5>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>
<script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
<script src="fa/js/all.min.js"></script>
</body>
</html>
