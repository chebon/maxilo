<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 23/11/15
 * Time: 12:13
 */




if (isset($_POST['submit'])) {
    // set up autoloader



    ini_set('display_errors', 1);
    require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

    // configure database
    $dsn      = 'mysql:dbname=maxilo;host=localhost';
    $u = 'root';
    $p = 'chebon01';
    Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
        new PDO($dsn, $u, $p));

    // validate input and create user record
    // send activation code by email to user
    try {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $fname = strip_tags($_POST['first_name']);
        $lname = strip_tags($_POST['last_name']);
        $password = strip_tags($_POST['password']);

        $user = Cartalyst\Sentry\Facades\Native\Sentry::createUser(array(
            'email'    => $email,
            'password' => $password,
            'first_name' => $fname,
            'last_name' => $lname,
            'activated' => true
        ));

        $code = $user->getActivationCode();

        $subject = 'Your activation code';
        $message = 'Code: ' . $code;
        $headers = 'From: webmaster@example.com';
        if (!mail($email, $subject, $message, $headers)) {
            throw new Exception('Email could not be sent.');
        }

        echo 'User successfully registered and activation code sent.';
        exit;
    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }
}
?>
<html>
<head></head>
<body>
<h1>Register</h1>
    <form action="register.php" method="post">
        Email address: <br/>
        <input type="text" name="email" /> <br/>
        Password: <br/>
        <input type="password" name="password" /> <br/>
        First name: <br/>
        <input type="text" name="first_name" /> <br/>
        Last name: <br/>
        <input type="text" name="last_name" /> <br/>
        <input type="submit" name="submit" value="Create" />
    </form>
</body>
</html>
