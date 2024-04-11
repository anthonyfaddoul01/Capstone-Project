<?php
require('dbconn.php');

?>

<?php
if ($_SESSION['type'] == 'admin') {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
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
                            <h1>Requests</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="row justify-content-center">
                <div class="col-2 m-5">
                    <a href="issue_request.php" class="btn btn-info">
                        <i class="fas fa-book-reader" style="font-size:50px;"></i>
                        <p>Issue Request</p>
                    </a>
                </div>
                <div class="col-2 m-5">
                    <a href="renew_request.php" class="btn btn-info">
                        <i class="fas fa-book-open" style="font-size:50px;"></i>
                        <p>Renew Request</p>
                    </a>
                </div>
                <div class="col-2 m-5">
                    <a href="return_request.php" class="btn btn-info">
                        <i class="fas fa-book" style="font-size:50px;"></i>
                        <p>Return Request</p>
                    </a>
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