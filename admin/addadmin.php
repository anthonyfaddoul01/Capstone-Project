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
                            <h1>Add Admin</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="card-body row justify-content-center">

                <!-- left column -->
                <div class="col-6">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <?php //must remove??
                        $userid = $_SESSION['userId'];
                        $sql = "select * from bookbud.user where userId='$userid'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();

                        $name = $row['name'];
                        $email = $row['email'];
                        $username = $row['username'];
                        $pass = $row['password'];
                        ?>
                        <!-- form start -->
                        <form action="addadmin.php" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" required
                                        placeholder="Enter admin name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="email" id="email"
                                        placeholder="Enter admin email" required>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        placeholder="Enter admin username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Enter admin password" required>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer float-right">
                                <button type="submit" name="submit" class="btn btn-success">Add Admin</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row -->

            </div>
        </div>
        <!--/.wrapper-->

        <?php require("scripts.php") ?>

        <?php
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $pass = $_POST['password'];
            $type = "Admin";


            $sql = "insert into bookbud.user (name,username,email,password,type) values ('$name','$email','$username','$pass','$type')";
            if ($conn->query($sql)) {
                echo "<script>alert('Success'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Error: " . $conn->error . "');</script>";
            }

        }
        ?>
    </body>

    </html>


<?php } else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>