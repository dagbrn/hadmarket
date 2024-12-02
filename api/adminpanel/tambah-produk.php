<?php 
    require "session.php";
    require "../koneksi.php";

    $query = mysqli_query($connect, "SELECT a.*, b.nama_Kategori FROM produk a JOIN kategori_produk b
                            ON a.kategori_Id = b.kategori_Id");
    $jumlahProduk = mysqli_num_rows($query);

    $queryKategori = mysqli_query($connect, "SELECT * FROM kategori_produk");

    function generateRandomString($length = 10){
        $char = '01234566789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
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
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fa/css/fontawesome.min.css">
    <link rel="stylesheet" href="style.css">
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
            <h3>Tambah Produk</h3>
            
                <form action="" method="post" enctype="multipart/form-data">
                        <div>
                            <label for="nama">Nama Produk</label>
                            <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required>
                        </div>
                        <div>
                            <label for="kategori">Kategori Produk</label>
                            <select name="kategori" id="kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                <?php
                                    if ($queryKategori) {
                                        while ($data = mysqli_fetch_array($queryKategori)) {
                                ?>
                                            <option value="<?php echo htmlspecialchars($data['kategori_Id']); ?>">
                                                <?php echo htmlspecialchars($data['nama_Kategori']); ?>
                                            </option>
                                <?php
                                        }
                                    } else {
                                        echo '<option value="">Tidak ada kategori tersedia</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="harga">Harga Produk</label>
                            <input type="number" name="harga" id="harga" class="form-control" required>
                        </div>
                        <div>
                            <label for="foto">Foto Produk</label>
                            <input type="file" name="foto" id="foto" class="form-control">
                        </div>
                        <div>
                            <label for="detail">Detail Produk</label>
                            <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div>
                            <label for="stok">Stok</label>
                            <select name="stok" id="stok" class="form-control">
                                <option value="Tersedia">Tersedia</option>
                                <option value="Habis">Habis</option>
                            </select>
                        </div>
                        <div>
                            <label for="notel">Nomor Telfon Penjual</label>
                            <input type="text" id="notel" name="notel" class="form-control" autocomplete="off" required>
                        </div>
                        <div>
                            <button type="submit" name="simpan" class="btn btn-primary mt-3">Simpan</button>
                        </div>
                    </form>

                    <?php
                        if(isset($_POST['simpan'])){
                            $nama = htmlspecialchars($_POST['nama']);
                            $kategori = htmlspecialchars($_POST['kategori']);
                            $harga = htmlspecialchars($_POST['harga']);
                            $detail = htmlspecialchars($_POST['detail']);
                            $stok = htmlspecialchars($_POST['stok']);
                            $notel = htmlspecialchars($_POST['notel']);
                            
                            $target_dir = "../img/";
                            $nama_file = basename($_FILES["foto"]["name"]);
                            $target_file = $target_dir . $nama_file;
                            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                            $image_size = $_FILES["foto"]["size"];
                            $randomName = generateRandomString(20);
                            $newName = $randomName . "." . $imageFileType;

                            if($nama == '' || $kategori == '' || $harga == ''){
                    ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    Nama, Kategori dan Harga Wajib Diisi 
                                </div>
                    <?php      
                            } else {
                                    if($nama_file != ''){
                                        if($image_size > 2000000){
                    ?>
                                            <div class="alert alert-warning mt-3" role="alert">
                                                Foto tidak boleh lebih dari 2mb 
                                            </div>
                    <?php
                                        } else {
                                            if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif'){
                    ?> 
                                                <div class="alert alert-warning mt-3" role="alert">
                                                    Foto harus bertipe jpg, png, dan gif 
                                                </div>  
                    <?php                    } else {
                                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir .$newName);
                                            }
                                        }
                                    }

                                    $queryTambah = mysqli_query($connect, "INSERT INTO produk 
                                    (kategori_Id, nama_Produk, harga, foto, detail_Produk, stok, nomor_telfon) VALUES 
                                    ('$kategori','$nama','$harga','$newName','$detail','$stok','$notel')");
                            
                                    if($queryTambah){
                    ?>
                                        <div class="alert alert-primary mt-3" role="alert">
                                            Produk Berhasil Tersimpan
                                        </div>
                                        <meta http-equiv="refresh" content="3; url=produk.php"/>
                    <?php
                                    } else{
                                        echo mysqli_error($connect);
                                    }
                        }
                        }
                    ?>
        </div>
        <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
        <script src="../fa/js/all.min.js"></script>
</body>
</html>