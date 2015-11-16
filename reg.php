<?php
error_reporting(0);
require("functions.php");
require_once("databases.php");
$genderErr = $fnameErr = $lnameErr = $usernameErr = $emailErr = $passwordErr = $id_noErr = "";
$user_type = $gender = $fname = $lname = $username = $email = $password = $id_no = "";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    foreach( $stmt = $conn->query("SELECT username, email, id_no FROM users") as $row) {
        $_SESSION["email"] = $row["email"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["id_no"] = $row["id_no"];
     }
   
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;


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

 if (empty($_POST["gender"])) {
     $errors["genderErr"] = "Gender Is Required";
   } else {
     $gender = test_input($_POST["gender"]);
    // check if name only contains letters and whitespace
     if (!preg_match("/^[\\\\a-zA-Z\']*$/",$lname)) {
       $errors['lnameErr'] = "Only letters and white space allowed";
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
        if ($_SESSION["id_no"] === $_POST["id_no"]) {
            $errors["id_noErr"] = "ID Number Already Exists";
        }
    }

  if (empty($_POST["username"])) {
    $errors["usernameErr"] = "Username Is Required";
  } else {
    $username = test_input($_POST["username"]);
     if (!preg_match("/^[\\\\a-zA-Z\']*$/",$username)) {
       $errors['usernameErr'] = "Only letters and white space allowed";
     }
    if ($_SESSION['username'] === $_POST['username']) {
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
    } elseif ($_SESSION['email'] === $_POST['email']) {
        $errors["emailErr"] = "E-mail Already Exists";
    }
  }

 if (empty($_POST["password"])) {
    $errors["passwordErr"] = "Password Is Required";	
  } else {
    $password = test_input($_POST["password"]);
  }

  if (empty($_POST["password1"])) {
    $errors["password1Err"] = "Re-Enter Password";	
  } else {
    $password = test_input($_POST["password1"]);
   }
     if ($_POST['password'] !== $_POST['password1']) {
        $errors["password1Err"] = "Passwords Do Not Match";
  } 
} 

if(empty($errors) && isset($_POST["submit"])) {
    $user_type = "Member";
    $user_status = "Activated";
$hashed_password = hash_password($_POST['password']);
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO users (fname, lname, gender, id_no, email, username, hashed_password, user_type, user_status)
    VALUES ('$fname','$lname','$gender', '$id_no', '$email','$username','$hashed_password', '$user_type', '$user_status')";
     // use exec() because no results are returned
    $conn->exec($sql);
    echo "Account Created Successfully<br>";
    header('Refresh: 3; login.php');
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}
?>

<html>
<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
First Name: <br>
<input type="text" name="fname" value="<?php echo stripslashes($fname)?>">
<?php echo $errors["fnameErr"]; ?>
<br><br>
Last Name: <br> 
<input type="text" name="lname" value="<?php echo stripslashes($lname)?>">
<?php echo $errors["lnameErr"]; ?><span>
<br><br>
Gender: <br>
<input type="radio" name="gender" <?php if (isset($gender) && $gender=="Female")
echo "checked";?> value="Female">Female
<input type="radio" name="gender" <?php if (isset($gender) && $gender=="Male")
echo "checked";?> value="Male">Male
<?php echo $errors["genderErr"]; ?>
<br><br>
ID Number: <br>
<input type="text" name="id_no" value="<?php echo $id_no?>">
<?php echo  $errors["id_noErr"]; ?>
<br><br>
E-mail: <br>
<input type="text" name="email" value="<?php echo $email?>">
<?php echo $errors["emailErr"]; ?>
<br><br>
Username: <br> 
<input type="text" name="username" value="<?php echo $username?>">
<?php echo  $errors["usernameErr"]; ?>
<br><br>
Password: <br> 
<input type="password" name="password" value="">
<?php echo $errors["passwordErr"]; ?>
<br><br>
Re-Enter Password: <br> 
<input type="password" name="password1" value="">
<?php echo $errors["password1Err"]; ?>
<br><br>

	  <input type="submit" name="submit" value="Submit">
        <br>
        <a href="login.php">Login</a>
</form>
</body>
</html> 