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
                                and Date_of_Issue != '0000-00-00' and Date_of_Return is NULL and book.bookid = record.bookId";

                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    $bookid = $row['bookId'];
                                    $name = $row['title'];
                                    $issuedate = $row['Date_of_Issue'];
                                    $duedate = $row['Due_Date'];
                                    $renewals = $row['Renewals_left'];
                                    $dues = $row['Dues'];
                                    $pen = $row['Penalty'];
                                    ?>
                                    <tr>
                                        <th scope="row" class="scope">
                                            <a class="text-black"
                                                href="bookdetails.php?id=<?php echo $bookid ?>"><?php echo $name ?></a>
                                        </th>
                                        <td>
                                            <?php echo $issuedate ?>
                                        </td>
                                        <td>
                                            <?php echo $duedate ?>
                                        </td>
                                        <th scope="row" class="scope text-danger"><?php echo $dues ?></th>
                                        <td><?php echo $pen ?>$</td>
                                        <td>
                                            <center>
                                                <?php
                                                if ($renewals)
                                                    echo "<a class='btn btn-success renew'>Renew</a>";
                                                ?>
                                                <a class="btn btn-danger return">Return</a>
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
        <div id="messageModal"
            style="display:none; position: fixed; z-index: 1000; left: 50%; top: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border: 1px solid #ddd; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0,0,0,0.5);">
            <p id="modalText">...</p>
        </div>
        <!--/.wrapper-->

        <?php require ("scripts.php") ?>
        <script>
            function showMessageModal(message, className) {
                var modalText = document.getElementById('modalText');
                modalText.className = '';
                modalText.classList.add(className);
                modalText.innerText = message;
                document.getElementById('messageModal').style.display = 'block';
                setTimeout(function () {
                    document.getElementById('messageModal').style.display = 'none';
                }, 3000);
            }
            $(document).ready(function () {
                $(".renew").click(function (e) {
                    e.preventDefault();
                    var bookid = $(this).closest("tr").find("a.text-black").attr("href").split('=')[1];
                    var userid = "<?php echo $userid; ?>";
                    $.ajax({
                        type: "GET",
                        url: "renew_request.php",
                        data: { id: bookid, userid: userid },
                        success: function (response) {
                            if (response.trim() === "success") {
                                showMessageModal("Request Sent Successfully.", "text-warning");
                            } else if (response.trim() === "error") {
                                showMessageModal("You have already made this request.", "text-danger");
                            }
                        },
                        error: function () {
                            showMessageModal("Error occurred. Please try again later.", "text-danger");
                        }
                    });
                });

                $(".return").click(function (e) {
                    e.preventDefault();
                    var bookid = $(this).closest("tr").find("a.text-black").attr("href").split('=')[1];
                    var userid = "<?php echo $userid; ?>";
                    $.ajax({
                        type: "GET",
                        url: "return_request.php",
                        data: { id: bookid, userid: userid },
                        success: function (response) {
                            if (response.trim() === "success") {
                                showMessageModal("Request Sent Successfully.", "text-warning");
                            } else if (response.trim() === "error") {
                                showMessageModal("You have already made this request.", "text-danger");
                            }
                        },
                        error: function () {
                            showMessageModal("Error occurred. Please try again later.", "text-danger");
                        }
                    });
                });
            });
        </script>

    </body>

    </html>


<?php } else {
    echo "<script>window.location = '../error.php';</script>";
} ?>