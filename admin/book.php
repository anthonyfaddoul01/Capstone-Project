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
                            <h1>Books</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="card-body">

                <?php
                //$sql = "select * from bookbud.book";
                $sql = "SELECT bookId, title, author, mainGenre, isAvailable FROM bookbud.book";
                $result = $conn->query($sql);

                ?>
                <form action="excel.php" method="post" style="float: left;">
                    <input type="submit" name="export_excel" class="btn btn-success" value="Export All Books">
                </form>
                <br><br>
                <table class="table table-bordered table-striped" id="example1">
                    <thead>
                        <tr>
                            <th>Book ID No.</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Genre</th>
                            <th>Availability</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <!--<tbody>
                        <?php

                        //$result=$conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            $bookid = $row['bookId'];
                            $title = $row['title'];
                            $author = $row['author'];
                            $genre = $row['mainGenre'];
                            $avail = $row['isAvailable'];

                            ?>
                            <tr>
                                <td>
                                    <?php echo $bookid ?>
                                </td>
                                <td>
                                    <?php echo $title ?>
                                </td>
                                <td>
                                    <?php echo $author ?>
                                </td>
                                <td>
                                    <?php echo $genre ?>
                                </td>
                                <td><b>
                                        <?php echo $avail ?>
                                    </b></td>
                                <td>hi</td>
                                <?php  //add action buttons     ?>

                            </tr>
                        <?php } ?>
                    </tbody>-->
                </table>
            </div>
        </div>
        <!--/.wrapper-->

        <?php require("scripts.php") ?>
        <script>
            // $(document).ready(function () {
            //     $("#example1").DataTable({
            //         "responsive": true, "lengthChange": false, "autoWidth": false, "pageLength": 100
            //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            // });

            $(document).ready(function () {
                var table = $("#example1").DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "serverbook.php",
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "ordering": false,
                    //"searchDelay": 500,
                    "pageLength": 100
                });
                $('#example1 tbody').on('click', '.details-btn', function () {
                    var dataId = $(this).data('id');
                    window.location.href = `bookdetails.php?id=${dataId}`;
                });

                $('#example1 tbody').on('click', '.edit-btn', function () {
                    var dataId = $(this).data('id');
                    window.location.href = `editbookdetails.php?id=${dataId}`;
                });
            });
        </script>

    </body>

    </html>


<?php } else {
    echo "<script>window.location = '../error.php';</script>";
} ?>