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
        <link rel="stylesheet" href="assets/css/style2.css">
        <?php require ("links.php") ?>

    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <?php require ("nav.php") ?>
        <section class="container" style="padding-top:100px;">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center mb-4">Current Issued Books</h3>
                    <div class="table-wrap">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr>
                                    <th>Title</th>
                                    <th>Issue Date</th>
                                    <th>Due Date</th>
                                    <th>Dues</th>
                                    <th>Penalty</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $userid = $_SESSION['userId'];
                                $sql = "select * from bookbud.record,bookbud.book where userId = '$userid' 
                                and Date_of_Issue is NOT NULL and Date_of_Return is NULL and book.bookid = record.bookId";

                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    $bookid = $row['bookId'];
                                    $name = $row['title'];
                                    $issuedate = $row['Date_of_Issue'];
                                    $duedate = $row['Due_Date'];
                                    $renewals = $row['Renewals_left'];
                                    ?>
                                    <tr>
                                        <th scope="row" class="scope">
                                            <?php echo $name ?>
                                        </th>
                                        <td>
                                            <?php echo $issuedate ?>
                                        </td>
                                        <td>
                                            <?php echo $duedate ?>
                                        </td>
                                        <th scope="row" class="scope text-danger">10</th>
                                        <td>10$</td>
                                        <td>
                                            <center>
                                                <?php
                                                if ($renewals)
                                                    echo "<a href=\"renew_request.php?id=" . $bookid . "\" class=\"btn btn-success\">Renew</a>";
                                                ?>
                                                <a href="return_request.php?id=<?php echo $bookid; ?>"
                                                    class="btn btn-danger">Return</a>
                                            </center>
                                        </td>

                                    </tr>


                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!--/.wrapper-->

        <?php require ("scripts.php") ?>
        <script>


        </script>

    </body>

    </html>


<?php } else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>