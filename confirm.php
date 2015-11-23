<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 23/11/15
 * Time: 12:25
 */



if (isset($_GET['code']) && $_GET['email']) {

    // set up autoloader


    ini_set('display_errors', 1);
    require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');




    // configure database
    $dsn      = 'mysql:dbname=maxilo;host=localhost';
    $u = 'root';
    $p = 'chebon01';
    Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(new PDO($dsn, $u, $p));

    // find user by email address
    // activate user with activation code
    try {
        $code = strip_tags($_GET['code']);
        $email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
        $user = Cartalyst\Sentry\Facades\Native\Sentry::findUserByCredentials(array(
            'email' => $email
        ));
        if ($user->attemptActivation($code)) {
            echo 'User activated.';
        } else {
            throw new Exception('User could not be activated.');
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>