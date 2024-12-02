<nav class="navbar navbar-expand-lg navbar-dark warna2">
    <div class="container-fluid">

        <div class="navbar-brand">
            <a class="nav-link" href="../hadmarketcoba"><i class=""></i>HadMarket</a>
        </div>

        <div class="collapse navbar-collapse justify-content-center" id="navbarTogglerDemo02">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item me-4">
                    <a class="nav-link" href="../hadmarketcoba"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="tentangkami.php"><i class="fas fa-info-circle"></i> Tentang Kami</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="produk.php"><i class="fas fa-box"></i> Produk</a>
                </li>
            </ul>
        </div>

        <div class="navbar-nav">
            <a class="btn btn-success" href="https://wa.me/6287825211575" target="_blank">
                Ingin Jual Barang?
            </a>
        </div>
    </div>
</nav>

<style>
    /* Warna utama navbar */
    .navbar {
        background-color: #62825D;
    }

    /* Tautan dalam navbar */
    .nav-link {
        color: white;
        transition: color 0.3s ease;
    }

    .nav-link:hover {
        color: #C2FFC7;
    }

    /* Tombol WhatsApp */
    .btn-success {
        background-color: #80AF81;
        border: none;
        color: white;
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background-color: #62825D;
        transform: scale(1.05);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    /* Responsivitas */
    @media (max-width: 768px) {
        .navbar .navbar-collapse {
            justify-content: space-between;
        }

        .btn-success {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
        }
    }
</style>
