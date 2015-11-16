<?php
error_reporting(0);
require("functions.php");
require_once("databases.php");
navigation($user_id);

$genderErr = $fnameErr = $lnameErr = $usernameErr = $emailErr = "";
$user_type = $gender = $fname = $lname = $username = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["fname"])) {
		$errors["fnameErr"] = "First Name Is Required";
	} else {
		$fname = test_input(ucname($_POST["fname"]));
	}

	if (empty($_POST["lname"])) {
		$errors["lnameErr"] = "Last Name Is Required";
	} else {
		$lname = test_input(ucname($_POST["lname"]));
		// check if name only contains letters and whitespace
		if (!preg_match("/^[\\\\a-zA-Z\']*$/",$fname)) {
			$errors['fnameErr'] = "Only letters and white space allowed";
		}
	}

	if (empty($_POST["id_no"])) {
		$errors["id_noErr"] = "ID Number Is Required";
	} else {
		$id_no = test_input($_POST["id_no"]);
		// check if only contains numbers
		if (filter_var($id_no, FILTER_VALIDATE_INT) === false) {
			$errors["id_noErr"] = "Only Numbers Are Allowed";
		}
	}

	if (empty($_POST["gender"])) {
		$errors["genderErr"] = "Gender Is Required";
	} else {
		$gender = test_input($_POST["gender"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[\\\\a-zA-Z\']*$/",$lname)) {
			$errors['lnameErr'] = "Only letters and white space allowed";
		}
	}

	if (empty($_POST["username"])) {
		$errors["usernameErr"] = "Username Is Required";
	} else {
		$username = test_input($_POST["username"]);
		if (!preg_match("/^[\\\\a-zA-Z\']*$/",$username)) {
			$errors['usernameErr'] = "Only letters and white space allowed";
		}
		if ($row['username'] === $_POST['username']) {
			$errors["usernameErr"] = "Username Already Exists";
		}
	}


	if (empty($_POST["email"])) {
		$errors["emailErr"] = "Email Is Required";
	} else {
		$email = test_input($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors["emailErr"] = "Invalid E-mail Format";
		} elseif ($row['email'] === $_POST['email']) {
			$errors["emailErr"] = "E-mail Already Exists";
		}
	}
}



try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	foreach ($stmt = $conn->query("SELECT * FROM users WHERE username = '$_SESSION[name]'") as $row) {

	}
}

catch(PDOException $e)
{
		echo "Error: " . $e->getMessage();
}



?>

<html>
<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	First Name: <br>
	<input type="text" name="fname" value="<?php echo stripslashes($row["fname"])?>">
	<?php echo $errors["fnameErr"]; ?>
	<br><br>
	Last Name: <br>
	<input type="text" name="lname" value="<?php echo stripslashes($row["lname"])?>">
	<?php echo $errors["lnameErr"]; ?><span>
<br><br>
Gender: <br>
<input type="radio" name="gender" <?php if ($row["gender"] =="Female")
	echo "checked";?> value="Female">Female
<input type="radio" name="gender" <?php if ($row["gender"] =="Male")
	echo "checked";?> value="Male">Male
		<?php echo $errors["genderErr"]; ?>
		<br><br>
		ID Number: <br>
<input type="text" name="id_no" value="<?php echo $row["id_no"]?>">
		<?php echo  $errors["id_noErr"]; ?>
		<br><br>
E-mail: <br>
<input type="text" name="email" value="<?php echo $row["email"]?>">
		<?php echo $errors["emailErr"]; ?>
		<br><br>
Username: <br> 
<input type="text" name="username" value="<?php echo $row["username"]?>">
		<?php echo  $errors["usernameErr"]; ?>
		<br><br>

	  <input type="submit" name="submit" value="Submit">
</form>
</body>
</html>

<?php

if(empty($errors) &&  isset($_POST["submit"])) {
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE users SET fname='$fname', lname='$lname', id_no='$id_no', gender='$gender', email='$email', username='$username' WHERE username = '$_SESSION[name]'";
		// Prepare statement
		$stmt = $conn->prepare($sql);
		// execute the query
		$stmt->execute();

		// echo a message to say the UPDATE succeeded
		echo $stmt->rowCount() . " Account UPDATED Successfully";
		header("Refresh: 0; view_profile.php?id=$user_id");
	} catch (PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
}
?>
