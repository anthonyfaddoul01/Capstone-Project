<?php

$userId = $_SESSION['userId'];

$sqlUpdateRecords = "
    UPDATE record
    SET 
        Dues = DATEDIFF(CURDATE(), Due_Date),
        Penalty = DATEDIFF(CURDATE(), Due_Date) * 1.5
    WHERE
        userId = '$userId' AND
        Date_of_Issue != '0000-00-00' AND
        Due_Date < CURDATE() AND
        Due_Date != '0000-00-00';
";

$conn->query($sqlUpdateRecords);


$sqlUpdateBalance = "
    UPDATE user
    SET balance = (
        SELECT SUM(Penalty)
        FROM record
        WHERE userId = '$userId' AND
              Date_of_Issue != '0000-00-00'
    )
    WHERE userId = '$userId';
";
$conn->query($sqlUpdateBalance);


?>