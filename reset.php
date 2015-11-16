<?php
error_reporting(0);
require("functions.php");
require_once("databases.php");
$emailErr =  "";
$email = "";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	foreach( $stmt = $conn->query("SELECT email FROM users") as $row) {
		$row["email"];
	}

}
catch(PDOException $e) {
	echo "Error: " . $e->getMessage();
}
$conn = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["email"])) {
		$errors["emailErr"] = "Email Is Required";
	} else {
		$email = test_input($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors["emailErr"] = "Invalid E-mail Format";
		}

		if($row["email"] !== $_POST["email"]) {
			$errors["emailErr"] = "E-mail Does Not Exist";
		} else {
				$msg = "<br>Password Reset link Has Been Sent To Your E-mail";
			     //header('Refresh: 1.5; reset-pwd.php');
		}
	}
}
?>

<html>
<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
E-mail: <br>
<input type="text" name="email" value="<?php echo $email?>">
	<?php if(isset($errors)){echo $errors["emailErr"];} elseif(empty($errors) || isset($_POST["submit"])) { echo $msg;} ?>
		<br><br>


	  <input type="submit" name="submit" value="Submit">
</form>
</body>
</html>
<?php

echo mt_rand() . "<br>";
echo mt_rand() . "<br>";
?>