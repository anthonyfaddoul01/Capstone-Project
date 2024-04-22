<?php
require ('dbconn.php');

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
        <?php require ("links.php") ?>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <?php require ("nav.php") ?>
        <section style="margin-top:100px;">
            <div class="card-body row justify-content-center">

                <!-- left column -->
                <div class="col-6">
                    <!-- general form elements -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <div class="section-title pb-0">
                                <p class="mb-0" style="font-size:20px">Change Details</p>
                            </div>
                        </div>
                        <?php
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
                        <form action="edit_user_details.php?id=<?php echo $userid ?>" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" required
                                        value="<?php echo $name ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" id="email"
                                        value="<?php echo $email ?>">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        value="<?php echo $username ?>">
                                </div>
                                <div class="form-group">
                                    <label for="oldpassword">Current Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="oldpassword" id="oldpassword"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>
                                <input name="matchpass" id="matchpass" type="hidden" value="<?php echo $pass ?>">

                            </div>
                            <!-- /.card-body -->

                            <div class="float-right p-3">
                                <button type="submit" name="submit" class="btn btn-warning">Update Details</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row -->

            </div>
        </section>
        <?php require ("scripts.php") ?>

        <?php
        if (isset($_POST['submit'])) {
            $userid = $_GET['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $oldpass = $_POST['oldpassword'];
            $matchpass = $_POST['matchpass'];
            $newpass = empty($_POST['password']) ? $matchpass : $newpass;

            if ($oldpass === $matchpass) {
                $sql1 = "UPDATE bookbud.user SET name=?, email=?, username=?, password=? WHERE userId=?";
                $stmt = $conn->prepare($sql1);
                $stmt->bind_param("ssssi", $name, $email, $username, $newpass, $userid);
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
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>