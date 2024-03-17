<?php
require('dbconn.php');
// $con = connection();
$output = '';
if(isset($_POST["export_excel"]))
{
$sql = "SELECT * FROM book ORDER BY bookId ASC";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0 ) {
	
}
$output .='
<table class = "table" bordered = "2" style = "border: 2px;">
								 <thead>
                                    <tr>
                                    <th>bookId</th>
                                    <th>title</th>
                                    <th>series</th>
                                    <th>author</th>
                                    <th>rating</th>
                                    <th>bookDescription</th>
                                    <th>publicationLanguage</th>
                                    <th>genres</th>
                                    <th>mainGenre</th>
                                    <th>genreID</th>
                                    <th>numericCount</th>
                                    <th>alphabeticalCount</th>
                                    <th>shelf</th>
                                    <th>bookForm</th>
                                    <th>bookEdition</th>
                                    <th>pages</th>
                                    <th>publisher</th>
                                    <th>yearOfPublication</th>
                                    <th>firstYearOfPublication</th>
                                    <th>awards</th>
                                    <th>numRating</th>
                                    <th>ratingbyStars</th>
                                    <th>likedPercent</th>
                                    <th>coverImage</th>

                                     
                                    </tr>
                                  </thead>

';

while ($row = mysqli_fetch_array($result)) {
	$output .='
                <tr>
                <td>'.$row["bookId"].'</td>
                <td>'.$row["title"].'</td>
                <td>'.$row["series"].'</td>
                <td>'.$row["author"].'</td>
                <td>'.$row["rating"].'</td>
                <td>'.$row["bookDescription"].'</td>
                <td>'.$row["publicationLanguage"].'</td>
                <td>'.$row["genres"].'</td>
                <td>'.$row["mainGenre"].'</td>
                <td>'.$row["genreID"].'</td>
                <td>'.$row["numericCount"].'</td>
                <td>'.$row["alphabeticalCount"].'</td>
                <td>'.$row["shelf"].'</td>
                <td>'.$row["bookForm"].'</td>
                <td>'.$row["bookEdition"].'</td>
                <td>'.$row["pages"].'</td>
                <td>'.$row["publisher"].'</td>
                <td>'.$row["yearOfPublication"].'</td>
                <td>'.$row["firstYearOfPublication"].'</td>
                <td>'.$row["awards"].'</td>
                <td>'.$row["numRating"].'</td>
                <td>'.$row["ratingbyStars"].'</td>
                <td>'.$row["likedPercent"].'</td>
                <td>'.$row["coverImage"].'</td>
              </tr>


	';
}
$output .='</table>';
header("Content-Type: Books");
header("Content-Disposition:attachment; filename=book.xls");
echo $output;

}



?>
