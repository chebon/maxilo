<?php
error_reporting(0);
session_id();
echo session_id();
require("functions.php");
require_once("databases.php");
$emailErr =  "";
$email = "";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	foreach( $stmt = $conn->query("SELECT hashed_password FROM users") as $row) {
		$password = $row["hashed_password"];
	}

}
catch(PDOException $e) {
	echo "Error: " . $e->getMessage();
}
$conn = null;

echo $password;
?>
