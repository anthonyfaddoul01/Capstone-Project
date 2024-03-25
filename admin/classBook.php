<?php

require_once ('dbconn.php');


class Book {
  public $ID;
  public $title;
  public $series;
  public $author;
  public $rating;
  public $bookDescription;
  public $publicationLanguage;
  public $genres;
  public $mainGenre;
  public $genreID;
  public $numericCount;
  public $alphabeticalCount;
  public $shelf;
  public $bookForm;
  public $bookEdition;
  public $pages;
  public $publisher;
  public $yearOfPublication;
  public $firstYearOfPublication;
  public $awards;
  public $numRating;
  public $ratingbyStars;
  public $likedPercent;
  public $coverImage;

  public function __construct( $title, $series, $author, $rating, $bookDescription, $publicationLanguage, $genres, $mainGenre, $bookForm, $bookEdition, $pages, $publisher, $yearOfPublication, $firstYearOfPublication, $awards, $coverImage) {
      $this->ID = CreateID();
      $this->title = $title;//verify it in js
      $this->series = $series;//verify it in js
      $this->author = $author;//verify it in js
      $this->rating = $rating;//verify it in js
      $this->bookDescription = $bookDescription;//verify it in js
      $this->publicationLanguage = $publicationLanguage;//verify it in js
      $this->genres = $genres;//verify it in js(ensure the user chooses from the available not to create a new genre)
      $this->mainGenre = $mainGenre;//verify it in js set it as the first one in genres
      $this->genreID = getGenreID($mainGenre);
      $this->numericCount = updateAndReturnNewCount(getGenreID($mainGenre));
      $this->alphabeticalCount = getLetterPart(getCount(getGenreID($mainGenre)));
      $this->shelf = generateShelvingCode(getGenreID($mainGenre), getCount(getGenreID($mainGenre)));
      $this->bookForm = $bookForm;//verify it in js
      $this->bookEdition = $bookEdition; //verify it in js
      $this->pages = $pages;//verify it in js
      $this->publisher = $publisher;//verify it in js
      $this->yearOfPublication = $yearOfPublication;//verify it in js
      $this->firstYearOfPublication = $firstYearOfPublication;//verify it in js
      $this->awards = $awards;//verify it in js
      $this->coverImage = $coverImage;//verify it in js
  }
}

function CreateID() {
  global $conn; // Use the global connection

  $query = "SELECT MAX(bookId) AS maxi FROM book";
  $result = mysqli_query($conn, $query); // Execute the query directly with mysqli_query

  if ($result) {
      $row = mysqli_fetch_assoc($result); // Fetch the associative array directly from the result
      $new_ID = $row['maxi'] + 1;
      return $new_ID;
  } else {
      // Query failed or table is empty, start IDs from 1 (or handle error as appropriate)
      return 1;
  }
}
// print_r("the new ID is ".CreateID()."\n");

//tested
function getGenreID($genre) {
  global $conn;
  $query = "SELECT genreID as gen FROM genreid WHERE genre=?";
  if ($stmt = $conn->prepare($query)) {
      $stmt->bind_param("s", $genre); // "s" indicates the type is a string
      $stmt->execute();
      $result = $stmt->get_result();
      if ($row = $result->fetch_assoc()) {
          $gen_ID = $row['gen'];
          return $gen_ID;
      }
      $stmt->close();
  }
  return null; // Return null if genre not found
}

// print_r("the Genre ID of Fiction is ".getGenreID("Fiction")."\n");

function getCount($genreID) {
  global $conn;
  $query = "SELECT count as con FROM genreid WHERE genreID=?";
  if ($stmt = $conn->prepare($query)) {
      $stmt->bind_param("s", $genreID); // "s" indicates the type is a string
      $stmt->execute();
      $result = $stmt->get_result();
      if ($row = $result->fetch_assoc()) {
          $new_con = $row['con'];
          return $new_con;
      }
      $stmt->close();
  }
  return null; // Return null if genreID not found
}

// print_r("the count of Fiction is ".getCount(6)."\n");

function updateAndReturnNewCount($genreID) {
  global $conn;
  // First, update the count by increasing it by 1 for the given genreID
  $updateQuery = "UPDATE genreid SET count = count + 1 WHERE genreID=?";
  if ($updateStmt = $conn->prepare($updateQuery)) {
      $updateStmt->bind_param("s", $genreID); // "s" indicates the parameter type is a string
      $updateStmt->execute();
      $updateStmt->close();

      // Then, return the new count for the given genreID
      return getCount($genreID); // Assuming getCount is correctly defined for mysqli as shown previously
  }
  return null; // Return null if there was a problem with the update
}


// Function to get the letter part
function getLetterPart($occurrence) {
// Adjusting the starting point so that 'AA' is the first sequence
$occurrence = intdiv($occurrence - 1, 99) + 1; // How many times we've filled 99 books, starting count at 1 for 'AA'

$letterPart = "";
// Since 'AA' is considered the start, we add an offset of 25 (one full alphabet cycle)
$occurrence += 25;

while ($occurrence > 0) {
    $occurrence--;  // Adjust because Excel column indexing starts from 1, not 0
    $letter = $occurrence % 26;
    $letterPart = chr(65 + $letter) . $letterPart;
    $occurrence = intdiv($occurrence, 26);
}
return $letterPart;
}
// print_r("the letter part of the 1500th book would be ".getLetterPart(1500)."\n");



// Function to get the book number part
function getBookNumberPart($occurrence) {
$bookNumber = ($occurrence - 1) % 99 + 1;
return str_pad($bookNumber, 2, '0', STR_PAD_LEFT);
}

// print_r("the bookNumber of the 1500th book would be ".getBookNumberPart(1500)."\n");


// Function to generate the complete shelving code
function generateShelvingCode($genreId, $occurrence) {
$letterPart = getLetterPart($occurrence);
$bookNumberPart = getBookNumberPart($occurrence);
return $genreId . $letterPart . $bookNumberPart;
}


?>