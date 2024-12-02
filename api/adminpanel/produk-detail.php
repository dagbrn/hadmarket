<?php

    require "session.php";
    require "../koneksi.php";

    $id = $_GET['q'];
    $query = mysqli_query($connect, "SELECT a.*, b.nama_Kategori FROM produk a JOIN kategori_produk b
    ON a.kategori_Id = b.kategori_Id WHERE a.produk_Id='$id'");
    $data = mysqli_fetch_array($query);
  
    $queryKategori = mysqli_query($connect, "SELECT * FROM kategori_produk WHERE kategori_Id != '$data[kategori_Id]'");

    function generateRandomString($length = 10){
        $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charLength = strlen($char);
        $randomString = '';
        for ($i = 0; $i < $length; $i++){
            $randomString .= $char[rand(0, $charLength - 1)];
        }
        return $randomString;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fa/css/fontawesome.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        form div{
            margin-bottom: 10px;
        }
    </style>
</head>
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
    <h2>Detail Produk</h2>


        <div class="col-12 col-md-6 mb-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama Produk</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $data['nama_Produk']; ?>"
                    class="form-control" autocomplete="off" required>
                </div>
                <div>
                    <label for="kategori">Kategori Produk</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                    <option value="<?php echo $data['kategori_Id']; ?>"><?php echo $data['nama_Kategori'];?></option>
    <?php
                        if ($queryKategori) {
                            while ($dataKategori = mysqli_fetch_array($queryKategori)) {
    ?>
                                <option value="<?php echo htmlspecialchars($dataKategori['kategori_Id']); ?>">
                                <?php echo htmlspecialchars($dataKategori['nama_Kategori']); ?>
                                </option>
    <?php
                            }
                        }
    ?>
                    </select>
                </div>
                <div>
                    <label for="harga">Harga Produk</label>
                    <input type="number" name="harga" id="harga" value="<?php echo $data['harga'];?>" class="form-control" required>
                </div>
                <div>
                    <label for="currentFoto">Foto Produk Sekarang</label>
                    <img src="../img/<?php echo $data['foto']; ?>" alt="" width="300px">
                </div>
                <div>
                    <label for="foto">Upload Foto Produk Baru</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail Produk</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">
                        <?php echo $data['detail_Produk']; ?>
                    </textarea>
                </div>
                <div>
                    <label for="stok">Stok</label>
                    <select name="stok" id="stok" class="form-control">
                        <option value="<?php echo $data['stok']; ?>"><?php echo $data['stok']; ?></option>
    <?php
                            if($data['stok'] == 'Tersedia'){
    ?>
                                <option value="Habis">Habis</option>
    <?php        
                            } else {
    ?>
                                <option value="Tersedia">Tersedia</option>
    <?php
                            }
    ?>
                    </select>
                </div>
                <div>
                    <button type="submit" name="simpan" class="btn btn-primary">Update</button>
                    <button type="submit" name="delete" class="btn btn-danger">Delete Produk</button>
                </div>
            </form>

            <?php
                if(isset($_POST['simpan'])){
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);
                    $stok = htmlspecialchars($_POST['stok']);
                    
                    $target_dir = "../img/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];
                    $randomName = generateRandomString(20);
                    $newName = $randomName . "." . $imageFileType;

                    if ($nama == '' || $kategori == '' || $harga == '') {

                        echo '<div class="alert alert-warning mt-3" role="alert">Nama, Kategori, dan Harga Wajib Diisi</div>';
                    } else {
                        $queryUpdate = "UPDATE produk SET kategori_Id='$kategori', nama_Produk='$nama', harga='$harga', detail_Produk='$detail', stok='$stok' WHERE produk_Id='$id'";
                    
                        if (mysqli_query($connect, $queryUpdate)) {
                            if ($nama_file != '') {
                                if ($image_size > 2000000) {
                                    echo '<div class="alert alert-warning mt-3" role="alert">Foto tidak boleh lebih dari 2mb</div>';
                                } elseif (!in_array($imageFileType, ['jpg', 'png', 'gif'])) {
                                    echo '<div class="alert alert-warning mt-3" role="alert">Foto harus bertipe jpg, png, dan gif</div>';
                                } else {
                                    // Pindahkan file gambar dan update foto produk
                                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $newName);
                                    $queryUpdateFoto = "UPDATE produk SET foto='$newName' WHERE produk_Id='$id'";
                    
                                    if (mysqli_query($connect, $queryUpdateFoto)) {
                                        echo '<div class="alert alert-primary mt-3" role="alert">Produk Berhasil Diupdate</div>';
                                        echo '<meta http-equiv="refresh" content="2; url=produk.php"/>';
                                    } else {
                                        echo '<div class="alert alert-danger mt-3" role="alert">Gagal memperbarui foto produk.</div>';
                                    }
                                }
                            } else {
                                echo '<div class="alert alert-primary mt-3" role="alert">Produk Berhasil Diupdate</div>';
                                echo '<meta http-equiv="refresh" content="2; url=produk.php"/>';
                            }
                        } else {
                            echo '<div class="alert alert-danger mt-3" role="alert">Gagal memperbarui produk.</div>';
                        }
                    }
                    

                }

                if(isset($_POST['delete'])){
                    $queryDelete = mysqli_query($connect, "DELETE FROM produk WHERE produk_Id = '$id'");

                    if($queryDelete){
    ?>
                        <div class="alert alert-primary mt-3" role="alert">
                            Produk Berhasil dihapus
                        </div>
                        <meta http-equiv="refresh" content="1; url=produk.php"/>
    <?php
                    } else {
                        echo mysqli_error($connect);
                    }
                }
    ?>
        </div>
    </div>

<script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
<script src="../fa/js/all.min.js"></script>
</body>
</html>