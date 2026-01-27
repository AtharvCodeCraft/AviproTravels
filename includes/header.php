<header>
    <div class="container">
        <nav>
            <a href="index.php" class="logo">Avipro <span>Travels</span></a>
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="packages.php">Packages</a>
                <a href="about.php">About</a>
                <a href="contact.php">Contact</a>
                <?php
                if(session_status() === PHP_SESSION_NONE) session_start();
                if(isset($_SESSION["user_loggedin"]) && $_SESSION["user_loggedin"] === true){
                    echo '<a href="profile.php" class="btn btn-outline" style="padding: 8px 20px;">Profile</a>';
                } else {
                    echo '<a href="login.php" class="btn btn-outline" style="padding: 8px 20px;">Login</a>';
                }
                ?>
                <a href="booking.php" class="btn btn-primary" style="padding: 8px 20px; color: white;">Book Now</a>
            </div>
        </nav>
    </div>
</header>
