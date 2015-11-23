<?php
//error_reporting(0);
require("functions.php");
require_once("databases.php");



ini_set('display_errors', 1);
require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');



$dsn = 'mysql:dbname=maxilo;host=localhost';
$u = 'root';
$p = 'chebon01';
Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(new PDO($dsn, $u, $p));




$currentUser = Cartalyst\Sentry\Facades\Native\Sentry::getUser();

if (!$currentUser->hasAccess('view')) {
    throw new Exception ('You don\'t have permission to view this page.');
}









/*




navigation($user_id);
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    foreach( $stmt = $conn->query(
        "SELECT * FROM users LEFT JOIN loans USING (user_id) WHERE user_id = '$user_id'") as $row) {
        $row["id_no"];
        $_SESSION["loan_status"] = $row["loan_status"];
    }

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$id_noErr = $loanErr = $rateErr = "";
$id_no = $loan = $rate = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["id_no"])) {
        $errors["id_noErr"] = "ID Number Is Required";
    } else {
        $id_no = test_input($_POST["id_no"]);
        // check if only contains numbers
        if (filter_var($id_no, FILTER_VALIDATE_INT) === false) {
            $errors["id_no"] = "Only Numbers Are Allowed";
        }
        if ($row['id_no'] !== $id_no) {
            $errors["id_noErr"] = "ID Number Does Not Match Records";
        }
    }

    if($_SESSION["loan_status"] === "Un-Paid") {
        $errors["loan_status"] = "Sorry&nbsp; Your Acccount Has A Loan Balance.<br>";
    }


    if (empty($_POST["loan"])) {
        $errors["loanErr"] = " Loan Is Required";
    } else {
        $loan = test_input($_POST["loan"]);
        // check if only contains numbers
        if (filter_var($loan, FILTER_VALIDATE_INT) === false) {
            $errors["loanErr"] = "Only Numbers Are Allowed";
        }

        if ($loan < 2000){
            $errors["loanErr"] = "Loan Can Not Be Less Than 2000 ";
        }

        if ($loan > 5000){
            $errors["loanErr"] = "Loan Can Not Be More Than 5000";
        }
    }




}

if(empty($errors) && isset($_POST["submit"])) {
    $loan_status = "Un-Paid";
    $loan = $_POST["loan"];
    $rate = $_POST["rate"];
    $period = $_POST["period"];
    $interest = $rate * $loan / 100;
    $total = $loan + $interest;
    try {

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO loans (user_id, loan, rate, period, interest, total, loan_status)
                          VALUES ('$user_id','$loan','$rate','$period','$interest','$total' , '$loan_status')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Loan Procured Successfully<br>";
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}

*/


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

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form-group col-xs-3 col-lg-offset-4 ">
<?php if(isset($errors["loan_status"]) && empty($errors["id_noErr"]) && empty($errors["loanErr"])){
    echo $errors["loan_status"];
} ?>
ID Number: <br>
<input type="text" name="id_no" value="<?php echo $id_no?>" class="form-control ">
<?php echo  $errors["id_noErr"]; ?>
<br><br>


Loan: <br>
<input type="text" name="loan" value="<?php echo $loan?>" class="form-control ">
<?php echo $errors["loanErr"]; ?>
<br><br>


<?php $rate = 30; ?>
Rate (%): <br>
<input type="text" name="rate" value="<?php echo $rate . '%';?>" readonly class="form-control " >
<?php echo  $errors["rateErr"]; ?>
<br><br>


Validity Period (Days): <br>
<input type="text" name="period" value="<?php echo "30&nbsp;Days"?>" readonly class="form-control "/>
<br><br>

<?php
$interest = $rate * $loan / 100; ?>
Interest (<?php echo $rate;?>% of Loan): <br>
<input type="text" name="interest" value="<?php echo $interest; ?>"   class="form-control " readonly/>
<br><br>

<?php $total = $interest + $loan; ?>
Total Loan: <br>
<input type="text" name="total" value="<?php echo $total?>" class="form-control " readonly/>
<br><br>
<input type="submit" name="submit" value="Submit">
<br>
  <?php  echo "<a href= member.php?id=$user_id>Back</a>"; ?>
</form>
</table>
</body>
</html>
