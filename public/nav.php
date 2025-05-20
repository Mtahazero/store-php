<!-- Navbar -->
<nav class="navbar">
        <a class="logo">Shop<span>Now</span></a>
        
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="#">Categories</a></li>
            <li><a href="#">New Arrivals</a></li>
            <li><a href="#">Sale</a></li>
            <li><a href="#">Contact</a></li>
            <?php if(isset($_SESSION['id']) && isset($_SESSION['role'])){ ?>
                <li><a href="../action/logout.php">Logout</a></li>
            <?php }else{ ?>
                <li><a href="../view/login.php">Login</a></li>
            <?php } ?>
        </ul>
        
        <div class="search-box">
            <input type="text" placeholder="Search products...">
            <i class="fas fa-search"></i>
        </div>
        
        <div class="icons">
            <a href="#"><i class="far fa-user"></i></a>
            <a href="#">
                <i class="far fa-heart"></i>
                <span class="wishlist-count">2</span>
            </a>
            <a href="#">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count">3</span>
            </a>
        </div>
        
        <div class="mobile-menu">
            <i class="fas fa-bars"></i>
        </div>
</nav>