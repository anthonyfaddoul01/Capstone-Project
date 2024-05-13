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
                            <h1>Send Message</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="card-body">

                <div class="col">
                    <!-- Box Comment -->
                    <div class="card card-widget">
                        <div class="row">
                            <div class="col-12 p-3">

                                <form class="form-horizontal row-fluid" action="send_message.php" method="post">
                                    <div class="control-group col-6">
                                        <label class="control-label" for="userId"><b>Receiver ID No:</b></label>
                                        <input type="text" id="userId" name="userId" placeholder="Id No"
                                            class="form-control" required>
                                    </div>
                                    <div class="control-group col-6">
                                        <label class="control-label" for="Sender"><b>Sender's Name:</b></label>
                                        <input type="text" id="Sender" name="Sender" placeholder="Input your name"
                                            class="form-control" required>
                                    </div>
                                    <div class="control-group col-6">
                                        <label class="control-label" for="Message"><b>Message:</b></label>
                                        <input type="text" id="Message" name="Message" placeholder="Enter Message"
                                            class="form-control" required>
                                        <hr>
                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" name="submit" class="btn btn-success">Send
                                                    Message</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!--/.wrapper-->

        <?php require ("scripts.php") ?>
        <?php
        if (isset($_POST['submit'])) {
            $userid = $_POST['userId'];
            $message = $_POST['Message'];
            $Sender = $_POST['Sender'];

            $sql1 = "insert into bookbud.message (userId,Sender,Msg,Date,Time) values ('$userid','$Sender','$message',curdate(),curtime())";

            if ($conn->query($sql1) === TRUE) {
                echo "<script type='text/javascript'>alert('Success')</script>";
            } else {//echo $conn->error;
                echo "<script type='text/javascript'>alert('Error')</script>";
            }

        }
        ?>
    </body>

    </html>


<?php } else {
    echo "<script>window.location = '../error.php';</script>";
} ?>