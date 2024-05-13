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
                            <h1>Messages</h1>
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
                                <table class="table" id="tables">
                                    <thead>
                                        <tr>
                                            <th>Sender</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Delete</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $userid = $_SESSION['userId'];
                                        $sql = "select * from bookbud.message where userId='$userid' order by Date DESC,Time DESC";
                                        $result = $conn->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row['M_Id'];
                                            $rcv = $row['Sender'];
                                            $msg = $row['Msg'];
                                            $date = $row['Date'];
                                            $time = $row['Time'];

                                            ?>

                                            <tr>
                                                <td>
                                                    <?php echo $rcv ?>
                                                </td>
                                                <td>
                                                    <?php echo $msg ?>
                                                </td>
                                                <td>
                                                    <?php echo $date ?>
                                                </td>
                                                <td>
                                                    <?php echo $time ?>
                                                </td>
                                                <td>
                                                    <center>
                                                        <form action="delmessage.php" method="post">
                                                            <button onclick="return myFunction2()" name="delete" type="submit"
                                                                class="btn btn-primary">Delete </button>
                                                            <script>
                                                                function myFunction2() {
                                                                    return confirm('Are you sure you want to delete this message?');
                                                                } 
                                                            </script>
                                                            <input type="hidden" name="M_Id" value="<?php echo $id ?>">

                                                        </form>
                                                        <center>
                                                </td>

                                            </tr>
                                        <?php } ?>


                                    </tbody>
                                </table>

                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.wrapper-->

        <?php require ("scripts.php") ?>

    </body>

    </html>


<?php } else {
    echo "<script>window.location = '../error.php';</script>";
} ?>