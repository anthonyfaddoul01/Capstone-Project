<?php
require('dbconn.php');
// $con = connection();
$output = '';
if (isset($_POST["export_excel"])) {
  $sql = "select record.bookId,id,userId,title,Due_Date,Date_of_Issue,Date_of_Return,datediff(curdate(),Due_Date) 
  as x from bookbud.record,bookbud.book where Date_of_Issue and Date_of_Return is NULL and book.bookid = record.bookId";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {

  }
  $output .= '
<table class = "table" bordered = "2" style = "border: 2px;">
								 <thead>
                                    <tr>
                                    <th>BorrowerID</th>
                                    <th>BorrowerName</th>
                                    <th>BookID</th>
                                    <th>BookName</th>
                                    <th>IssueDate</th>
                                    <th>DueDate</th>
                                    <th>ReturnDate</th>
                                    <th>Dues</th>
                                    </tr>
                                  </thead>

';


  while ($row = mysqli_fetch_array($result)) {
    $userid = $row["userId"];
    $namequery = "SELECT username FROM bookbud.user WHERE userId='$userid'";
    $r = $conn->query($namequery);
    $name = $r->fetch_assoc();
    $output .= '
                <tr>
                <td>' . $row["userId"] . '</td>
                <td>' . $name['username'] . '</td>
                <td>' . $row["bookId"] . '</td>
                <td>' . $row["title"] . '</td>
                <td>' . $row["Date_of_Issue"] . '</td>
                <td>' . $row["Due_Date"] . '</td>
                <td>' . $row["Date_of_Return"] . '</td>
              </tr>


	';
  }
  $output .= '</table>';
  header("Content-Type: Books");
  header("Content-Disposition:attachment; filename=book.xls");
  echo $output;

}



?>