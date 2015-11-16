<?php
require_once("databases.php");
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
foreach($conn->query('SELECT * FROM users') as $row) {

    echo  
	$row['fname'].'  '.$row['lname'].' | '.$row['gender'].' | '.$row['email'].' | '.$row['username'] .' | '.$row['reg_date'] .' | '.$row['user_type'] ;
	echo "<a href='edit.php'> Edit</a>"; 
	echo " | ";
	echo "<a href='view.php'> Read</a>"; 
	echo "<br>";
	echo "<hr>";
}

echo "<ol>";
echo "<li>a</li>";
echo "<li>a</li>";
echo "<li>a</li>";
echo "</ol>";

?>