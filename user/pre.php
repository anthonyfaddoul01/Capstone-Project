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
                    <h3 class="text-center mb-4">Previous Borrowed Books</h3>
                    <div class="table-wrap">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr>
                                    <th>Title</th>
                                    <th>Issue Date</th>
                                    <th>Return Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $userid = $_SESSION['userId'];
                                $sql = "select * from bookbud.record,bookbud.book where userId = '$userid' 
                and Date_of_Issue != '0000-00-00' and Date_of_Return != '0000-00-00' and book.bookid = record.bookId";

                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    $bookid = $row['bookId'];
                                    $name = $row['title'];
                                    $issuedate = $row['Date_of_Issue'];
                                    $returndate = $row['Date_of_Return'];
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
                                            <?php echo $returndate ?>
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
    echo "<script>window.location = '../error.php';</script>";
} ?>