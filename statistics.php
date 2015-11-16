<?php
require_once("databases.php");
require_once("functions.php");

navigation($user_id);
echo "<br>";


echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<th>Amount Of Loans Given</th>";
echo "<th>Amount Of Interest Expected</th>";
echo "<th>Amount Expected In Total</th>";
echo "</thead>";
echo "<tbody>";

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $results = $conn->prepare("SELECT SUM(loan), SUM(interest), SUM(total) FROM loans");
        $results->execute();
        for($i=0; $rows = $results->fetch(); $i++){
            $sum_loan = $rows['SUM(loan)'];
            $sum_interest = $rows['SUM(interest)'];
            $sum_total = $rows['SUM(total)'];
            echo "<tr>";
            echo "<td> $sum_loan  </td>";
            echo "<td> $sum_interest </td>";
            echo "<td> $sum_total  </td>";
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";
        }

$loanee_user_id = $_GET["loanee_user_id"];
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "
    SELECT users.user_id, users.lname, users.id_no, loans.user_id AS loan_id, loans.loan, loans.interest, loans.total,loans.loan_status, loans.id
    FROM users INNER JOIN loans ON loans.user_id=users.user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if($loanee = $stmt->fetch()) {
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Last Name</th>";
        echo "<th>ID Number</th>";
        echo "<th>Loan</th>";
        echo "<th>Interest</th>";
        echo "<th>Total</th>";
        echo "<th>Loan Status</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        do {
            $loanee_lname = $loanee["lname"];
            $loanee_id_no = $loanee["id_no"];
            $loanee_loan = test_input($loanee['loan']);
            $loanee_interest = test_input($loanee['interest']);
            $loanee_total = test_input($loanee['total']);
            $loanee_loan_status = test_input($loanee['loan_status']);
            $loanee_loan_id = test_input($loanee['id']);


            echo "<tr>";;
            echo "<td> $loanee_lname  </td>";
            echo "<td> $loanee_id_no  </td>";
            echo "<td> $loanee_loan  </td>";
            echo "<td> $loanee_interest  </td>";
            echo "<td> $loanee_total  </td>";
            if($loanee_loan_status === "Un-Paid") {
                echo "<td>$loanee_loan_status</td>";
            } else {
                echo "<td>$loanee_loan_status</td>";
            }
        } while ($loanee = $stmt->fetch());
    } else {
            echo " No Loans";
    }

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
    $conn = null;


?>

