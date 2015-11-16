<?php
require_once("databases.php");
require_once("functions.php");

$loanee_user_id = $_GET["loanee_user_id"];
$user_id = $_SESSION["user_id"];
try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT user_status FROM users WHERE user_id = '$loanee_user_id'";
	$result = $conn->query($sql);
	$result->setFetchMode(PDO::FETCH_ASSOC);

	while ($user_set = $result->fetch()):
		echo $current_status = $user_set['user_status'];
	endwhile;
}
catch(PDOException $e) {
	echo "Error: " . $e->getMessage();
}

if($current_status === "Activated"){
	$sql = "UPDATE users SET user_status = ? WHERE user_id = ?";
	$new_status = "Deactivated";
	$stmt = $conn->prepare($sql);
	$stmt->execute(array($new_status, $loanee_user_id));
	redirect("users.php?id=$user_id");
} else {
	$sql = "UPDATE users SET user_status = ? WHERE user_id = ?";
	$new_status = "Activated";
	$stmt = $conn->prepare($sql);
	$stmt->execute(array($new_status, $loanee_user_id));
	redirect("users.php?id=$user_id");
}

?>