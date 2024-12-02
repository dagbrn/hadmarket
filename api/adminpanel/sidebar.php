<div class="col-md-3 col-lg-2 bg-dark text-white vh-100">
            <div class="p-3">
                <a href="/" class="d-flex align-items-center mb-3 text-white text-decoration-none">
                    <span class="fs-4">HadMarket</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="../adminpanel" class="nav-link active text-white" aria-current="page">
                            <i class="fas fa-home me-2"></i> Dashboard
                        </a>
                    </li>
                    
                    <li>
                        <a href="kategori.php" class="nav-link text-white">
                            <i class="fas fa-shopping-cart me-2"></i> Kategori
                        </a>
                    </li>
                    <li>
                        <a href="produk.php" class="nav-link text-white">
                            <i class="fas fa-boxes me-2"></i> Produk
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong><?php echo $_SESSION['username']; ?></strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>