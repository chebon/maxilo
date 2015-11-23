<?php
// set up autoloader
/*require ('vendor\autoload.php');*/




ini_set('display_errors', 1);
require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');


// configure database
$dsn      = 'mysql:dbname=maxilo;host=localhost';
$u = 'root';
$p = 'chebon01';
Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
    new PDO($dsn, $u, $p));

// log user out
Cartalyst\Sentry\Facades\Native\Sentry::logout();
?>