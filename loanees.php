<?php
require_once("databases.php");
require_once("functions.php");

navigation($user_id);
echo "<br>";

$loanee_user_id = $_GET["loanee_user_id"];
echo $loanee_user_id."<br/>";
$loanee_loan_id = $_GET["loanee_loan_id"];
echo $loanee_loan_id."<br/>";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "
    SELECT users.user_id, loans.id, users.fname, users.lname, users.email,
    loans.user_id, loans.loan, loans.interest, loans.total, loans.loan_date, loans.loan_status
    FROM users INNER JOIN loans ON loans.user_id=users.user_id
    WHERE users.user_id ='$loanee_user_id' AND loans.id = '$loanee_loan_id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if($loanee = $stmt->fetch()) {

        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Loans Id</th>";
        echo "<th>First Name</th>";
        echo "<th>Last Name</th>";
        echo "<th>E-mail</th>";
        echo "<th>Loan</th>";
        echo "<th>Interest</th>";
        echo "<th>Total</th>";
        echo "<th>Loan Date</th>";
        echo "<th>Loan Status</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        do {
            $loanee_user_id = $loanee["user_id"];
            $loanee_loans_id = $loanee["id"];
            $loanee_fname = test_input($loanee['fname']);
            $loanee_lname  = test_input($loanee['lname']);
            $loanee_email = test_input($loanee['email']);
            $loanee_loan = test_input($loanee['loan']);
            $loanee_interest = test_input($loanee['interest']);
            $loanee_total = test_input($loanee['total']);
            $loanee_date = date("j F Y g:i:s", strtotime($loanee['loan_date']));
            $loanee_loan_status = test_input($loanee['loan_status']);


            echo "<tr>";
            echo "<td> $loanee_loans_id  </td>";
            echo "<td> $loanee_fname  </td>";
            echo "<td> $loanee_lname  </td>";
            echo "<td> $loanee_email  </td>";
            echo "<td> $loanee_loan  </td>";
            echo "<td> $loanee_interest  </td>";
            echo "<td> $loanee_total  </td>";
            echo "<td> $loanee_date  </td>";
            if($loanee_loan_status === "Un-Paid") {
                echo "<td><a href='update_loan_status.php?loanee_user_id=$loanee_user_id&loanee_loan_id=$loanee_loan_id'>".$loanee['loan_status']."</a></td>";
            } else {
                echo "<td><a href='update_loan_status.php?loanee_user_id=$loanee_user_id&loanee_loan_id=$loanee_loan_id'>".$loanee['loan_status']."</a></td>";
            }
        } while ($loanee = $stmt->fetch());
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";


    } else {
            echo "This User Does Not Have A Loan";
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
    $conn = null;
?>