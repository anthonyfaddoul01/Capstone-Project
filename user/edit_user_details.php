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
                                <p class="mb-0" style="font-size:20px">Change Password</p>
                            </div>
                        </div>
                        <?php
                        $userid = $_SESSION['userId'];
                        $sql = "select * from bookbud.user where userId='$userid'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $pass = $row['password'];
                        ?>
                        <!-- form start -->
                        <form id="updateForm" action="edit_user_details.php?id=<?php echo $userid ?>" method="post">
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

                            <div class="float-right p-3">
                                <button type="submit" name="submit" class="btn btn-warning">Update Password</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row -->
                <!-- Success Modal -->
                <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="successModalLabel">Change Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Password has been changed successfully.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Error Modal -->
                <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Current password is not correct. Please try again.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
                    echo "<script>$(document).ready(function() { $('#successModal').modal('show'); });</script>";
                } else {
                    echo "<script>alert('Error: " . $conn->error . "');</script>";
                }
            } else {
                echo "<script>$(document).ready(function() { $('#errorModal').modal('show'); });</script>";
            }
        }
        ?>
    </body>

    </html>


<?php } else {
    echo "<script>window.location = '../error.php';</script>";
} ?>