<?php
require('dbconn.php');
?>

<?php


if ($_SESSION['type'] == 'admin') {

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
        <?php require('nav.php'); ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Profile</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="col-12 align-self-center">
                <div class="d-flex justify-content-center">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline col-3">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="img-fluid img-circle" src="images/profile2.png" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">
                                <?php echo $name ?>
                            </h3>

                            <p class="text-muted text-center">
                                <?php echo $type ?>
                            </p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">
                                        <?php echo $email ?>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Username</b> <a class="float-right">
                                        <?php echo $username ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    <a href="edit_admin_details.php" class="btn btn-primary mx-3">Edit Details</a>
                    <a href="addadmin.php" class="btn btn-primary mx-3">Add admin</a>
                    <a href="addlibrarian.php" class="btn btn-primary mx-3">Add Librarian</a>
                </div>
            </div>

            <!--/.container-->

        </div>
        <!--/.wrapper-->


        <?php require("scripts.php") ?>
    </body>

    </html>


<?php } else {
    echo "<script>window.location = '../error.php';</script>";
} ?>