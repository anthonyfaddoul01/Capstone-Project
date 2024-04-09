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
            /*--------------------------------------------------------------
                                    # Scroll horizontal
                                    --------------------------------------------------------------*/
            .cover {
                position: relative;
                padding: 0px 30px;
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
                padding: 0px;
                padding-top: 20px;
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
                object-fit: fill;
                object-position: center;

            }

            .imgcontainer:hover {
                transform: scale(1.1);
            }
        </style>
    </head>

    <body>
        <?php require ('nav.php'); ?>
        <main id="main">
            <!-- ======= Hero Section ======= -->
            <section id="hero" class="d-flex align-items-center justify-content-center mt-0">
                <div class="container" data-aos="fade-up">

                    <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
                        <div class="col-xl-6 col-lg-8">
                            <h1>Powerful Digital Solutions With Gp<span>.</span></h1>
                            <h2>We are team of talented digital marketers</h2>
                        </div>
                    </div>

                    <div class="row gy-4 mt-5 justify-content-center" data-aos="zoom-in" data-aos-delay="250">
                        <div class="col-xl-2 col-md-4">
                            <div class="icon-box">
                                <i class="ri-store-line"></i>
                                <h3><a href="">Lorem Ipsum</a></h3>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4">
                            <div class="icon-box">
                                <i class="ri-bar-chart-box-line"></i>
                                <h3><a href="">Dolor Sitema</a></h3>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4">
                            <div class="icon-box">
                                <i class="ri-calendar-todo-line"></i>
                                <h3><a href="">Sedare Perspiciatis</a></h3>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4">
                            <div class="icon-box">
                                <i class="ri-paint-brush-line"></i>
                                <h3><a href="">Magni Dolores</a></h3>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4">
                            <div class="icon-box">
                                <i class="ri-database-2-line"></i>
                                <h3><a href="">Nemos Enimade</a></h3>
                            </div>
                        </div>
                    </div>

                </div>
            </section><!-- End Hero -->
            <section id="services" class="services mx-5 pb-0" id="toprated">
                <div class="section-title pb-0">
                    <p class="mb-0">top rated books</p>
                </div>
                <?php
                $userid = $_SESSION['userId'];
                $sql = "select bookId, coverImage from bookbud.book where numRating > 1000000 order by rating desc";
                $result = $conn->query($sql);
                ?>

                <div class="cover">
                    <button class="left" onclick="leftScroll()">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <div class="scroll-images">
                        <?php
                        $books = [];
                        while ($row = $result->fetch_assoc()) {
                            $books[] = $row;
                        }
                        shuffle($books);
                        ?>
                        <?php foreach ($books as $row): ?>
                            <div class="col mb-5">
                                <div class="card" style="width: 18rem;">
                                    <a href="bookdetails.php?id=<?php echo $row['bookId'] ?>"><img
                                            src="<?php echo $row['coverImage'] ?>" class="card-img-top imgcontainer"></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="right" onclick="rightScroll()">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </section>
            <section id="services" class="services mx-5 py-0" id="fiction">
                <div class="section-title pb-0">
                    <p class="mb-0">Fiction books</p>
                </div>
                <?php
                $userid = $_SESSION['userId'];
                $sql = "select bookId, coverImage from bookbud.book where mainGenre = 'Fiction' ORDER BY RAND() LIMIT 20";
                $result = $conn->query($sql);
                ?>

                <div class="cover">
                    <button class="left" onclick="leftScroll()">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <div class="scroll-images ">
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            $bookid = $row['bookId'];
                            $img = $row['coverImage'];
                            ?>
                            <div class="col mb-5">
                                <div class="card" style="width: 18rem;">
                                    <a href="bookdetails.php?id=<?php echo $bookid ?>"><img src="<?php echo $img ?>"
                                            class="card-img-top imgcontainer"></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <button class="right" onclick="rightScroll()">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </section>
            <section id="services" class="services mx-5 py-0" id="fantasy">
                <div class="section-title pb-0">
                    <p class="mb-0">Fantasy books</p>
                </div>
                <?php
                $userid = $_SESSION['userId'];
                $sql = "select bookId, coverImage from bookbud.book where mainGenre = 'Fantasy' ORDER BY RAND() LIMIT 20";
                $result = $conn->query($sql);
                ?>

                <div class="cover">
                    <button class="left" onclick="leftScroll()">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <div class="scroll-images ">
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            $bookid = $row['bookId'];
                            $img = $row['coverImage'];
                            ?>
                            <div class="col mb-5">
                                <div class="card" style="width: 18rem;">
                                    <a href="bookdetails.php?id=<?php echo $bookid ?>"><img src="<?php echo $img ?>"
                                            class="card-img-top imgcontainer"></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <button class="right" onclick="rightScroll()">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </section>
            <section id="services" class="services mx-5 py-0" id="youngadult">
                <div class="section-title pb-0">
                    <p class="mb-0">Young Adult books</p>
                </div>
                <?php
                $userid = $_SESSION['userId'];
                $sql = "select bookId, coverImage from bookbud.book where mainGenre = 'Young Adult' ORDER BY RAND() LIMIT 20";
                $result = $conn->query($sql);
                ?>

                <div class="cover">
                    <button class="left" onclick="leftScroll()">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <div class="scroll-images ">
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            $bookid = $row['bookId'];
                            $img = $row['coverImage'];
                            ?>
                            <div class="col mb-5">
                                <div class="card" style="width: 18rem;">
                                    <a href="bookdetails.php?id=<?php echo $bookid ?>"><img src="<?php echo $img ?>"
                                            class="card-img-top imgcontainer"></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <button class="right" onclick="rightScroll()">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </section>
            <section id="services" class="services mx-5 py-0" id="romance">
                <div class="section-title pb-0">
                    <p class="mb-0">Romance books</p>
                </div>
                <?php
                $userid = $_SESSION['userId'];
                $sql = "select bookId, coverImage from bookbud.book where mainGenre = 'Romance' ORDER BY RAND() LIMIT 20";
                $result = $conn->query($sql);
                ?>

                <div class="cover">
                    <button class="left" onclick="leftScroll()">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <div class="scroll-images ">
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            $bookid = $row['bookId'];
                            $img = $row['coverImage'];
                            ?>
                            <div class="col mb-5">
                                <div class="card" style="width: 18rem;">
                                    <a href="bookdetails.php?id=<?php echo $bookid ?>"><img src="<?php echo $img ?>"
                                            class="card-img-top imgcontainer"></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <button class="right" onclick="rightScroll()">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </section>
            <section id="services" class="services mx-5 py-0" id="nonfiction">
                <div class="section-title pb-0">
                    <p class="mb-0">Nonfiction books</p>
                </div>
                <?php
                $userid = $_SESSION['userId'];
                $sql = "select bookId, coverImage from bookbud.book where mainGenre = 'Nonfiction' ORDER BY RAND() LIMIT 20";
                $result = $conn->query($sql);
                ?>

                <div class="cover">
                    <button class="left" onclick="leftScroll()">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <div class="scroll-images ">
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            $bookid = $row['bookId'];
                            $img = $row['coverImage'];
                            ?>
                            <div class="col mb-5">
                                <div class="card" style="width: 18rem;">
                                    <a href="bookdetails.php?id=<?php echo $bookid ?>"><img src="<?php echo $img ?>"
                                            class="card-img-top imgcontainer"></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <button class="right" onclick="rightScroll()">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </section>
            <section id="services" class="services mx-5 pb-0" id="newbooks">
                <div class="section-title pb-0">
                    <p class="mb-0">New books - 2024</p>
                </div>
                <?php
                $userid = $_SESSION['userId'];
                $sql = "select bookId, coverImage from bookbud.book where yearOfPublication='2024'";
                $result = $conn->query($sql);
                ?>

                <div class="cover">
                    <button class="left" onclick="leftScroll()">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <div class="scroll-images">
                        <?php
                        $books = [];
                        while ($row = $result->fetch_assoc()) {
                            $books[] = $row;
                        }
                        shuffle($books);
                        ?>
                        <?php foreach ($books as $row): ?>
                            <div class="col mb-5">
                                <div class="card" style="width: 18rem;">
                                    <a href="bookdetails.php?id=<?php echo $row['bookId'] ?>"><img
                                            src="<?php echo $row['coverImage'] ?>" class="card-img-top imgcontainer"></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="right" onclick="rightScroll()">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </section>

        </main><!-- End #main -->
        <?php require ("footer.php") ?>

        <?php require ("scripts.php") ?>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const covers = document.querySelectorAll(".cover");

                covers.forEach(function (cover) {
                    const scrollImages = cover.querySelector(".scroll-images");
                    const leftButton = cover.querySelector(".left");
                    const rightButton = cover.querySelector(".right");
                    function checkScroll() {
                        const scrollLength = scrollImages.scrollWidth - scrollImages.clientWidth;
                        const currentScroll = scrollImages.scrollLeft;
                        if (currentScroll === 0) {
                            leftButton.setAttribute("disabled", "true");
                            rightButton.removeAttribute("disabled");
                        } else if (currentScroll >= scrollLength - 1) {
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
                            left: -300,
                            behavior: "smooth"
                        });
                    }

                    function rightScroll() {
                        scrollImages.scrollBy({
                            left: 300,
                            behavior: "smooth"
                        });
                    }

                    leftButton.addEventListener("click", leftScroll);
                    rightButton.addEventListener("click", rightScroll);
                });
            });

        </script>
    </body>

    </html>
<?php } else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>