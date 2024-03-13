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
                        <form class="form-horizontal row-fluid" action="user.php" method="post">
                            <div class="control-group">
                                <label class="control-label" for="Search"><b>Search:</b></label>
                                <div class="controls">
                                    <input type="text" id="title" name="title" placeholder="Enter Name/ID No of Student"
                                        class="span8" required>
                                    <button type="submit" name="submit" class="btn">Search</button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <?php
                        if (isset($_POST['submit'])) {
                            $s = $_POST['title'];
                            $sql = "select * from bookbud.user where (userId='$s' or name like '%$s% or username like '%$s%') 
                            and Type<>'ADMIN'";
                        } else
                            $sql = "select * from bookbud.user where Type<>'ADMIN'";

                        $result = $conn->query($sql);
                        $rowcount = mysqli_num_rows($result);

                        if (!($rowcount))
                            echo "<br><center><h2><b><i>No Results</i></b></h2></center>";
                        else {


                            ?>
                            <table class="table" id="tables">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>ID No.</th>
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
                                                <?php echo $name ?>
                                            </td>
                                            <td>
                                                <?php echo $id ?>
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
                                                    <!--a href="remove_student.php?id=<?php echo $id; ?>" class="btn btn-danger">Remove</a-->
                                                </center>
                                            </td>
                                        </tr>
                                    <?php }
                        } ?>
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
    </body>

    </html>


<?php } else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>