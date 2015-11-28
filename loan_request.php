
<html>
<head>
    <title>loan request</title>
    <link rel="stylesheet" type="css/bootstrap.min.css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="css/flat-ui.css" href="css/flat-ui.css">
    <link rel="stylesheet" type="css/flat-ui.css" href="css/custom.css">
</head>
<body>

<?php

//ini_set('display_errors', 1);
require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
/*require ($_SERVER['DOCUMENT_ROOT'].'/databases.php');*/



$dsn = 'mysql:dbname=maxilo;host=localhost';
$u = 'root';
$p = 'chebon01';
Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(new PDO($dsn, $u, $p));




$currentUser = Cartalyst\Sentry\Facades\Native\Sentry::getUser();

if (!$currentUser->hasAccess('view')) {
    throw new Exception ('You don\'t have permission to view this page.');
}




 $currentUser = json_decode($currentUser, true);


$user_id =  $currentUser['id'];

$first_name = $currentUser['first_name'];
$last_name = $currentUser['last_name'];
$email = $currentUser['email'];



$info = $_POST["amount"];
$interest = 0.33;



$total = ($info*$interest)+$info;



if(isset($_POST["submit"])) {
    $hostname = 'localhost';
    $username = 'root';
    $password = 'chebon01';


    try {





        $dbh = new PDO("mysql:host=$hostname;dbname=maxilo", $username, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $sql = "INSERT INTO loans (user_id, amount, rate, total)
VALUES ('" . $user_id . "','" . $_POST["amount"] . "','" .$interest . "','" .$total . "')";

        $dbh->query($sql);

        $dbh = null;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

?>





<div class="  row no-gutter col-lg-offset-4 bonche-top">

    <div class="col-xs-2">
    <?php echo $first_name?>
    </div>

    <div class="col-xs-2">
    <?php echo $last_name?>
    </div>
    <div class="col-xs-2">
    <?php echo $email ?>
    </div>
</div>


<div class="container-fluid col-lg-6 col-lg-offset-4">

    <div>
    <h3>loan request form</h3>
    <div id="login">
        <hr/>
        <form action="" method="post">

            <div class="col-lg-offset-1">
            <label>Amount  : </label>
            <input type="text" name="amount" id="amount" required="required" placeholder="Please Enter amount"/><br /><br />
            </div>

            <div class="col-lg-offset-3">

            <input type="submit" value=" Submit " name="submit"/><br />

            </div>
        </form>





    </div>

    </div>

    <div>
        <h3>expected amount<?php echo $total ?></h3>

    </div>



</div>

</body>




</html>


