<?php
require("functions.php");
require_once("databases.php");
navigation($user_id);
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
	<input type="text" name="fname" value="<?php echo stripslashes($row["fname"])?>" readonly>
	<br><br>
	Last Name: <br>
	<input type="text" name="lname" value="<?php echo stripslashes($row["lname"])?>" readonly>

<br><br>
Gender: <br>
<input type="radio" name="gender" <?php if ($row["gender"] =="Female")
	echo "checked";?> value="Female">Female
<input type="radio" name="gender" <?php if ($row["gender"] =="Male")
	echo "checked";?> value="Male">Male
		<br><br>
ID Number: <br>
<input type="text" name="id_no" value="<?php echo $row["id_no"]?>" readonly>
<br><br>
E-mail: <br>
<input type="text" name="email" value="<?php echo $row["email"]?>" readonly>
		<br><br>
Username: <br> 
<input type="text" name="username" value="<?php echo $row["username"]?>" readonly>
		<br><br>
	<?php
	if($_SESSION["user_type"] === "Member"){
		echo "<a href=member.php?id=$user_id >Back</a> &nbsp;";
	} else {
		echo "<a href=admin.php?id=$user_id>Back</a> &nbsp;";
	}
	?>
	<a href=update_profile.php?id=<?php echo $user_id; ?>>Update profile</a>
</form>
</body>
</html>
