<?php
session_start();
error_reporting(0);
require_once("databases.php");
function redirect($url)
{
	header("Location: $url");
}
/* --------------------------------------------------------------------------------- */
function hash_password($password)
{
	$cost = 10;
	$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
	$salt = sprintf("$2a$%02d$", $cost) . $salt;
	$hash = crypt($password, $salt);
	return $hash;
}
/* --------------------------------------------------------------------------------- */

function test_input($data) 
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = addslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
/* --------------------------------------------------------------------------------- */

function ucname($string) 
{
    $string =ucwords(strtolower($string));

    foreach (array('-', '\'') as $delimiter) {
      if (strpos($string, $delimiter)!==false) {
        $string =implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
      }
    }
    return $string;
}
/* --------------------------------------------------------------------------------- */

function find_user_by_username($username, $email)
{
	try
	{
		$servername = "localhost";
		$user = "root";
		$pass = "";
		$dbname = "welcome";
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT * FROM users WHERE username=:username OR email=:email LIMIT 1");
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':email', $email);
		$stmt->execute();

		if( $user_set = $stmt->fetch(PDO::FETCH_ASSOC))
		{

			return $user_set;
		} else {
			$_SESSION["error_msg"] = "Username/Password/Email Not Found <br>";
			return null;
		}

	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
	$conn = null;
}

/* --------------------------------------------------------------------------------- */
function attempt_login($username, $password, $email)
{
	$user_set = find_user_by_username($username, $email);
		if(password_verify($password, $user_set["hashed_password"]))
		{
			$_SESSION["name"] = $user_set["username"];
			$_SESSION["mail"] = $user_set["email"];
			$_SESSION["user_type"] = $user_set["user_type"];
			$_SESSION["user_status"] = $user_set["user_status"];
			$_SESSION["user_id"] = $user_set["user_id"] ;
			return $user_set;
		} else
		{
			$_SESSION["error_msg"] = "Username/Password/Email Not Found <br>";
			return false;
		}

}
/* --------------------------------------------------------------------------------- */

$user_id = $_SESSION["user_id"];
function navigation($user_id){
	global $user_id;
	if(!isset($user_id)){
		echo "Sorry, Please <a href=\"login.php\">login</a>";
		exit;
	}else {
		if($_SESSION["user_type"] === "Member"){
			echo "<a href=member.php?id=$user_id>Home</a><br>";
			echo "<a href=loan_request.php?id=$user_id>Request Loan</a><br>";
		}

		if($_SESSION["user_type"] === "Admin"){
			echo "<a href=admin.php?id=$user_id>Home</a><br>";
			echo "<a href=statistics.php?id=$user_id>Statistics</a><br>";
			echo "<a href=users.php?id=$user_id>Users</a><br>";
		}

		echo "<a href=view_profile.php?id=$user_id>View Profile</a><br>";
		echo "<a href=update_profile.php?id=$user_id>Update Profile</a><br>";
		echo "<a href=change_password.php?id=$user_id>Change Password</a><br>";
		echo "<a href=logout.php>Logout</a><br>";
		echo "<br><code>Welcome</code>&nbsp;";
		echo "<br><code>Your Are A:</code>&nbsp;" . $_SESSION["user_type"];
		echo "<br><code>Your Username Is:</code>&nbsp;" . $_SESSION["name"];
		echo "<br><code>Your E-mail Address Is:</code>&nbsp;" . $_SESSION["mail"];
		echo "<br><code>user id:</code>&nbsp;" . $user_id ;
		echo "<br>";
	}
	return true;
}


/* --------------------------------------------------------------------------------- */
//function loans_set(){
//	try {
//		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
//		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//		foreach( $stmt = $conn->query("SELECT * FROM loans") as $row) {
//			$_SESSION["loan_id"] = $row["id"];
//			$_SESSION["loan_status"] = $row["loan_status"];
//		}

//	}
//	catch(PDOException $e) {
//		echo "Error: " . $e->getMessage();
//	}
//	$conn = null;
//}
?>