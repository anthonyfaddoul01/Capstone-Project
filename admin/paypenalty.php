<?php
require ('dbconn.php');
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
        <?php require ("links.php") ?>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <?php require ("nav.php") ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Pay Penalty</h1>
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
                    $balance = $row['balance'];
                    ?>
                    <div class="col-md-4">
                        <!-- Widget: user widget style 2 -->
                        <div class="card card-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-info">
                                <a href="#" class="nav-link">
                                    Email <span class="float-right ">
                                        <?php echo $email ?>
                                    </span>
                                </a>
                                <a href="#" class="nav-link">
                                    Balance <span class="float-right ">
                                        <?php echo $balance ?>
                                    </span>
                                </a>
                            </div>
                            <div class="card-footer p-0">
                                <form action="pay.php" method="get">
                                    <div class="form-group p-2">
                                        <label for="penalty">Penalty to pay ($)</label>
                                        <input type="number" class="form-control" id="penalty" name="penalty"
                                            placeholder="Enter amount to pay ($)" min="0" step="0.01">
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <input type="hidden" name="balance" value="<?php echo $balance ?>">
                                    <input type="hidden" name="email" value="<?php echo $email ?>">
                                    <input type="hidden" name="name" value="<?php echo $name ?>">
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-info float-right">Pay</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>

                </div>
            </div>
        </div>
        <!--/.wrapper-->
        <?php require ("scripts.php") ?>

    </body>

    </html>


<?php } else {
    echo "<script>window.location = '../error.php';</script>";
} ?>