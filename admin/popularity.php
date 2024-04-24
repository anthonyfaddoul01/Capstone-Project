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
        <title>Genre Recommendations</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <?php require ('links.php'); ?>

    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <?php require ('nav.php'); ?>

        <div class="content-wrapper">
            <section class="content p-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Pie chart card -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Top Genres</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="genrePieChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Book details card -->
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Books in Selected Genre</h3>
                                </div>
                                <div class="card-body">
                                    <ul id="bookList" class="list-unstyled">
                                        <!-- Book details will be inserted here -->
                                    </ul>
                                </div>
                            </div>
                            <!-- Book details card -->
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Books in Selected Genre</h3>
                                </div>
                                <div class="card-body">
                                    <ul id="bookList" class="list-unstyled">
                                        <!-- Book details will be inserted here -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <script>
            $(document).ready(function () {
                $.ajax({
                    url: 'http://127.0.0.1:5000/test',
                    type: 'GET',
                    success: function (response) {
                        setupChart(response);
                    },
                    error: function (error) {
                        console.error('Error fetching data:', error);
                    }
                });

                function setupChart(data) {
                    var genreLabels = Object.keys(data);
                    var popularityData = genreLabels.map(genre => data[genre].total_popularity);

                    var ctx = document.getElementById('genrePieChart').getContext('2d');
                    var genrePieChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: genreLabels,
                            datasets: [{
                                data: popularityData,
                                backgroundColor: [
                                    'red', 'blue', 'green', 'yellow', 'purple',
                                    'orange', 'cyan', 'magenta', 'lime', 'pink'
                                ],
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    enabled: true
                                }
                            },
                            onClick: function (evt, element, chart) {
                                if (element.length > 0) {
                                    var clickedIndex = element[0].index;
                                    var clickedGenre = chart.data.labels[clickedIndex];
                                    displayBooks(data[clickedGenre].books);
                                }
                            }
                        }
                    });
                }

                function displayBooks(books) {
                    var $list = $('#bookList');
                    $list.empty(); // Clear previous entries
                    books.forEach(function (book) {
                        $list.append(`<li><span class="font-weight-bold">${book.title}</span> by ${book.author} - Popularity Score: ${book.popularityScore.toFixed(2)}</li>`);
                    });
                }
            });
        </script>
    </body>

    </html>
<?php } else {
    echo "<script>window.location = '../error.php';</script>";
} ?>