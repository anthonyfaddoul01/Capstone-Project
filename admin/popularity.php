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
        <title>Statistics</title>
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
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Monthly Checkouts -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Monthly Checkouts</h3>
                                </div>
                                <div class="card-body" style="height:500px;">
                                    <canvas id="checkoutsChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Yearly Checkouts -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Yearly Checkouts</h3>
                                </div>
                                <div class="card-body" style="height:500px;">
                                    <canvas id="checkoutsChart2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Late Returns -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Late Returns</h3>
                                </div>
                                <div class="card-body" style="height:500px;">
                                    <canvas id="lateReturnsChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Penalty Revenue -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Fines Revenue</h3>
                                </div>
                                <div class="card-body" style="height:500px;">
                                    <canvas id="finesRevenueChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Books age -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Books Age</h3>
                                </div>
                                <div class="card-body" style="height:500px;">
                                    <canvas id="bookPublicationYearHistogram"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Books age -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Users</h3>
                                </div>
                                <div class="card-body" style="height:500px;">
                                    <canvas id="membershipGrowthChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <canvas id="checkoutsChart"></canvas>
        <script>
            $(document).ready(function () {
                $.ajax({
                    url: 'http://127.0.0.1:5000/genre',
                    type: 'GET',
                    success: function (response) {
                        setupChart(response);
                    },
                    error: function (error) {
                        console.error('Error fetching data:', error);
                    }
                });
                $.ajax({
                    url: 'monthly.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        const labels = data.map(item => item.Month);
                        const checkouts = data.map(item => parseInt(item.TotalCheckouts));

                        const ctx = document.getElementById('checkoutsChart').getContext('2d');
                        const checkoutsChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Monthly Checkouts',
                                    data: checkouts,
                                    borderColor: 'rgb(75, 192, 192)',
                                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                                    fill: true,
                                    tension: 0.1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                responsive: true,
                                maintainAspectRatio: false
                            }
                        });
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error("AJAX Error: " + textStatus + ": " + errorThrown);
                        console.error("Response: " + jqXHR.responseText);
                    }
                });
                $.ajax({
                    url: 'yearly.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        const labels = data.map(item => item.Year);
                        const checkouts = data.map(item => parseInt(item.TotalCheckouts));

                        const ctx = document.getElementById('checkoutsChart2').getContext('2d');
                        const checkoutsChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Yearly Checkouts',
                                    data: checkouts,
                                    borderColor: 'rgb(75, 192, 192)',
                                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                                    fill: true,
                                    tension: 0.1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                responsive: true,
                                maintainAspectRatio: false
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error("An error occurred: " + error);
                    }
                });
                $.ajax({
                    url: 'latereturns.php', 
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        const months = data.map(item => item.ReturnMonth);
                        const lateReturns = data.map(item => parseInt(item.LateReturns));

                        const ctx = document.getElementById('lateReturnsChart').getContext('2d');
                        const lateReturnsChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: months,
                                datasets: [{
                                    label: 'Late Returns',
                                    data: lateReturns,
                                    backgroundColor: 'rgba(255, 99, 132, 0.7)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                responsive: true,
                                maintainAspectRatio: false
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error("An error occurred: " + error);
                    }
                });
                $.ajax({
                    url: 'agebooks.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        console.log(data); 

                        const publicationYears = data.map(item => item.yearOfPublication);
                        const numberOfBooks = data.map(item => item.NumberOfBooks);

                        console.log("Publication Years:", publicationYears); 
                        console.log("Number of Books:", numberOfBooks); 

                        const ctx = document.getElementById('bookPublicationYearHistogram').getContext('2d');
                        const bookPublicationYearHistogram = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: publicationYears,  
                                datasets: [{
                                    label: 'Number of Books',
                                    data: numberOfBooks,
                                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Number of Books'
                                        }
                                    },
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Year of Publication'
                                        }
                                    }
                                },
                                responsive: true,
                                maintainAspectRatio: false
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error("An error occurred: ", error);
                    }
                });
                $.ajax({
                    url: 'userstat.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        const months = data.map(item => item.MembershipMonth);
                        const newMemberships = data.map(item => item.NewMemberships);

                        const ctx = document.getElementById('membershipGrowthChart').getContext('2d');
                        const membershipGrowthChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: months,
                                datasets: [{
                                    label: 'New Memberships',
                                    data: newMemberships,
                                    borderColor: 'rgb(54, 162, 235)',
                                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                    fill: true,
                                    tension: 0.1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                responsive: true,
                                maintainAspectRatio: false
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error("An error occurred: " + error);
                    }
                });
                $.ajax({
                    url: 'penaltymonthly.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        const months = data.map(item => item.Month);
                        const totalFines = data.map(item => parseFloat(item.TotalFines));

                        const ctx = document.getElementById('finesRevenueChart').getContext('2d');
                        const finesRevenueChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: months,
                                datasets: [{
                                    label: 'Revenue from Fines',
                                    data: totalFines,
                                    borderColor: 'rgb(255, 99, 132)',
                                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                                    fill: true,
                                    tension: 0.1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                responsive: true,
                                maintainAspectRatio: false
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error("An error occurred: " + error);
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
                    $list.empty();
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