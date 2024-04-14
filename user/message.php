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
        <style>
            .pagination {
                float: right;
                text-align: right;
                padding: 20px 0;
            }

            .pagination button {
                margin-left: 5px;
                padding: 5px 15px;
                background-color: #007bff;
                border: none;
                border-radius: 5px;
                color: white;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .pagination button:hover,
            .pagination button:focus {
                background-color: #0056b3;
                outline: none;
            }

            .pagination button:disabled {
                background-color: #cccccc;
                cursor: not-allowed;
            }
        </style>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <?php require ("nav.php") ?>
        <section class="container" style="padding-top:100px;">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center mb-4">Messages</h3>
                    <div class="table-wrap">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th></th>
                                    <th></th>
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

                                    $requestDateTimeString = $date . ' ' . $time;
                                    $requestDateTime = new DateTime($requestDateTimeString);
                                    $now = new DateTime();
                                    $interval = $now->diff($requestDateTime);
                                    ?>
                                    <tr>
                                        <th scope="row" class="scope">
                                                <?php echo $msg ?>
                                        </th>
                                        <td>
                                            <?php echo $date ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($interval->y > 0) {
                                                echo $interval->y . " year" . ($interval->y > 1 ? "s" : "") . " ago";
                                            } elseif ($interval->m > 0) {
                                                echo $interval->m . " month" . ($interval->m > 1 ? "s" : "") . " ago";
                                            } elseif ($interval->d > 0) {
                                                echo $interval->d . " day" . ($interval->d > 1 ? "s" : "") . " ago";
                                            } elseif ($interval->h > 0) {
                                                echo $interval->h . " hour" . ($interval->h > 1 ? "s" : "") . " ago";
                                            } elseif ($interval->i > 0) {
                                                echo $interval->i . " minute" . ($interval->i > 1 ? "s" : "") . " ago";
                                            } else {
                                                echo $interval->s . " second" . ($interval->s > 1 ? "s" : "") . " ago";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <center>
                                                <form action="dele.php" method="post"><button type="submit" name="delete"
                                                        class="btn btn-danger">Delete</button><input type="hidden" name="M_Id"
                                                        value="<?php echo $id ?>"></form>
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
            document.addEventListener('DOMContentLoaded', function () {
                const rowsPerPage = 10;
                const table = document.querySelector('.table');
                const rows = table.querySelectorAll('tbody tr');
                const numRows = rows.length;
                const numPages = Math.ceil(numRows / rowsPerPage);
                let currentPage = 1; // Track the current page

                function displayPage(page) {
                    rows.forEach((row, index) => {
                        row.style.display = (index >= (page - 1) * rowsPerPage && index < page * rowsPerPage) ? '' : 'none';
                    });
                }

                function setupPagination() {
                    const paginationWrapper = document.createElement('div');
                    paginationWrapper.className = 'pagination';

                    const prevBtn = document.createElement('button');
                    prevBtn.innerHTML = '&laquo;'; // Left-pointing double angle quotation mark
                    prevBtn.onclick = () => {
                        if (currentPage > 1) {
                            displayPage(--currentPage);
                        }
                        updateButtonStates();
                    };

                    const nextBtn = document.createElement('button');
                    nextBtn.innerHTML = '&raquo;'; // Right-pointing double angle quotation mark
                    nextBtn.onclick = () => {
                        if (currentPage < numPages) {
                            displayPage(++currentPage);
                        }
                        updateButtonStates();
                    };

                    paginationWrapper.appendChild(prevBtn);
                    paginationWrapper.appendChild(nextBtn);
                    table.parentNode.insertBefore(paginationWrapper, table.nextSibling);

                    updateButtonStates();
                }

                function updateButtonStates() {
                    document.querySelector('.pagination button:first-child').disabled = currentPage === 1;
                    document.querySelector('.pagination button:last-child').disabled = currentPage === numPages;
                }

                displayPage(1);
                setupPagination();
            });
        </script>


    </body>

    </html>


<?php } else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>