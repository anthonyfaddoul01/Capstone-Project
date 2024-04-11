<!-- ======= Header ======= -->
<header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center justify-content-lg-between">

        <h1 class="logo me-auto me-lg-0"><a href="index.php"><img src="images/logo.png" alt="Logo"></a></h1>
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
                        <li><a href="favorites.php">Favorites</a></li>
                        <li><a href="pre.php">Prev Borrowed Books</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="profile.php">Profile</a></li>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
        <?php
        $userId = $_SESSION['userId'];
        $sql3 = "select * from bookbud.message where userId='$userId' ORDER BY Date DESC LIMIT 3";
        $result3 = $conn->query($sql3);
        $sql2 = "select COUNT(*) from bookbud.message where userId='$userId'";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();
        ?>
        <div class="d-flex gap-3">
            <ul class="m-0 p-0 d-flex align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="far fa-comments" style="font-size: 20px; color:white;"></i>

                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php echo $row2['COUNT(*)']; ?>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right mt-4"
                        style="left: inherit; right: 0px; width:400px;">
                        <?php
                        while ($row3 = $result3->fetch_assoc()) {

                            $name = $row3['Sender'];
                            $msg = $row3['Msg'];
                            $date = $row3['Date'];
                            $time = $row3['Time'];

                            $requestDateTimeString = $date . ' ' . $time;
                            $requestDateTime = new DateTime($requestDateTimeString);
                            $now = new DateTime();
                            $interval = $now->diff($requestDateTime);


                            echo "<a href='#' class=''>
                            <!-- Message Start -->
                            <div class='media p-3'>
                                <div class='media-body'>
                                    <h3 class='dropdown-item-title'>
                                        $name Admin
                                    </h3>
                                    <p class='text-sm text-light'>$msg</p>
                                    <p class='text-sm text-muted'><i class='far fa-clock mr-1'></i>" ?>
                            <?php
                            if ($interval->y > 0) {
                                echo $interval->y . " year" . ($interval->y > 1 ? "s" : "") . " ago";
                            } elseif ($interval->m > 0) {
                                echo $interval->m . " month" . ($interval->m > 1 ? "s" : "") . " ago";
                            } elseif ($interval->d > 0) {
                                echo $interval->d . " day" . ($interval->d > 1 ? "s" : "") . " ago";
                            } elseif ($interval->h > 0) {
                                echo $interval->h . " hour" . ($interval->h > 1 ? "s" : "") . " ago";
                            } elseif ($interval->i > 0) {
                                echo $interval->i . " minute" . ($interval->i > 1 ? "s" : "") . " ago";
                            } else {
                                echo $interval->s . " second" . ($interval->s > 1 ? "s" : "") . " ago";
                            }
                            ?>
                            <?php echo "</p>
                                </div>
                            </div>
                            <div class='dropdown-divider'></div>
                            <!-- Message End -->
                        </a>";
                        }

                        ?>
                        <a href="message.php" class=" dropdown-footer">See All
                            Messages</a>
                    </div>
                </li>
            </ul>
            <!-- <a href="profile.php" style="border: 5px solid #000000; border-radius:50px; background:#000000;" class="mr-3 p-1"><i class="fas fa-user"></i></a> -->
            <a href="logout.php" class="get-started-btn scrollto">Logout</a>
        </div>


    </div>
</header><!-- End Header -->