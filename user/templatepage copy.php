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
        <style>
            .cover {
                position: relative;
                padding: 0px 30px;
                margin-top: 100px;
            }

            .left {
                position: absolute;
                left: 0;
                top: 50%;
                transform: translateY(-50%);
            }

            .right {
                position: absolute;
                right: 0;
                top: 50%;
                transform: translateY(-50%);
            }

            .scroll-images {
                position: relative;
                width: 100%;
                padding: 40px 0px;
                height: auto;
                display: flex;
                flex-wrap: nowrap;
                overflow-x: hidden;
                overflow-y: hidden;
                scroll-behavior: smooth;
                -webkit-overflow-scrolling: touch;
            }

            .child {
                display: flex;
                justify-content: center;
                align-items: center;
                min-width: 300px;
                height: 800px;
                padding: 0px 15px;
                margin: 1px 10px;
                border: 1px solid #f1f1f1;
                overflow: hidden;
                -webkit-box-shadow: 0px 0px 15px 2px rgb(0 0 0 / 10%);
                ;
                box-shadow: 0px 0px 15px 2px rgb(0 0 0 / 10%);
                ;
            }

            .scroll-images::-webkit-scrollbar {
                width: 5px;
                height: 8px;
                background-color: #aaa;
            }

            .scroll-images::-webkit-scrollbar-thumb {
                background-color: black;
            }

            button {
                background-color: transparent;
                border: none;
                outline: none;
                cursor: pointer;
                font-size: 25px;
            }

            .imgcontainer {
                height: 400px;
                width: 100%;
                object-fit: cover;
                object-position: center;

            }
        </style>
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
                <div class="card-body">
                    <?php
                    $userid = $_SESSION['userId'];
                    if (isset($_POST['submit'])) { //need to make a search bar same as in admin
                        $s = $_POST['Textbook'];
                        $sql = "select * from bookbud.record,bookbud.book where userId = '$userid' 
                                            and Date_of_Issue is NOT NULL and Date_of_Return is NULL 
                                            and book.bookid = record.bookId and (record.bookId='$s' or title like '%$s%')";

                    } else
                        $sql = "select * from bookbud.record,bookbud.book where userId = '$userid' 
                            and Date_of_Issue is NOT NULL and Date_of_Return is NULL and book.bookid = record.bookId";

                    $result = $conn->query($sql);

                    ?>

                    <div class="cover px-4 px-lg-5 mt-5">
                        <button class="left" onclick="leftScroll()">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        <div class="scroll-images ">
                            <?php


                            while ($row = $result->fetch_assoc()) {
                                $bookid = $row['bookId'];
                                $name = $row['title'];
                                $issuedate = $row['Date_of_Issue'];
                                $duedate = $row['Due_Date'];
                                $rating = $row['rating'];
                                $author = $row['author'];
                                $img = $row['coverImage'];
                                ?>

                                <div class="col mb-5">
                                    <div class="card" style="width: 18rem;">
                                        <a href="bookdetails.php?id=<?php echo $bookid ?>"><img src="<?php echo $img ?>" class="card-img-top imgcontainer"></a>
                                    </div>
                                </div>

                                <!--
                                        <center>
                                            <?php
                                            if ($renewals)
                                                echo "<a href=\"renew_request.php?id=" . $bookid . "\" class=\"btn btn-success\">Renew</a>";
                                            ?>
                                            <a href="return_request.php?id=<?php echo $bookid; ?>"
                                                class="btn btn-danger">Return</a>
                                        </center>-->
                            <?php } ?>

                        </div>
                        <button class="right" onclick="rightScroll()">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </section>

        </main><!-- End #main -->
        <?php require ("footer.php") ?>

        <?php require ("scripts.php") ?>
        <script>
            $(document).ready(function () {
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "pageLength": 15
                });

            });


            document.addEventListener("DOMContentLoaded", function () {
                const scrollImages = document.querySelector(".scroll-images");
                const scrollLength = scrollImages.scrollWidth - scrollImages.clientWidth;
                const leftButton = document.querySelector(".left");
                const rightButton = document.querySelector(".right");

                function checkScroll() {
                    const currentScroll = scrollImages.scrollLeft;
                    if (currentScroll === 0) {
                        leftButton.setAttribute("disabled", "true");
                        rightButton.removeAttribute("disabled");
                    } else if (currentScroll === scrollLength) {
                        rightButton.setAttribute("disabled", "true");
                        leftButton.removeAttribute("disabled");
                    } else {
                        leftButton.removeAttribute("disabled");
                        rightButton.removeAttribute("disabled");
                    }
                }

                scrollImages.addEventListener("scroll", checkScroll);
                window.addEventListener("resize", checkScroll);
                checkScroll();

                function leftScroll() {
                    scrollImages.scrollBy({
                        left: -200,
                        behavior: "smooth"
                    });
                }

                function rightScroll() {
                    scrollImages.scrollBy({
                        left: 200,
                        behavior: "smooth"
                    });
                }

                leftButton.addEventListener("click", leftScroll);
                rightButton.addEventListener("click", rightScroll);
            });
        </script>
    </body>

    </html>


<?php } else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>