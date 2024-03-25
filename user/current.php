<?php
require('dbconn.php');

?>

<?php
if ($_SESSION['type'] == 'User') {
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
                            <h1>Books</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="card-body">
                <?php
                $userid = $_SESSION['userId'];
                if (isset($_POST['submit'])) { //need to make a search bar same as in admin
                    $s = $_POST['Textbook'];
                    $sql = "select * from bookbud.record,bookbud.book where userId = '$userid' 
                                            and Date_of_Issue is NOT NULL and Date_of_Return is NULL 
                                            and book.bookid = record.bookId and (record.bookId='$s' or title like '%$s%')";

                } else
                    $sql = "select * from bookbud.record,bookbud.book where userId = '$userid' 
                and Date_of_Issue is NOT NULL and Date_of_Return is NULL and book.bookid = record.bookId";

                $result = $conn->query($sql);

                ?>
                <table class="table table-bordered table-striped" id="example2">
                    <thead>
                        <tr>
                            <th>Book ID</th>
                            <th>Title</th>
                            <th>Issue Date</th>
                            <th>Due Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php


                        while ($row = $result->fetch_assoc()) {
                            $bookid = $row['bookId'];
                            $name = $row['title'];
                            $issuedate = $row['Date_of_Issue'];
                            $duedate = $row['Due_Date'];
                            $renewals = $row['Renewals_left'];
                            ?>

                            <tr>
                                <td>
                                    <?php echo $bookid ?>
                                </td>
                                <td>
                                    <?php echo $name ?>
                                </td>
                                <td>
                                    <?php echo $issuedate ?>
                                </td>
                                <td>
                                    <?php echo $duedate ?>
                                </td>
                                <td>
                                    <center>
                                        <?php
                                        if ($renewals)
                                            echo "<a href=\"renew_request.php?id=" . $bookid . "\" class=\"btn btn-success\">Renew</a>";
                                        ?>
                                        <a href="return_request.php?id=<?php echo $bookid; ?>"
                                            class="btn btn-danger">Return</a>
                                    </center>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
        <!--/.wrapper-->

        <?php require("scripts.php") ?>
        <script>
            $(document).ready(function () {
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "pageLength": 15
                });

            });

        </script>

    </body>

    </html>


<?php } else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>