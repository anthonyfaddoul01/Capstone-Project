<?php
require ('dbconn.php');

?>


    
<?php
$userId=$_SESSION['userId'] ;
$sql = "SELECT * FROM record WHERE userId = 1000";


// Execute query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Output data of each row
  $balance=0;
  while ($row = $result->fetch_assoc()) {
    // echo "Record: " . print_r($row) . "<br>"; // Replace some_column_name with the actual column name you want to display
    $invoicedate =  strtotime($row['Due_Date']);
    $TodayDate = strtotime('today');

    $timeDiff = abs($TodayDate - $invoicedate);

    $numberDays = $timeDiff / 86400;  // 86400 seconds in one day

    $numberDays = intval($numberDays);
    $penalty= $numberDays*1.5;
    $bookId=$row['bookId'];
    $balance+=$penalty;

    $sql1 = "UPDATE record set Dues='$numberDays' , Penalty='$penalty' where bookId='$bookId' and userId='$userId'  ";
   $conn->query($sql1);
    // print_r("dues".$numberDays);
    }
    $sql2 = "UPDATE user set balance='$balance' where userId='$userId'  ";
    $conn->query($sql2);
} else {
  // echo "0 results";
}

?>
