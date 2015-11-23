<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 23/11/15
 * Time: 12:32
 */

if (isset($_GET['id'])) {
    // set up autoloader


    ini_set('display_errors', 1);
    require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

    // configure database
    $dsn      = 'mysql:dbname=maxilo;host=localhost';
    $u = 'root';
    $p = 'chebon01';
    Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
        new PDO($dsn, $u, $p));

    // find user by id and delete
    try {
        $id = strip_tags($_GET['id']);
        $user = Cartalyst\Sentry\Facades\Native\Sentry::findUserById($id);
        $user->delete();
        echo 'User successfully deleted.';
    } catch (Exception $e) {
        echo 'User could not be deleted.';
    }
}
?>