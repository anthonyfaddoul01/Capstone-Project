<?php
require('dbconn.php');
?>

<?php
if ($_SESSION['userId'] == '1') {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Library</title>
        <?php require("links.php") ?>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <?php require("nav.php") ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <h1>User Details</h1>
                                    </div>
                                </div>
                            </div><!-- /.container-fluid -->
                        </section>
            <div class="container">
                <div class="row justify-content-center">
                    
                        <?php
                        $id = $_GET['id'];
                        $sql = "select * from bookbud.user where userId='$id'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();

                        $name = $row['name'];
                        $username = $row['username'];
                        $email = $row['email'];
                        ?>
                        <div class="col-md-4">
                            <!-- Widget: user widget style 2 -->
                            <div class="card card-widget widget-user-2">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-info">

                                </div>
                                <div class="card-footer p-0">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                ID No. <span class="float-right badge bg-info">
                                                    <?php echo $id ?>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                Name <span class="float-right badge bg-info">
                                                    <?php echo $name ?>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                Username <span class="float-right badge bg-info">
                                                    <?php echo $username ?>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                Email <span class="float-right badge bg-info">
                                                    <?php echo $email ?>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">

                                        </li>
                                    </ul>
                                </div>
                                <div class="row justify-content-between p-4">
                                <form>
                                  <a href="user.php" class="btn btn-primary">Go Back</a>  
                                </form>

                                <form action="deleteuser.php" method="post">
                                    <button onclick="return myFunction2()" name="delete" type="submit"
                                        class="btn btn-danger">Delete
                                    </button>
                                    <script>
                                        function myFunction2() {
                                            return confirm('Are you sure you want to delete this user?');
                                        } 
                                    </script>
                                    <input type="hidden" name="userId" value="<?php echo $id ?>">
                                </form>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                    
                </div>
            </div>
        </div>
        <!--/.wrapper-->
        <?php require("scripts.php") ?>

    </body>

    </html>


<?php } else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>