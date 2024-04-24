<?php
require ('dbconn.php');
?>

<?php


if ($_SESSION['type'] == 'User') {

    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Favorites</title>
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
                <div class="container">
                    <div class="section-title pb-0">
                        <p class="mb-3">My Favorite Books</p>
                    </div>
                    <div id="display" class="display row"></div>
                </div>
            </section>
        </main>
        <script>
            function searchBooks(page) {
                $.ajax({
                    url: "getfavorites.php",
                    type: "GET",
                    data: {page: page },
                    success: function (data) {
                        $('#display').html(data);
                    }
                });
            }

            $(document).ready(function () {
                searchBooks(1);
            });
        </script>
        <?php require ("scripts.php") ?>
    </body>

    </html>
<?php } else {
    echo "<script>window.location = '../error.php';</script>";
} ?>