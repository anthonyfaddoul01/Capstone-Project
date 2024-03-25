<?php
require('dbconn.php');
  
        $csvFilePath = 'books.csv';
        $fileHandle = fopen($csvFilePath, 'r');

        if ($fileHandle === false) {
          throw new Exception("Cannot open the CSV file finalData.");
        }

        // Skip the header line if your CSV has one
        fgetcsv($fileHandle);
        $rowNumber = 1; // Start counting from 1 (considering you skipped the header)

        while (($data = fgetcsv($fileHandle, null, ",")) !== false ) {
          try {
           // print_r($rowNumber);
          //  print_r($data);
            $rowNumber++; // Increment row number at the beginning of the loop
            $sql = "INSERT INTO `book`(`bookId`, `title`, `series`, `author`, `rating`, `bookDescription`,
              `publicationLanguage`, `genres`, `mainGenre`, `genreID`, `numericCount`, `alphabeticalCount`, `shelf`, 
               `bookForm`, `bookEdition`, `pages`, `publisher`, `yearOfPublication`, 
              `awards`, `numRating`, `ratingbyStars`, `coverImage`) 
              VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            
            $stmt->execute([intval($data[0]),$data[1],$data[2],$data[3],floatval($data[4]),$data[5],$data[6],$data[7],$data[8],intval($data[9]),intval($data[10]),$data[11],$data[12],
            $data[13],$data[14],intval($data[15]),$data[16],$data[17],$data[18],intval($data[19]),$data[20],$data[21]]);
            } catch (Exception $e) {
                // Log the error with row number
                echo "Error at row $rowNumber: " . $e->getMessage() . "\n";
                // Optionally, log the data causing the issue
                //echo "Data: " . implode(", ", $data) . "\n";
                }
        }
        fclose($fileHandle);
       // db_close($dbh);

        $csvFilePath1 = 'genre.csv';
        $fileHandle1 = fopen($csvFilePath1, 'r');

        if ($fileHandle1 === false) {
          throw new Exception("Cannot open the CSV file genre.");
        }

        // Skip the header line if your CSV has one
        fgetcsv($fileHandle1);
        while (($data1 = fgetcsv($fileHandle1, null, ",")) !== false) {
          try {
            $sql1 = "INSERT INTO `genreid`(`genre`, `genreID`, `count`) VALUES ( ?, ?, ?)";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->execute([$data1[0],intval($data1[1]),intval($data1[2])]);
          }catch (Exception $e) {
              // Log the error with row number
              echo "Error at row $rowNumber: " . $e->getMessage() . "\n";
              // Optionally, log the data causing the issue
              //echo "Data: " . implode(", ", $data) . "\n";
              }
      }
      fclose($fileHandle1);
      echo "Data imported successfully.";
?>