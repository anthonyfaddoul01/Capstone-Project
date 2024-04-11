<?php
require ('dbconn.php');
?>

<?php


if ($_SESSION['type'] == 'User') {
    //require ('cal.php');
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
                <div class="container">

                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-8">
                            <h1 id="quoteDisplay"></h1>
                            <!-- <h2>We are team of talented digital marketers</h2> -->
                        </div>
                    </div>

                    <!-- <div class="row gy-4 mt-5 justify-content-center">
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
                    </div> -->

                </div>
            </section><!-- End Hero -->
            <div class="container">
                <div class="section-title">
                    <p class="mb-0" onclick="fetchBooks('toprated')">Top Rated Books</p>
                </div>
                <div class="section-title">
                    <p class="mb-0" onclick="fetchBooks('', 'Fiction')">Fiction Books</p>
                </div>
                <div class="section-title">
                    <p class="mb-0" onclick="fetchBooks('', 'Fantasy')">Fantasy Books</p>
                </div>
                <!-- Add more sections as needed -->

                <div class="cover">
                    <button class="left" onclick="leftScroll()">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <div class="scroll-images">
                        <!-- Books will be loaded here by fetchBooks() -->
                    </div>
                    <button class="right" onclick="rightScroll()">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </main><!-- End #main -->
        <?php require ("footer.php") ?>

        <?php require ("scripts.php") ?>
        <script>
            function fetchBooks(special, genre = '') {
                const param = genre ? `genre=${genre}` : `special=${special}`;
                fetch(`fetch_books.php?${param}`)
                    .then(response => response.json())
                    .then(data => {
                        const container = document.querySelector('.scroll-images');
                        container.innerHTML = ''; // Clear current content
                        data.forEach(book => {
                            const bookHtml = `<div class="col mb-5">
                            <div class="card" style="width: 18rem;">
                                <a href="bookdetails.php?id=${book.bookId}"><img src="${book.coverImage}" class="card-img-top imgcontainer"></a>
                            </div>
                        </div>`;
                            container.innerHTML += bookHtml;
                        });
                    })
                    .catch(error => console.error('Error fetching books:', error));
            }
            document.addEventListener('DOMContentLoaded', function () {
                fetchBooks('toprated'); // Automatically load top-rated books on page load
            });
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


            const Quotes = [
                "The purpose of our lives is to be happy.",
                "Life is what happens when you're busy making other plans.",
                "Get busy living or get busy dying.",
                "You only live once, but if you do it right, once is enough.",
                "Many of life's failures are people who did not realize how close they were to success when they gave up.",
                "If you want to live a happy life, tie it to a goal, not to people or things.",
                "Never let the fear of striking out keep you from playing the game.",
                "Money and success don't change people; they merely amplify what is already there."
            ];
            let Dayof = Math.floor(Math.random() * Quotes.length);
            let QuoteofDay = Quotes[Dayof];

            // Select the H1 element and insert the quote
            document.addEventListener("DOMContentLoaded", function () {
                let punctuatedQuote = QuoteofDay.replace(/([\.,;:!?\-'"()])/g, '<span>$1</span>');
                document.getElementById("quoteDisplay").innerHTML = punctuatedQuote;
            });
        </script>
    </body>

    </html>
<?php } else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>