<?php
require ('dbconn.php');
?>

<?php
if ($_SESSION['type'] == 'Librarian') {
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
                            <h1>Users</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php
                        $sql = "select * from bookbud.user where Type<>'ADMIN' AND Type<>'LIBRARIAN'";
                        $result = $conn->query($sql);
                        ?>
                        <table class="table table-bordered table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th>ID no.</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Balance</th>
                                    <th>Currently borrowed</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                //$result=$conn->query($sql);
                                while ($row = $result->fetch_assoc()) {

                                    $email = $row['email'];
                                    $name = $row['name'];
                                    $id = $row['userId'];
                                    $username = $row['username'];
                                    $balance = $row['balance'];
                                    $borrowedNb = $row['borrowedNb'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $id ?>
                                        </td>
                                        <td>
                                            <?php echo $name ?>
                                        </td>
                                        <td>
                                            <?php echo $username ?>
                                        </td>
                                        <td>
                                            <?php echo $email ?>
                                        </td>
                                        <td>
                                            <?php echo $balance ?>
                                        </td>
                                        <td>
                                            <?php echo $borrowedNb ?>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="userdetails.php?id=<?php echo $id; ?>"
                                                    class="btn btn-success">Details</a>
                                                <a href="paypenalty.php?id=<?php echo $id; ?>"
                                                    class="btn btn-danger">Pay</a>
                                            </center>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!--/.span9-->
                </div>
                <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </section>
        <!-- /.content -->

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