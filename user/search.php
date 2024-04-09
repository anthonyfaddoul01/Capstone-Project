<?php
require ('dbconn.php');
?>

<?php


if ($_SESSION['type'] == 'User') {

    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Search</title>
        <!-- Including jQuery is required. -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <!-- Including our scripting file. -->
        <?php require ("links.php") ?>
        <style>
            .input-text:focus {
                box-shadow: 0px 0px 0px;
                border-color: #f8c146;
                outline: 0px;
            }

            .form-control {
                border: 1px solid #f8c146;
            }

            .imgcontainer {
                height: 400px;
                width: 100%;
                object-fit: fill;
                object-position: center;

            }
        </style>
    </head>

    <body>
        <?php require ('nav.php'); ?>
        <main id="main">
            <section class="mt-5">
            <!-- Search box. -->
            <div class="container justify-content-center mb-3">
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="input-group mb-4">
                            <input type="text" class="form-control input-text" id="searchTerm" placeholder="Search" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- Suggestions will be displayed in below div. -->
            <div class="container">
                <div id="display" class="display row"></div>
            </div>
        </section>
        </main>
        <script>
            function searchBooks(searchTerm, page) {
                $.ajax({
                    url: "searchbytitle.php",
                    type: "GET",
                    data: { searchTerm: searchTerm, page: page },
                    success: function (data) {
                        $('#display').html(data);
                    }
                });
            }

            $(document).ready(function () {
                let searchTerm = $('#searchTerm').val();
                searchBooks(searchTerm, 1); // Initial load

                $('#searchTerm').on('input', function () {
                    searchTerm = $(this).val();
                    searchBooks(searchTerm, 1); // Trigger search with new input
                });
            });
        </script>
        <?php require ("scripts.php") ?>
    </body>

    </html>
<?php } else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>