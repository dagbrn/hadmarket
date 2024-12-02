<?php
require "koneksi.php";

if (!$connect) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$queryKategori = mysqli_query($connect, "SELECT * FROM kategori_produk");

$order = "";
if (isset($_GET['sort'])) {
    if ($_GET['sort'] == "harga-terendah") {
        $order = "ORDER BY harga ASC";
    } elseif ($_GET['sort'] == "harga-tertinggi") {
        $order = "ORDER BY harga DESC";
    }
}

$limit = 12;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

if (isset($_GET['keyword'])) {
    $queryCount = "SELECT COUNT(*) as total FROM produk WHERE nama_Produk LIKE '%$_GET[keyword]%'";
    $queryProduk = mysqli_query($connect, "SELECT * FROM produk WHERE nama_Produk LIKE '%$_GET[keyword]%' $order LIMIT $limit OFFSET $offset");
} elseif (isset($_GET['kategori'])) {
    $queryGetKategoriId = mysqli_query($connect, "SELECT kategori_Id FROM kategori_produk WHERE nama_Kategori='$_GET[kategori]'");
    $kategoriId = mysqli_fetch_array($queryGetKategoriId);

    $queryCount = "SELECT COUNT(*) as total FROM produk WHERE kategori_Id = '$kategoriId[kategori_Id]'";
    $queryProduk = mysqli_query($connect, "SELECT * FROM produk WHERE kategori_Id = '$kategoriId[kategori_Id]' $order LIMIT $limit OFFSET $offset");
} else {
    $queryCount = "SELECT COUNT(*) as total FROM produk";
    $queryProduk = mysqli_query($connect, "SELECT * FROM produk $order LIMIT $limit OFFSET $offset");
}


$countResult = mysqli_query($connect, $queryCount);
$totalData = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalData / $limit);

$countData = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HadMarket | Produk</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="fa/css/all.min.css"> 
    <link rel="stylesheet" href="css/style.css">
    <style>
    .pagination .page-link {
        background-color: #526E48;
        color: white;
        border: 1px solid #526E48;
    }

    .pagination .page-item.active .page-link {
        background-color: white;
        color: #526E48;
        border: 1px solid #526E48;
    }

    .pagination .page-link:hover {
        background-color: #6B8F5A;
        color: white;
    }
</style>

</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container-fluid banner-produk d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-center"><b>Produk</b></h1>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <h3>Kategori</h3>
                <form method="GET" action="produk.php">
                    <select name="kategori" class="form-select mb-3" onchange="this.form.submit()">
                        <option value="" disabled selected>Pilih Kategori</option>
                        <?php while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
                            <option value="<?php echo $kategori['nama_Kategori']; ?>" 
                                <?php echo isset($_GET['kategori']) && $_GET['kategori'] == $kategori['nama_Kategori'] ? 'selected' : ''; ?>>
                                <?php echo $kategori['nama_Kategori']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </form>

                <h3>Sortir</h3>
                    <form method="GET" action="produk.php">
                        <?php if (isset($_GET['kategori'])) { ?>
                            <input type="hidden" name="kategori" value="<?php echo $_GET['kategori']; ?>">
                        <?php } ?>
                        <?php if (isset($_GET['keyword'])) { ?>
                            <input type="hidden" name="keyword" value="<?php echo $_GET['keyword']; ?>">
                        <?php } ?>
                        <select name="sort" class="form-select" onchange="this.form.submit()">
                            <option value="" disabled selected>Sortir Berdasarkan</option>
                            <option value="harga-terendah" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'harga-terendah' ? 'selected' : ''; ?>>Harga: Terendah</option>
                            <option value="harga-tertinggi" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'harga-tertinggi' ? 'selected' : ''; ?>>Harga: Tertinggi</option>
                        </select>
                    </form>
            </div>

            <div class="col-lg-9">
                <h3 class="text-center mb-3">Produk</h3>
                <div class="row mt-5">
                    <?php if ($countData < 1) { ?>
                        <h4 class="text-center my-4">Produk yang Anda cari tidak tersedia.</h4>
                    <?php } ?>

                    <?php while ($produk = mysqli_fetch_array($queryProduk)) { ?>
                        <div class="col-sm-6 col-md-4 mb-4">
                            <div class="cardproduk h-100">
                                <div class="image-box">
                                    <img src="img/<?php echo $produk['foto']; ?>" class="cardproduk-img-top" alt="...">
                                </div>
                                <div class="cardproduk-body p-3 text-center">
                                    <h4 class="cardproduk-title text-center"><?php echo $produk['nama_Produk']; ?></h4>
                                    <p class="cardproduk-text text-truncate"><?php echo $produk['detail_Produk']; ?></p>
                                    <p class="cardproduk-text text-harga">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                                    <a href="produk-detail.php?nama=<?php echo $produk['nama_Produk']; ?>" class="btn warna6 text-white mb-3">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <!-- Pagination -->
                <div>
                    <ul class="pagination justify-content-center mt-4" style="box-shadow: none;">
                        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                <a class="page-link" href="produk.php?page=<?php echo $i; ?><?php 
                                    echo isset($_GET['kategori']) ? '&kategori=' . $_GET['kategori'] : ''; 
                                    echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : ''; 
                                    echo isset($_GET['keyword']) ? '&keyword=' . $_GET['keyword'] : ''; 
                                ?>"><?php echo $i; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div> 
            </div>
        </div>
    </div>

    <?php require "footer.php"; ?>
    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="fa/js/all.min.js"></script>
</body>
</html>
