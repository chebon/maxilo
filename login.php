<?php
// set up autoloader

ini_set('display_errors', 1);
require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');




$throttleProvider = Cartalyst\Sentry\Facades\Native\Sentry::getThrottleProvider();
$throttleProvider->enable();












// configure database
$dsn      = 'mysql:dbname=maxilo;host=localhost';
$u = 'root';
$p = 'chebon01';
Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(new PDO($dsn, $u, $p));

// if form submitted
if (isset($_POST['submit'])) {
    try {
        // validate input
        $username = filter_var($_POST['username'], FILTER_SANITIZE_EMAIL);
        $password = strip_tags(trim($_POST['password']));



        $throttle = $throttleProvider->findByUserLogin($username);
        $throttle->setAttemptLimit(3);
        $throttle->setSuspensionTime(5);


        // set login credentials
        $credentials = array(
            'email'    => $username,
            'password' => $password,
        );

        // authenticate
        // if authentication fails, capture failure message
        Cartalyst\Sentry\Facades\Native\Sentry::authenticate($credentials, false);
    } catch (Exception $e) {
        $failMessage = $e->getMessage();
    }
}

// check if user logged in
if (Cartalyst\Sentry\Facades\Native\Sentry::check()) {
    $currentUser = Cartalyst\Sentry\Facades\Native\Sentry::getUser();
}
?>
<html>
<head></head>
<body>
<?php if (isset($currentUser)): ?>
    Logged in as <?php echo $currentUser->getLogin(); ?>
    <a href="logout.php">[Log out]</a>
<?php else: ?>
    <h1>Log In</h1>
    <div><?php echo (isset($failMessage)) ? $failMessage : null; ?></div>
    <form action="login.php" method="post">
        Username: <input type="text" name="username" /> <br/>
        Password: <input type="password" name="password" /> <br/>
        <input type="submit" name="submit" value="Log In" />
    </form>
<?php endif; ?>
</body>
</html