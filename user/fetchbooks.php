<?php
require ('dbconn.php');

if (isset($_GET['section'])) {
    $section = $_GET['section'];
    switch ($section) {
        case 'topRated':
            $sql = "SELECT bookId, coverImage FROM bookbud.book WHERE numRating > 1000000 ORDER BY rating DESC";
            break;
        case 'fiction':
            $sql = "SELECT bookId, coverImage FROM bookbud.book WHERE mainGenre = 'Fiction' ORDER BY RAND() LIMIT 20";
            break;
        case 'fantasy':
            $sql = "SELECT bookId, coverImage FROM bookbud.book WHERE mainGenre = 'Fantasy' ORDER BY RAND() LIMIT 20";
            break;
        case 'youngadult':
            $sql = "SELECT bookId, coverImage FROM bookbud.book WHERE mainGenre = 'Young Adult' ORDER BY RAND() LIMIT 20";
            break;
        case 'nonfiction':
            $sql = "SELECT bookId, coverImage FROM bookbud.book WHERE mainGenre = 'Nonfiction' ORDER BY RAND() LIMIT 20";
            break;
        case 'romance':
            $sql = "SELECT bookId, coverImage FROM bookbud.book WHERE mainGenre = 'Romance' ORDER BY RAND() LIMIT 20";
            break;
        case 'new':
            $sql = "SELECT bookId, coverImage FROM bookbud.book WHERE yearOfPublication='2024' ORDER BY RAND() LIMIT 20";
            break;
        default:
            echo "Invalid section";
            exit;
    }

    $result = $conn->query($sql);

    $booksHtml = '';
    while ($row = $result->fetch_assoc()) {
        $booksHtml .= '<div class="col mb-5"><div class="card" style="width: 18rem;"><a href="bookdetails.php?id=' . $row['bookId'] . '"><img src="' . $row['coverImage'] . '" class="card-img-top imgcontainer"></a></div></div>';
    }

    echo $booksHtml;
}
?>