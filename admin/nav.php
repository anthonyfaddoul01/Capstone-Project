<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="index.php" class="dropdown-item">
                        Your Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="logout.php" class="dropdown-item">
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index.php" class="brand-link">
            <img src="images/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">BookBud</span>
        </a>
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
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a class="d-block">
                        <?php echo $name ?>
                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="send_message.php" class="nav-link">
                            <i class="nav-icon fas fa-inbox"></i>
                            <p>Messages</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="receive_message.php" class="nav-link">
                            <i class="nav-icon fas fa-reply"></i>
                            <p>Receive Message</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="user.php" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Manage Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="book.php" class="nav-link">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>All Books</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="addbook.php" class="nav-link">
                            <i class="nav-icon fas fa-plus"></i>
                            <p>Add Book</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="requests.php" class="nav-link">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Requests<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview ml-4" style="display: none;">
                            <li class="nav-item">
                                <a href="issue_request.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Issue Requests</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="renew_request.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Renew Requests</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="return_request.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Return Requests</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="current.php" class="nav-link">
                            <i class="nav-icon fas fa-list-ul"></i>
                            <p>Currently Issued Books</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pre.php" class="nav-link">
                            <i class="nav-icon fas fa-list-ul"></i>
                            <p>Prev Borrowed Books</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="popularity.php" class="nav-link">
                            <i class="nav-icon fas fa-chart-area"></i>
                            <p>Statistics</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                            <p class="text">Logout</p>
                        </a>
                    </li>
                </ul>

            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
<!-- /navbar -->