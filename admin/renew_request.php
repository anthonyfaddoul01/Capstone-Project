<?php
require('dbconn.php');

?>

<?php
if ($_SESSION['userId'] == '1') {
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
                            <h1>Renew Requests</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="card-body">

                <div class="col">
                    <!-- Box Comment -->
                    <div class="card card-widget">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0" style="height: 70vh;">
                                        <table class="table table-head-fixed text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Borrower's ID</th>
                                                    <th>Borrower's Username</th>
                                                    <th>Book ID</th>
                                                    <th>Book Name</th>
                                                    <th>Renewals Left</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "select * from bookbud.record, bookbud.book, bookbud.renew where 
                                                Date_of_Return is NULL and renew.bookId=book.bookId and renew.userId=record.userId 
                                                and renew.bookId=record.bookId";

                                                $result = $conn->query($sql);
                                                while ($row = $result->fetch_assoc()) {
                                                    $bookid = $row['bookId'];
                                                    $userid = $row['userId'];
                                                    $namequery = "SELECT username FROM bookbud.user WHERE userId='$userid'";
                                                    $result = $conn->query($namequery);
                                                    $name = $result->fetch_all(MYSQLI_ASSOC);
                                                    $title = $row['title'];
                                                    $renewals = $row['Renewals_left'];


                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $userid ?>
                                                        </td>
                                                        <td>
                                                        <?php echo $name[0]['username'] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $bookid ?>
                                                        </td>
                                                        <td><b>
                                                                <?php echo $title ?>
                                                            </b></td>
                                                        <td>
                                                            <?php echo $renewals ?>
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <?php

                                                                echo "<a href=\"acceptrenewal.php?id1=" . $bookid . "&id2=" . $userid . "\" class=\"btn btn-success\">Accept</a>";

                                                                ?>
                                                                <a href="rejectrenewal.php?id1=<?php echo $bookid ?>&id2=<?php echo $userid ?>"
                                                                    class="btn btn-danger">Reject</a>
                                                            </center>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->

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