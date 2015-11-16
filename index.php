<html>
<body>
<p>Welcome</p>
<?php 
$dbErr = "";
$db = "";
require("functions.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["db"])) {
    $dbErr = "Database Name is required <br>";
  } else {
    $db = test_input(ucname($_POST["db"]));
  }
}

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

Database Name: <br>
<?php echo $dbErr; ?>
<br>
<input type="text" name="db" value="<?php echo $db?>">
<input type="submit" name="submit" value="Install">
</form>


</body>
</html>

<?php

if(isset($_POST["submit"]) && empty($dbErr)){

$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE $db";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Database&nbsp". $db ." created successfully<br>";
	header('Refresh: 3; index.php');
    }
catch(PDOException $e)
    {
    echo "Database&nbsp;" . $db. "&nbsp;";
    }


$dbname = "$db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create table
    $sql = "CREATE TABLE users (
    user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(30) NOT NULL,
    lname VARCHAR(30) NOT NULL,
    gender VARCHAR(30) NOT NULL,
    id_no INT(200) NOT NULL,
    email VARCHAR(50),
    username VARCHAR(30) NOT NULL,
    hashed_password VARCHAR(200) NOT NULL,
    user_type VARCHAR(30) NOT NULL,
    user_status VARCHAR(30) NOT NULL,
    reg_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table users created successfully";
    }
catch(PDOException $e)
    {
    echo  "Already Exist";
    }


    $dbname = "$db";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // sql to create table
        $sql = "CREATE TABLE loans (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED NOT NULL,
    loan DECIAML(8,2) NOT NULL,
    rate VARCHAR (30) NOT NULL,
    period VARCHAR (20) NOT NULL,
    interest DECIMAL (8,2) NOT NULL,
    total DECIMAL (8,2) NOT NULL,
    user_status VARCHAR(30) NOT NULL,
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    )";

        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Table loan created successfully";
    }
    catch(PDOException $e)
    {
        echo  "Already Exist";
    }

$conn = null;
}

?>