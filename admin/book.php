<?php
require ('dbconn.php');

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
                            <h1>Books</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="card">

                    <?php
                    //$sql = "select * from bookbud.book";
                    $sql = "SELECT bookId, title, author, mainGenre, isAvailable FROM bookbud.book";
                    $result = $conn->query($sql);

                    ?>
                     <form action="excel.php" method="post" class="pl-4 pt-4">
                    <input type="submit" name="export_excel" class="btn btn-success" value="Export All Books With all details">
                </form>
                
                    <div class="card-body">
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

                        </table>
                    </div>
                </div>
            </section>
        </div>
        <!--/.wrapper-->

        <?php require ("scripts.php") ?>
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
                    "pageLength": 100,
                    "dom": 'Bfrtip',
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                });
                table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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