<?php
error_reporting(0);
require("functions.php");
require_once("databases.php");
navigation($user_id);
$passwordErr = $password1Err = $password2Err = "";
$password = $password1 = $password2 = "";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	foreach( $stmt = $conn->query("SELECT hashed_password FROM users WHERE username = '$_SESSION[name]'") as $row) {
		$old_password = $row["hashed_password"];
	}
}
catch(PDOException $e) {
	echo "Error: " . $e->getMessage();
}
$conn = null;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["password"])) {
		$errors["passwordErr"] = "Old Password Is Required";
	} else {
		$password = test_input($_POST["password"]);

		if(!password_verify($password, $old_password)){
			$errors["passwordErr"] = "Password Does Not Match Records";
		}
	}

	if (empty($_POST["password1"])) {
		$errors["password1Err"] = "New Password Is Required";
	} else {
		$password1 = test_input($_POST["password1"]);
	}

	if (empty($_POST["password2"])) {
		$errors["password2Err"] = "Re-Enter New Password";
	} else {
		$password2 = test_input($_POST["password2"]);
		if($password1 !== $password2){
			$errors["password2Err"] = "Does Not Match New Password";
		}

	}
if(empty($errors) && isset($_POST["submit"])) {
	$new_password = hash_password($password2);
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE users SET hashed_password = '$new_password' WHERE username = '$_SESSION[name]'";
		// Prepare statement
		$stmt = $conn->prepare($sql);
		// execute the query
		$stmt->execute();

		// echo a message to say the UPDATE succeeded
		echo $stmt->rowCount() . " Account UPDATED Successfully";
		header("Refresh: 0; change_password.php?id=$user_id");
	} catch (PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
}
	echo "<br>";
}
?>

<html>



<head>

    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">



    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">


    <link rel="stylesheet" href="css/animate.min.css" type="text/css">


    <link rel="stylesheet" href="css/creative.css" type="text/css">
    <link rel="stylesheet" href="css/flat-ui.css" type="text/css">

</head>


<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

	Old Password: <br>
	<input type="password" name="password" value="">
	<?php echo $errors["passwordErr"]; ?>
	<br><br>

	New Password: <br>
	<input type="password" name="password1" value="">
	<?php echo $errors["password1Err"]; ?>
	<br><br>

	Re-Enter New Password: <br>
	<input type="password" name="password2" value="">
	<?php echo $errors["password2Err"]; ?>
	<br><br>

	  <input type="submit" name="submit" value="Submit">
		&nbsp;
	  <input type="reset" name="reset" value="Reset">
</form>
</body>
</html>
