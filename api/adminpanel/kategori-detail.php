<?php

    require "session.php";
    require "../koneksi.php";

    $id = $_GET['q'];
    $query = mysqli_query($connect, "SELECT * FROM kategori_produk WHERE kategori_Id = '$id'");
    $data = mysqli_fetch_array($query);
    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
</head>
<link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../fa/css/fontawesome.min.css">
<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
    <h2>Detail Kategori</h2>
    <div class="col-12 col-md-6">
        <form action="" method="post">
            <div>
                <label for="kategori">Kategori</label>
                <input type="text" name="kategori" id="kategori" class="form-control" 
                value="<?php echo $data['nama_Kategori']?>">

            </div>
            <div class="mt-5">
                <button type="submit" class="btn btn-primary" name="edit-btn">Edit</button>
                <button type="submit" class="btn btn-danger" name="delete-btn">Delete</button>
            </div>
        </form>
        <?php
        if(isset($_POST['edit-btn'])){
                $kategori = htmlspecialchars($_POST['kategori']);
                if($data['nama_Kategori']== $kategori){
                    ?>
                    <meta http-equiv="refresh" content="0; url=kategori.php"/>
                    <?php
                } else{
                    $query = mysqli_query($connect, "SELECT * FROM kategori_produk WHERE nama_Kategori='$kategori'");
                    $jumlahData = mysqli_num_rows($query);
                    
                    if($jumlahData > 0 ){
                        ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Kategori Sudah Ada
                        </div>
                        <?php
                    } else{
                        $querySimpan = mysqli_query($connect, "UPDATE kategori_produk SET nama_Kategori='$kategori' 
                        WHERE kategori_Id='$id'");
                        if($querySimpan){
                            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Kategori Berhasil Diupdate
                            </div>
                            <meta http-equiv="refresh" content="1; url=kategori.php"/>
                            <?php
                        } else{
                            echo mysqli_error($connect);
                        }
                    }

                }
        }

                    if(isset($_POST['delete-btn'])){

                        $queryCheck = mysqli_query($connect, "SELECT * FROM produk WHERE kategori_Id='$id'");
                        $dataCount = mysqli_num_rows($queryCheck);

                        if($dataCount > 0){
                            ?>
                            <div class="alert alert-warning mt-3" role="alert">
                            Kategori Gagal dihapus karena Sudah ada Produk 
                            </div>
                            <?php
                        }
                        $queryDelete = mysqli_query($connect, "DELETE FROM kategori_produk WHERE kategori_Id='$id'");

                        if($queryDelete){
                            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                            Kategori Berhasil dihapus
                            </div>
                            <meta http-equiv="refresh" content="1; url=kategori.php"/>
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