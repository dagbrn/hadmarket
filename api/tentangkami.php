<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HadMarket | About Us</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="fa/css/all.min.css"> 
    <style>
        .container-fluid {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container-fluid div {
            margin: 10px; /* Jarak antar gambar */
        }
        img {
            width: 300px; /* Atur lebar gambar */
            height: 300px; /* Atur tinggi gambar */
            object-fit: cover; /* Memastikan gambar tidak terdistorsi */
            border-radius: 8px; /* Tambahkan sudut melengkung jika diinginkan */
        }
    </style>
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container-fluid d-flex align-items-center">
        <div class="container">
            <h1 class="text-center mt-5">About Us</h1>
        </div>
    </div>

    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div>
            <img src="asset/alpen.jpg" alt="Foto 1">
        </div>
        <div>
            <img src="asset/hadi.jpg" alt="Foto 2">
        </div>
        <div>
            <img src="asset/roy.jpg" alt="Foto 3">
        </div>
    </div>


    <div class="container-fluid py-5">
        <div class="container fs-5 text-center">
        <p>HadMarket dirancang sebagai marketplace yang memungkinkan kamu untuk menjual dan membeli berbagai jenis barang bekas, mulai dari pakaian, elektronik, hingga furniture. Dengan antarmuka yang menarik, kamu dapat dengan mudah menavigasi situs untuk menemukan barang yang kamu cari atau menjual barang yang kamu inginkan. Situs ini juga dilengkapi dengan fitur-fitur yang memudahkan kamu dalam mencari barang yang kamu inginkan, seperti fitur pencarian, filter produk berdasarkan kategori, serta pengurutan produk berdasarkan harga.</p>

        <p>HadMarket dicetuskan oleh 3 Mahasiswa Universitas Jendral Soedirman, yaitu Mukhammad Alfaen Fadillah, Muhammad Nugrahhadi Al Khawarizmi, dan Darrell Gibran. Kami membuat situs ini atas dasar banyaknya orang yang membuang barang yang sudah tidak terpakai namun masih sangat bagus kualitasnya. Kami sangat menyayangkan tindakan tersebut, karena menurut kami masih banyak orang lain yang bisa memakai barang tersebut. 
        </p>
        <p>Dengan demikian, HadMarket diharapkan menjadi pasar e-commerce barang bekas di Purbalingga, memberikan manfaat bagi semua pihak, baik penjual maupun pembeli, serta berkontribusi pada keberlanjutan lingkungan. Kami percaya bahwa dengan dukungan dari berbagai pihak, platform ini akan berkembang pesat dan menciptakan dampak positif yang signifikan dalam masyarakat. 
        </p>
        </div>
    </div>

    <?php require "footer.php"; ?>

<script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
<script src="fa/js/all.min.js"></script>
</body>
</html>