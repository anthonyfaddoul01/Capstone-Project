<?php
require('dbconn.php');
?>

<?php 


if ($_SESSION['userId'] == '1' ) {

    ?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Library</title>
        <?php require("links.php")?>
       
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
    <?php require('nav.php');?>
    
        <div class="content-wrapper">
            
                    <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1>Profile</h1>
                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </section>
            <div class="row justify-content-center">
                    <div class="col-6 align-self-center">
                        <div class="d-flex justify-content-center">
                            <!-- Profile Image -->
                            <div class="card card-primary card-outline col-5">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="img-fluid img-circle"
                                            src="images/profile2.png"
                                            alt="User profile picture">
                                    </div>
                                         
                                        <h3 class="profile-username text-center"><?php echo $name ?></h3>

                                        <p class="text-muted text-center"><?php echo $type ?></p>

                                        <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Email</b> <a class="float-right"><?php echo $email ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Username</b> <a class="float-right"><?php echo $username ?></a>
                                        </li>
                                        </ul>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <br>
                        <div class="d-flex justify-content-between">
                            <a href="edit_admin_details.php" class="btn btn-primary">Edit Details</a>
                            <a href="addadmin.php" class="btn btn-primary">Add admin</a>

                            <a href="addstaff.php" class="btn btn-primary">Add Library staff/Librarian</a>
                            <a href="../staff/index.php" class="btn btn-primary">Go to staff domain</a>
                            <a href="../librarian/index.php" class="btn btn-primary">Go to librarian domain</a>   
                        </div>          
                    </div>
            </div>
            <!--/.container-->

        </div>
        <!--/.wrapper-->
    
        
        <?php require("scripts.php")?>
    </body>

</html>


<?php }
else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>