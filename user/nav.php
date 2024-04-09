<!-- ======= Header ======= -->
<header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center justify-content-lg-between">

        <h1 class="logo me-auto me-lg-0"><a href="index.php"><img src="images/logo.png" alt="Logo" ></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        <?php
        $userId = $_SESSION['userId'];
        $sql = "select * from bookbud.user where userId='$userId'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $username = $row['username'];
        $type = $row['type'];
        ?>
        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link" href="index.php">Home</a></li>
                <li class="dropdown"><a href="#"><span>Browse Books</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="genresearch.php">By Genre</a></li>
                        <li><a href="search.php">By Search</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#"><span>My Books</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="current.php">Currently Issued Books</a></li>
                        <li><a href="#">Favorites</a></li>
                        <li><a href="pre.php">Prev Borrowed Books</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="profile.php">Profile</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
        <div>
            <!-- <a href="profile.php" style="border: 5px solid #000000; border-radius:50px; background:#000000;" class="mr-3 p-1"><i class="fas fa-user"></i></a> -->
            <a href="logout.php" class="get-started-btn scrollto">Logout</a>
        </div>
        

    </div>
</header><!-- End Header -->