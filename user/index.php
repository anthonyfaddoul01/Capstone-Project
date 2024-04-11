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

            @media (max-width: 768px) {

                .cover button.left,
                .cover button.right {
                    font-size: 20px;
                    /* Adjust button size */
                }

                .scroll-images .child {
                    min-width: 250px;
                    /* Adjust book card width */
                    height: auto;
                    /* Adjust height as needed */
                    padding: 0 10px;
                    margin: 1px 5px;
                }
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
            <div class="cover mx-3">
                <div class="section-title pb-0">
                    <p class="mb-0">top rated books</p>
                </div>
                <button class="left"><i class="fas fa-arrow-left"></i></button>
                <div id="topRatedBooks" class="scroll-images"></div> <!-- Dynamically loaded content goes here -->
                <button class="right pr-0"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="cover mx-3">
                <div class="section-title pb-0">
                    <p class="mb-0">fiction books</p>
                </div>
                <button class="left"><i class="fas fa-arrow-left"></i></button>
                <div id="fictionBooks" class="scroll-images"></div> <!-- Dynamically loaded content goes here -->
                <button class="right pr-0"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="cover mx-3">
                <div class="section-title pb-0">
                    <p class="mb-0">fantasy books</p>
                </div>
                <button class="left"><i class="fas fa-arrow-left"></i></button>
                <div id="fantasyBooks" class="scroll-images"></div> <!-- Dynamically loaded content goes here -->
                <button class="right pr-0"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="cover mx-3">
                <div class="section-title pb-0">
                    <p class="mb-0">young adult books</p>
                </div>
                <button class="left"><i class="fas fa-arrow-left"></i></button>
                <div id="youngadultBooks" class="scroll-images"></div> <!-- Dynamically loaded content goes here -->
                <button class="right pr-0"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="cover mx-3">
                <div class="section-title pb-0">
                    <p class="mb-0">Romance books</p>
                </div>
                <button class="left"><i class="fas fa-arrow-left"></i></button>
                <div id="romanceBooks" class="scroll-images"></div> <!-- Dynamically loaded content goes here -->
                <button class="right pr-0"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="cover mx-3">
                <div class="section-title pb-0">
                    <p class="mb-0">Nonfiction books</p>
                </div>
                <button class="left"><i class="fas fa-arrow-left"></i></button>
                <div id="nonfictionBooks" class="scroll-images"></div> <!-- Dynamically loaded content goes here -->
                <button class="right pr-0"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="cover mx-3">
                <div class="section-title pb-0">
                    <p class="mb-0">New books - 2024</p>
                </div>
                <button class="left"><i class="fas fa-arrow-left"></i></button>
                <div id="newBooks" class="scroll-images"></div> <!-- Dynamically loaded content goes here -->
                <button class="right pr-0"><i class="fas fa-arrow-right"></i></button>
            </div>
        </main><!-- End #main -->
        <?php require ("footer.php") ?>

        <?php require ("scripts.php") ?>
        <script>
            function loadSectionBooks(section) {
                $.ajax({
                    url: "fetchBooks.php",
                    type: "GET",
                    data: { section: section },
                    success: function (data) {
                        const sectionId = '#' + section + 'Books';
                        $(sectionId).html(data);
                        // Apply scrolling functionality after the content is loaded
                        applyScrolling(sectionId);
                    }
                });
            }

            function applyScrolling(sectionId) {
                const $scrollContainer = $(sectionId);
                const $leftButton = $(sectionId).siblings('.left');
                const $rightButton = $(sectionId).siblings('.right');

                // Function to scroll left
                $leftButton.off('click').on('click', function () {
                    $scrollContainer.animate({
                        scrollLeft: '-=300'
                    }, 'smooth');
                });

                // Function to scroll right
                $rightButton.off('click').on('click', function () {
                    $scrollContainer.animate({
                        scrollLeft: '+=300'
                    }, 'smooth');
                });
            }

            // Call this function for each section on document ready or specific events
            $(document).ready(function () {
                loadSectionBooks('topRated');
                loadSectionBooks('fiction');
                loadSectionBooks('fantasy');
                loadSectionBooks('youngadult');
                loadSectionBooks('nonfiction');
                loadSectionBooks('romance');
                loadSectionBooks('new');

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