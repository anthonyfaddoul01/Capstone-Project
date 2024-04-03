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
        <main id="main">

            <!-- ======= Breadcrumbs ======= -->
            <section class="breadcrumbs">
                <div class="container">

                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Profile</h2>
                        <ol>
                            <li><a href="index.html">Home</a></li>
                            <li>Profile</li>
                        </ol>
                    </div>

                </div>
            </section><!-- End Breadcrumbs -->

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
                        <p>User interface designer and <br /> front-end developer</p>
                        <div class="buttons"><a href="edit_user_details.php">
                            <button class="primary">
                                Edit Details
                            </button></a>
                        </div>
                        <div class="skills">
                            <h6>Interests</h6>
                            <ul>
                                <li>UI / UX</li>
                                <li>Front End Development</li>
                                <li>HTML</li>
                                <li>CSS</li>
                                <li>JavaScript</li>
                                <li>React</li>
                                <li>Node</li>
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
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>