<?php
require("functions.php");
require_once("databases.php");

navigation($user_id);

$date1 = new DateTime("2015-10-15");
$date2 = new DateTime("2015-11-13");
$diff = $date2->diff($date1);
echo 'Difference: '.$diff->y.' Years,'
    .$diff->m.' Month, '
    .$diff->d.' Days';
 try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT id, loan, rate, period, interest, total, loan_status, loan_date  FROM loans WHERE user_id = '$user_id'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

     echo "<h1>Loan History</h1>";
     if($user_set = $stmt->fetch()) {
         echo "<table>";
         echo "<thead>";
         echo "<tr>";
         echo "<th>Loan</th>";
         echo "<th>Rate</th>";
         echo "<th>Period</th>";
         echo "<th>Interest</th>";
         echo "<th>total</th>";
         echo "<th>Date</th>";
         echo "<th>Status</th>";
         echo "</tr>";
         echo "</thead>";
         echo "<tbody>";
         do {
             $loan = test_input($user_set["loan"]);
             $rate = test_input($user_set["rate"]);
             $period = test_input($user_set["period"]);
             $interest = test_input($user_set["interest"]);
             $total = test_input($user_set["total"]);
             $date = date("j F Y g:i:s", strtotime($user_set['loan_date']));
             $loan_status = $user_set['loan_status'];

             echo "<tr>";
             echo "<td> $loan </td>";
             echo "<td> $rate </td>";
             echo "<td> $period </td>";
             echo "<td> $interest </td>";
             echo "<td> $total</td>";
             echo "<td> $date </td>";

             if ($loan_status === "Paid") {
                 echo "<td>" . $loan_status . "</td>";
             } else {
                 echo "<td>" . $loan_status . "</td>";
             }
         } while ($user_set = $stmt->fetch());
         echo "</tr>";
         echo "</tbody>";
         echo "</table>";
     } else {
        echo "You Don't Have A Loan";
        echo "<br/>";
        echo "<a href=loan_request.php?id=$user_id>Request One</a><br>";
    }

 }
 catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
 }


?>