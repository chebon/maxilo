<?php
if (isset($_POST['submit'])) {
    // set up autoloader
    ini_set('display_errors', 1);
    require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

    // configure database
    $dsn      = 'mysql:dbname=maxilo;host=localhost';
    $u = 'root';
    $p = 'chebon01';
    Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(new PDO($dsn, $u, $p));

    // validate input and find user record
    // send reset code by email to user
    try {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $user = Cartalyst\Sentry\Facades\Native\Sentry::findUserByCredentials(array(
            'email' => $email
        ));

        $code = $user->getResetPasswordCode();

        $subject = 'Your password reset code';
        $message = 'Code: ' . $code;
        $headers = 'From: webmaster@example.com';
        if (!mail($email, $subject, $message, $headers)) {
            throw new Exception('Email could not be sent.');
        }

        echo 'Password reset code sent.';
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
<h1>Reset Password</h1>
    <form action="reset-request.php" method="post">
        Email address: <br/>
        <input type="text" name="email" /> <br/>
        <input type="submit" name="submit" value="Submit Request" />
    </form>
</body>
</html>