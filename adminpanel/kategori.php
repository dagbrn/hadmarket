<?php 
require "session.php";
require "../koneksi.php";

$queryKategori = mysqli_query($connect, "SELECT * FROM kategori_produk");
$jumlahKategori = mysqli_num_rows($queryKategori);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fa/css/fontawesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<style>
    .no-decoration {
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



    <!--Main Content-->
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php" class="no-decoration text-muted"><i class="fas fa-home"></i> Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-align-justify"></i> Kategori
                </li>
            </ol>
        </nav>
        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Kategori</h3>

            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" id="kategori" name="kategori" placeholder="Input nama kategori" class="form-control" required>
                </div>
                <div>
                    <button class="btn btn-primary mt-3" type="submit" name="simpan_kategori">Simpan</button>
                </div>
            </form>

            <?php
            if(isset($_POST['simpan_kategori'])){
                $kategori = htmlspecialchars(trim($_POST['kategori']));
                
                // Prepared statement untuk menghindari SQL Injection
                $stmt = $connect->prepare("SELECT nama_Kategori FROM kategori_produk WHERE nama_Kategori=?");
                $stmt->bind_param("s", $kategori);
                $stmt->execute();
                $result = $stmt->get_result();
                $jumlahKategoriBaru = $result->num_rows;
                
                if($jumlahKategoriBaru > 0){
                    echo '<div class="alert alert-warning mt-3" role="alert">Kategori Sudah ada</div>';
                } else {
                    // Prepared statement untuk menyimpan kategori
                    $stmt = $connect->prepare("INSERT INTO kategori_produk (nama_Kategori) VALUES (?)");
                    $stmt->bind_param("s", $kategori);
                    if($stmt->execute()){
                        echo '<div class="alert alert-primary mt-3" role="alert">Kategori Berhasil Tersimpan</div>';
                        echo '<meta http-equiv="refresh" content="1; url=kategori.php"/>';
                    } else {
                        echo '<div class="alert alert-danger mt-3" role="alert">Gagal menyimpan kategori: ' . mysqli_error($connect) . '</div>';
                    }
                }
                $stmt->close();
            }
            ?>
        </div>
    </div>

    <div class="container mt-3">
        <h2>List Kategori</h2>
        <div class="table-responsive mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($jumlahKategori == 0) {
                    ?>           
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data kategori</td>
                        </tr>
                    <?php 
                    } else {
                        $number = 1;
                            while ($data = mysqli_fetch_array($queryKategori)) {
                    ?>
                                <tr>
                                    <td><?php echo $number; ?></td>
                                    <td><?php echo htmlspecialchars($data['nama_Kategori']); ?></td>
                                    <td>
                                        <a href="kategori-detail.php?q=<?php echo $data['kategori_Id']; ?>" 
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