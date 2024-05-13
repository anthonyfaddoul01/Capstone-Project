<?php
require ('dbconn.php');
?>

<?php


if ($_SESSION['type'] == 'User') {
    require ('cal.php');
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
                }

                .scroll-images .child {
                    min-width: 250px;
                    height: auto;
                    padding: 0 10px;
                    margin: 1px 5px;
                }
            }
        </style>
    </head>

    <body>
        <?php require ('nav.php'); ?>
        <main id="main">
            <section id="hero" class="d-flex align-items-center justify-content-center mt-0">
                <div class="container">

                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-8">
                            <h1 id="quoteDisplay"></h1>
                        </div>
                    </div>
                </div>
            </section>

            <div class="cover mx-3">
                <div class="section-title pb-0">
                    <p class="mb-0">Recommended For You</p>
                </div>
                <button class="left"><i class="fas fa-arrow-left"></i></button>
                <div id="recommendationsBooks" class="scroll-images"></div>
                <button class="right pr-0"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="cover mx-3">
                <div class="section-title pb-0">
                    <p class="mb-0">top rated books</p>
                </div>
                <button class="left"><i class="fas fa-arrow-left"></i></button>
                <div id="topRatedBooks" class="scroll-images"></div> 
                <button class="right pr-0"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="cover mx-3">
                <div class="section-title pb-0">
                    <p class="mb-0">fiction books</p>
                </div>
                <button class="left"><i class="fas fa-arrow-left"></i></button>
                <div id="fictionBooks" class="scroll-images"></div> 
                <button class="right pr-0"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="cover mx-3">
                <div class="section-title pb-0">
                    <p class="mb-0">fantasy books</p>
                </div>
                <button class="left"><i class="fas fa-arrow-left"></i></button>
                <div id="fantasyBooks" class="scroll-images"></div> 
                <button class="right pr-0"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="cover mx-3">
                <div class="section-title pb-0">
                    <p class="mb-0">young adult books</p>
                </div>
                <button class="left"><i class="fas fa-arrow-left"></i></button>
                <div id="youngadultBooks" class="scroll-images"></div> 
                <button class="right pr-0"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="cover mx-3">
                <div class="section-title pb-0">
                    <p class="mb-0">Romance books</p>
                </div>
                <button class="left"><i class="fas fa-arrow-left"></i></button>
                <div id="romanceBooks" class="scroll-images"></div> 
                <button class="right pr-0"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="cover mx-3">
                <div class="section-title pb-0">
                    <p class="mb-0">Nonfiction books</p>
                </div>
                <button class="left"><i class="fas fa-arrow-left"></i></button>
                <div id="nonfictionBooks" class="scroll-images"></div> 
                <button class="right pr-0"><i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="cover mx-3">
                <div class="section-title pb-0">
                    <p class="mb-0">New books - 2024</p>
                </div>
                <button class="left"><i class="fas fa-arrow-left"></i></button>
                <div id="newBooks" class="scroll-images"></div> 
                <button class="right pr-0"><i class="fas fa-arrow-right"></i></button>
            </div>
        </main>
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
                        applyScrolling(sectionId);
                    }
                });
            }

            function applyScrolling(sectionId) {
                const $scrollContainer = $(sectionId);
                const $leftButton = $(sectionId).siblings('.left');
                const $rightButton = $(sectionId).siblings('.right');

                $leftButton.off('click').on('click', function () {
                    $scrollContainer.animate({
                        scrollLeft: '-=300'
                    }, 'smooth');
                });

                $rightButton.off('click').on('click', function () {
                    $scrollContainer.animate({
                        scrollLeft: '+=300'
                    }, 'smooth');
                });
            }

            $(document).ready(function () {
                loadSectionBooks('topRated');
                loadSectionBooks('fiction');
                loadSectionBooks('fantasy');
                loadSectionBooks('youngadult');
                loadSectionBooks('nonfiction');
                loadSectionBooks('romance');
                loadSectionBooks('new');

            });

            $(document).ready(function () {
                $.ajax({
                    url: 'getRecommendedForUser.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function (books) {
                        console.log(books);
                        books.forEach(function (book) {
                            getRecommendations(book.title, book.bookId);
                        });
                        applyScrolling('#recommendationsBooks');
                    },
                    error: function (xhr, status, error) {
                        console.error('Failed to retrieve books: ' + error);
                    }
                });


                function getRecommendations(bookTitle, bookId) {
                    $.ajax({
                        url: 'http://127.0.0.1:5000/recommend',
                        data: { title: bookTitle },
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            var recommendations = data.slice(0, 3);
                            recommendations.forEach(function (rec) {
                                fetchBookDetails(rec.ID);
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error('Failed to retrieve recommendations: ' + error);
                        }
                    });
                }

                function fetchBookDetails(recBookId) {
                    $.ajax({
                        url: 'fetch_recbook_details.php',
                        data: { bookId: recBookId },
                        type: 'GET',
                        dataType: 'json',
                        success: function (bookDetails) {
                            var bookHtml = '<div class="col mb-5"><div class="card" style="width: 18rem;"><a href="bookdetails.php?id=' + bookDetails.bookId + '"><img src="' + bookDetails.coverImage + '" class="card-img-top imgcontainer"></a></div></div>';
                            $('#recommendationsBooks').append(bookHtml);
                        },
                        error: function (xhr, status, error) {
                            console.error('Failed to fetch book details: ' + error);
                        }
                    });
                }
            });


            const Quotes = [
                "A room without books is like a body without a soul.",
                "The only thing that you absolutely have to know, is the location of the library.",
                "I do believe something very magical can happen when you read a good book.",
                "Libraries will get you through times of no money better than money will get you through times of no libraries.",
                "So many books, so little time.",
                "Once you learn to read, you will be forever free.",
                "The library is the temple of learning, and learning has liberated more people than all the wars in history.",
                "Reading is to the mind what exercise is to the body.",
                "Books are a uniquely portable magic.",
                "In the library, you can find people between the pages of books.",
                "No two persons ever read the same book.",
                "Reading gives us someplace to go when we have to stay where we are.",
                "A book is a dream that you hold in your hand.",
                "Libraries store the energy that fuels the imagination."
            ];
            let Dayof = Math.floor(Math.random() * Quotes.length);
            let QuoteofDay = Quotes[Dayof];

            document.addEventListener("DOMContentLoaded", function () {
                let punctuatedQuote = QuoteofDay.replace(/([\.,;:!?\-'"()])/g, '<span>$1</span>');
                document.getElementById("quoteDisplay").innerHTML = punctuatedQuote;
            });
        </script>
    </body>

    </html>
<?php } else {
    echo "<script>window.location = '../error.php';</script>";
} ?>