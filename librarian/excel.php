<?php
require_once 'vendor/autoload.php';
require('dbconn.php'); // Your database connection file

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;

// Check if the export button was clicked
if (isset($_POST["export_excel"])) {
    // Create a writer instance
    $writer = WriterEntityFactory::createXLSXWriter();
    $writer->openToBrowser('books.xlsx'); // Stream directly to the browser

    // Writing the header row
    $headers = [
        'bookId', 'title', 'series', 'author', 'rating', 'bookDescription',
        'publicationLanguage', 'genres', 'mainGenre', 'genreID', 'numericCount',
        'alphabeticalCount', 'shelf', 'bookForm', 'bookEdition', 'pages',
        'publisher', 'yearOfPublication', 'awards', 'numRating', 'ratingbyStars',
        'coverImage'
    ];

    $headerRow = WriterEntityFactory::createRowFromArray($headers);
    $writer->addRow($headerRow);

    // Batch size and offset for pagination
    $batchSize = 1000;
    $offset = 0;

    do {
        // Adjust the SQL to fetch the next batch
        $sql = "SELECT * FROM book ORDER BY bookId ASC LIMIT $offset, $batchSize";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);

        while ($row = mysqli_fetch_assoc($result)) {
            $rowFromValues = WriterEntityFactory::createRowFromArray($row);
            $writer->addRow($rowFromValues);
        }

        // Increase offset to move to the next batch
        $offset += $batchSize;
    } while ($numRows > 0);

    // Close the writer and flush the output to the browser
    $writer->close();
    exit;
}
?>
