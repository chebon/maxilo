<?php
require_once("databases.php");
$fname = "Maxwell";
		try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE users SET fname='$fname' WHERE id=1";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . " records UPDATED successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
echo "<br>";
echo print_r($_POST);
?>