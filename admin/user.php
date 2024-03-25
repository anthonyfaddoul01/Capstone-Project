<?php
require('dbconn.php');
?>

<?php
if ($_SESSION['userId'] == '1') {
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
        <?php require("nav.php") ?>
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
                        $sql = "select * from bookbud.user where Type<>'ADMIN'";
                        $result = $conn->query($sql);
                            ?>
                            <table class="table table-bordered table-striped" id="example1">
                                <thead>
                                    <tr>
                                        <th>ID no.</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
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
                                                <center>
                                                    <a href="userdetails.php?id=<?php echo $id; ?>"
                                                        class="btn btn-success">Details</a>
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

        <?php require("scripts.php") ?>
        <script>
            $(document).ready(function () {
                $("#example1").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,"ordering": false,
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            });

        </script>
    </body>

    </html>


<?php } else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>