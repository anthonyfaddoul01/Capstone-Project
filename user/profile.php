<?php
require ('dbconn.php');
?>

<?php


if ($_SESSION['type'] == 'User') {

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Library</title>
        <?php require ("links.php") ?>

    </head>

    <body>
        <?php require ('nav.php'); ?>
        <script>
            const element = document.getElementById("header");
            element.classList.remove("fixed-top");
        </script>
        <main id="main" class="container">
            <section class="inner-page">
                <div class="d-flex justify-content-center">
                    <div class="card-container">
                        <img class="round" src="images/user.png" alt="user" />
                        <h3>
                            <?php echo $username ?>
                        </h3>
                        <h6>
                            <?php echo $email ?>
                        </h6>
                        <p>Balance: <?php echo $bal ?>$</p>
                        <div class="buttons"><a href="edit_user_details.php">
                                <button class="primary">
                                    Change Password
                                </button></a>
                            <a href="message.php">
                                <button class="primary">
                                    Messages
                                </button></a>
                        </div>
                        <div class="skills">
                            <h6>Interests</h6>
                            <ul>
                                <?php
                                $l = explode(", ", $interests);
                                for ($i = 0; $i < count($l); $i++) {
                                    echo "<li>" . $l[$i] . "</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

        </main><!-- End #main -->
        <?php require ("footer.php") ?>

        <?php require ("scripts.php") ?>
    </body>

    </html>


<?php } else {
    echo "<script>window.location = '../error.php';</script>";
} ?>