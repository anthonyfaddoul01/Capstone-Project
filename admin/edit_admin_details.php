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
                            <h1>Edit Details</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="card-body row justify-content-center">

                <!-- left column -->
                <div class="col-6">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <?php
                        $userid = $_SESSION['userId'];
                        $sql = "select * from bookbud.user where userId='$userid'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $pass = $row['password'];
                        ?>
                        <!-- form start -->
                        <form action="edit_admin_details.php?id=<?php echo $userid ?>" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="oldpassword">Current Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="oldpassword" id="oldpassword"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="password">New Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" id="password" required
                                        oninput="updateCustomMessage(this)">
                                </div>
                                <input name="matchpass" id="matchpass" type="hidden" value="<?php echo $pass ?>">

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer float-right">
                                <button type="submit" name="submit" class="btn btn-success">Update Password</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row -->

            </div>
        </div>
        <!--/.wrapper-->
        <script>
            function updateCustomMessage(input) {
                var oldpass = "<?php echo $pass; ?>";
                if (!input.value) {
                    input.setCustomValidity('Please fill in this field.');
                } else {
                    input.setCustomValidity('');
                    if (!/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}/.test(input.value)) {
                        input.setCustomValidity('Password must be at least 8 characters with one uppercase, one lowercase, one number, and one special character.');
                    }
                    else if (input.value === oldpass) {
                        input.setCustomValidity('New password cannot be the same as the current password.');
                    }
                }
                input.reportValidity();
            }
        </script>
        <?php require ("scripts.php") ?>

        <?php
        if (isset($_POST['submit'])) {
            $userid = $_GET['id'];
            $oldpass = $_POST['oldpassword'];
            $matchpass = $_POST['matchpass'];
            $newpass = $_POST['password'];

            if ($oldpass === $matchpass && $newpass != $matchpass) {
                $sql1 = "UPDATE bookbud.user SET password=? WHERE userId=?";
                $stmt = $conn->prepare($sql1);
                $stmt->bind_param("si", $newpass, $userid);
                if ($stmt->execute()) {
                    echo "<script>alert('Success'); window.location.href='index.php';</script>";
                } else {
                    echo "<script>alert('Error: " . $conn->error . "');</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('Current password is not correct')</script>";
            }
        }
        ?>
    </body>

    </html>


<?php } else {
    echo "<script>window.location = '../error.php';</script>";
} ?>