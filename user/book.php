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
                if (isset($_POST['submit'])) {
                    $s = $_POST['Textbook'];
                    $sql = "select * from bookbud.book where Section like '%$s%' OR Textbook like '%$s%' OR Status like '%$s%'";
                    // $sql = "select * from LMS.book where BookId = '$s' or Textbook like '%s%' ";
                    // $name=$row['Textbook'];
                    // $rs = $conn->query($sql);
                } else
                    $sql = "select * from bookbud.book";

                $result = $conn->query($sql);
                $rowcount = mysqli_num_rows($result);

                if (!($rowcount))
                    echo "<br><center><h2><b><i>No Results</i></b></h2></center>";
                else {


                    ?>
                    <br><br>
                    <table class="table table-bordered table-striped" id="example">
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
                        <?php
                } ?>

                </table>
            </div>
        </div>
        <!--/.wrapper-->

        <?php require("scripts.php") ?>
        <script>
            $(document).ready(function () {
                var table = $('#example').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "server_processing.php",
                    "pageLength": 100,
                    "columns": [
                        { "data": 0 },
                        { "data": 1 },
                        { "data": 2 },
                        { "data": 3 },
                        {
                            "data": 4,
                            "render": function (data, type, row) {
                                if (data === "Yes") {
                                    return '<span class="text-success"><b>' + data + '</b></span>';
                                } else if (data === "No") {
                                    return '<span class="text-danger"><b>' + data + '</b></span>';
                                } else {
                                    return data;
                                }
                            }
                        }, //make Yes green and No red 
                        { // Actions column doesn't expect data from the server
                            "data": null,
                            "defaultContent": "<div class='d-flex justify-content-center'><button class='btn btn-primary btn-action mr-1'>Details</button> <button class='btn btn-success btn-edit ml-1'>Request</button></div>",
                            "orderable": false
                        }
                    ]
                });
                // Now 'table' is accessible in these event handlers
                $('#example tbody').on('click', '.btn-action', function () {
                    var data = table.row($(this).parents('tr')).data();
                    // Use 'data' as needed...
                    window.location.href = `bookdetails.php?id=${data[0]}`; // adjust as necessary
                });

                $('#example tbody').on('click', '.btn-edit', function () {
                    var data = table.row($(this).parents('tr')).data();
                    // Use 'data' as needed...
                    window.location.href = `requestbook.php?id=${data[0]}`; // adjust as necessary
                });
            });

        </script>

    </body>

    </html>


<?php } else {
    echo "<script>window.location = '../error.php';</script>";
} ?>