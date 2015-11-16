<?php
require_once("databases.php");
require_once("functions.php");

$loanee_user_id = $_GET["loanee_user_id"];
echo  $loanee_loan_id;
$loanee_loan_id = $_GET["loanee_loan_id"];
echo  $loanee_loan_id;


try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT loan_status, id FROM loans WHERE id = ' $loanee_loan_id'";
	$result = $conn->query($sql);
	$result->setFetchMode(PDO::FETCH_ASSOC);

	while ($loanee_user_set = $result->fetch()):
		echo $current_status = $loanee_user_set['loan_status'];
	endwhile;
}
catch(PDOException $e) {
	echo "Error: " . $e->getMessage();
}

if($current_status === "Un-Paid"){
	$sql = "UPDATE loans SET loan_status = ? WHERE id = ?";
	$new_status = "Paid";
	$stmt = $conn->prepare($sql);
	$stmt->execute(array($new_status,  $loanee_loan_id));
	redirect("loanees.php?loanee_user_id=$loanee_user_id&loanee_loan_id=$loanee_loan_id");
} else {
	$sql = "UPDATE loans SET loan_status = ? WHERE id = ?";
	$new_status = "Un-Paid";
	$stmt = $conn->prepare($sql);
	$stmt->execute(array($new_status,  $loanee_loan_id));
	redirect("loanees.php?loanee_user_id=$loanee_user_id&loanee_loan_id=$loanee_loan_id");
}

?>