<?php
require ('dbconn.php');

?>

<?php
if ($_SESSION['type'] == 'User') {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Library</title>
        <?php require ("links.php") ?>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <?php require ("nav.php") ?>
        <?php
        $x = $_GET['id'];
        $sql = "select * from bookbud.book where bookId='$x'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $bookid = $row['bookId'];
        $title = $row['title'];
        $series = $row['series'];
        $author = $row['author'];
        $description = $row['bookDescription'];
        $lang = $row['publicationLanguage'];
        $rating = $row['rating'];
        $genre = $row['mainGenre'];
        $allgenres = $row['genres'];
        $shelf = $row['shelf'];
        $bookEdition = $row['bookEdition'];
        $publisher = $row['publisher'];
        $pages = $row['pages'];
        $year = $row['yearOfPublication'];
        $available = $row["isAvailable"] == '1';
        $img = $row['coverImage'];
        ?>
        <!-- content -->
        <section class="py-5 mt-5">
            <div class="container">
                <div class="row gx-5">
                    <aside class="col-lg-6 d-flex justify-content-center">
                        <img style="max-width: 100%; max-height: 105vh;" class="rounded-4 fit" src="<?php echo $img ?>" />
                    </aside>
                    <main class="col-lg-6">
                        <div class="ps-lg-3">
                            <h4 class="title text-dark mb-3">
                                <?php echo $title; ?>
                            </h4>
                            <h5 class="title text-dark mb-3">
                                &emsp;By
                                <?php echo $author; ?>
                            </h5>
                            <h6 class="title text-dark">
                                &emsp;
                                <?php if ($series)
                                    echo "From the series of: " . $series;
                                else
                                    echo ""; ?>
                            </h6>
                            <div class="d-flex flex-row my-3">
                                <div class="text-warning mb-1 me-2">
                                    <?php
                                    $totalStars = 5;
                                    $fullStars = floor($rating);
                                    $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0;
                                    $emptyStars = $totalStars - $fullStars - $halfStar;
                                    for ($i = 0; $i < $fullStars; $i++) {
                                        echo '<i class="fa fa-star"></i>';
                                    }
                                    if ($halfStar) {
                                        echo '<i class="fas fa-star-half-alt"></i>';
                                    }
                                    for ($i = 0; $i < $emptyStars; $i++) {
                                        echo '<i class="far fa-star"></i>';
                                    }
                                    ?>
                                    <span class="ms-1">
                                        <?php echo $rating; ?>
                                    </span>
                                </div>
                                <?php if ($available == 1)
                                    echo "<span class='text-success ms-2'>Available</span>";
                                else
                                    echo "<span class='text-danger ms-2'>Unavailable</span>" ?>
                                </div>

                                <p>
                                <?php echo $description; ?>
                            </p>

                            <div class="row">
                                <dt class="col-4">Language:</dt>
                                <dd class="col-8">
                                    <?php
                                    if ($lang)
                                        echo $lang;
                                    else
                                        echo "Unkown"; ?>
                                </dd>

                                <dt class="col-4">Genre:</dt>
                                <dd class="col-8">
                                    <?php if ($genre)
                                        echo $genre;
                                    else
                                        echo "Unkown"; ?>
                                </dd>

                                <dt class="col-4">Shelf:</dt>
                                <dd class="col-8">
                                    <?php if ($shelf)
                                        echo $shelf;
                                    else
                                        echo "Unkown"; ?>
                                </dd>

                                <dt class="col-4">No. of pages:</dt>
                                <dd class="col-8">
                                    <?php if ($pages)
                                        echo $pages;
                                    else
                                        echo "Unkown"; ?>
                                </dd>

                                <dt class="col-4">Edition:</dt>
                                <dd class="col-8">
                                    <?php
                                    if ($bookEdition)
                                        echo $bookEdition;
                                    else
                                        echo "Unkown"; ?>
                                </dd>

                                <dt class="col-4">Publisher:</dt>
                                <dd class="col-8">
                                    <?php if ($publisher)
                                        echo $publisher;
                                    else
                                        echo "Unkown";
                                    ?>
                                </dd>

                                <dt class="col-4">Shelf Location:</dt>
                                <dd class="col-8">
                                    <?php echo $shelf; ?>
                                </dd>

                                <dt class="col-4">Year of publication:</dt>
                                <dd class="col-8">
                                    <?php echo $year; ?>
                                </dd>

                                <dt class="col-4">Other genres:</dt>
                                <dd class="col-8">
                                    <?php
                                    $allgenres = "Young Adult, Fantasy, Romance, Vampires, Fiction";
                                    $genresArray = explode(", ", $allgenres);
                                    unset($genresArray[0]);
                                    $genresWithoutFirst = implode(", ", $genresArray);
                                    echo $genresWithoutFirst;
                                    ?>
                                </dd>
                            </div>
                            <hr />
                            <?php
                            $userid = $_SESSION['userId'];

                            $stmt = $conn->prepare("SELECT * FROM bookbud.favorites WHERE userId = ? AND bookId = ?");
                            $stmt->bind_param("ss", $userid, $bookid); // "ss" denotes two strings
                            $stmt->execute();
                            $result = $stmt->get_result();

                            // Check if the record exists
                            $favoriteExists = $result->num_rows > 0;
                            ?>

                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-primary shadow-0" onclick="goBack()">Go Back</a>
                                <?php if ($favoriteExists): ?>
                                    <button id="favoriteButton" onclick="removeFromFavorites(<?php echo $bookid; ?>)"
                                        class="btn btn-danger border border-secondary icon-hover px-3">
                                        <i class="me-1 fa fa-heart fa-lg"></i> Added to Favorites
                                    </button>
                                <?php else: ?>
                                    <button id="favoriteButton" onclick="addToFavorites(<?php echo $bookid; ?>)"
                                        class="btn btn-light border border-secondary icon-hover px-3">
                                        <i class="me-1 fa fa-heart fa-lg"></i> Add to Favorite
                                    </button>
                                <?php endif; ?>

                                <?php if ($available == 1)
                                    echo "<a id='submitButton' href='#' class='btn btn-warning shadow-0'>
                                    <i class='me-1 fas fa-paper-plane'></i> Request Book
                                </a>";
                                else
                                    echo "<a href='#' class='btn btn-secondary shadow-0' onclick='unavailable()'>
                                    <i class='me-1 fas fa-paper-plane'></i> Request Book
                                </a>" ?>

                                    <!-- <a href="requestbook.php?id=<?php echo $bookid ?>" class="btn btn-warning shadow-0">
                                <i class="me-1 fas fa-paper-plane"></i> Request Book
                            </a> -->
                            </div>

                        </div>
                    </main>
                </div>
            </div>
        </section>
        <!-- Modal -->
        <div id="messageModal"
            style="display:none; position: fixed; z-index: 1000; left: 50%; top: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border: 1px solid #ddd; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0,0,0,0.5);">
            <p id="modalText">...</p>
        </div>
        <!-- content -->
        <?php require ("scripts.php") ?>
        <script>
            function unavailable() {
                showMessageModal("Book Unavailable", "text-danger");
            }

            function goBack() {
                window.history.back();
            }
            function showMessageModal(message, className) {
                var modalText = document.getElementById('modalText');
                modalText.className = '';
                modalText.classList.add(className);
                modalText.innerText = message;
                document.getElementById('messageModal').style.display = 'block';
                setTimeout(function () {
                    document.getElementById('messageModal').style.display = 'none';
                }, 3000);
            }

            $(document).ready(function () {
                $("#submitButton").click(function (e) {
                    e.preventDefault();
                    var bookid = "<?php echo $bookid; ?>"
                    $.ajax({
                        type: "GET",
                        url: "requestbook.php",
                        data: { id: bookid },
                        success: function (response) {
                            if (response.trim() === "success") {
                                showMessageModal("Request Sent Successfully.", "text-warning");
                            } else if (response.trim() === "error") {
                                showMessageModal("You have already made this request.", "text-danger");
                            }
                        },
                        error: function () {
                            showMessageModal("You have already made this request.", "text-danger");
                        }
                    });
                });
            });

            function addToFavorites(bookId) {
                $.ajax({
                    url: 'addfavorite.php',
                    type: 'GET',
                    data: { bookId: bookId },
                    success: function (response) {
                        if (response === 'success') {
                            var button = $('#favoriteButton');
                            button.removeClass('btn-light').addClass('btn-danger');
                            button.html('<i class="me-1 fa fa-heart fa-lg"></i> Added to Favorites');
                            button.attr("onclick", "removeFromFavorites(" + bookId + ");");
                        } else {
                            alert('Failed to add to favorites. Please try again.');
                        }
                    }
                });
            }

            function removeFromFavorites(bookId) {
                $.ajax({
                    url: 'removefavorite.php',
                    type: 'GET',
                    data: { bookId: bookId },
                    success: function (response) {
                        if (response === 'success') {
                            var button = $('#favoriteButton');
                            button.removeClass('btn-danger').addClass('btn-light');
                            button.html('<i class="me-1 fa fa-heart fa-lg"></i> Add to Favorite');
                            button.attr("onclick", "addToFavorites(" + bookId + ");");
                        } else {
                            alert('Failed to remove from favorites. Please try again.');
                        }
                    }
                });
            }

        </script>

    </body>

    </html>


<?php } else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>