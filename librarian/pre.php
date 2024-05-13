<?php
require ('dbconn.php');

?>

<?php
if ($_SESSION['type'] == 'Librarian') {
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
                            <h1>Previously Borrowed Books</h1>
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
                                    <div class="row justify-content-between">
                                        <!-- <form action="excel2.php" method="post" style="float: left;">
                                            <input type="submit" name="export_excel" class="btn btn-success"
                                                value="Export to Excel">
                                        </form> -->
                                        <?php
                                        $sql = "select record.bookId,id,userId,title,Due_Date,Date_of_Issue,Date_of_Return
                                         from bookbud.record,bookbud.book where Date_of_Issue and Date_of_Return and book.bookid = record.bookId";
                                        $result = $conn->query($sql);
                                        $rowcount = mysqli_num_rows($result);


                                        ?>
                                    </div>


                                    <div class="card-body table-responsive">
                                        <table class="table table-head-fixed text-nowrap" id="example1">
                                            <thead>
                                                <tr>
                                                    <th>Borrower's ID</th>
                                                    <th>Borrower's username</th>
                                                    <th>Book id</th>
                                                    <th>Book name</th>
                                                    <th>Issue Date</th>
                                                    <th>Return Date</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row = $result->fetch_assoc()) {
                                                    
                                                    $id = $row['id'];
                                                    $userid = $row['userId'];
                                                    $bookid = $row['bookId'];
                                                    $title = $row['title'];
                                                    $issuedate = $row['Date_of_Issue'];
                                                    $return = $row['Date_of_Return'];
                                                    $namequery = "SELECT username FROM bookbud.user WHERE userId='$userid'";
                                                    $result2 = $conn->query($namequery);
                                                    $name = $result2->fetch_assoc();
                                                    ?>

                                                    <tr>
                                                        <td>
                                                            <?php echo $userid ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $name['username'] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $bookid ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $title ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $issuedate ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $return ?>
                                                        </td>
                                                        <td>
                                                            <form action="delcu.php" method="post">
                                                                <button onclick="return myFunction2()" name="delete"
                                                                    type="submit" class="btn btn-primary">Delete</button>
                                                                <input type="hidden" name="" value="<?php echo $bookid ?>">
                                                                <script>
                                                                    function myFunction2() {
                                                                        return confirm('Are you sure you want to delete this currently issued book?');
                                                                    }
                                                                </script>


                                                            </form>

                                                        </td>


                                                    <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->

                </div>



            </div>
        </div>
        <!--/.wrapper-->

        <?php require ("scripts.php") ?>
        <script>
            $(document).ready(function () {
                $("#example1").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false, "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            });
        </script>
    </body>

    </html>


<?php } else {
    echo "<script>window.location = '../error.php';</script>";
} ?>