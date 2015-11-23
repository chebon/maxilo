<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 23/11/15
 * Time: 12:56
 */



ini_set('display_errors', 1);
require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

// configure database
$dsn = 'mysql:dbname=maxilo;host=localhost';
$u = 'root';
$p = 'chebon01';
Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
    new PDO($dsn, $u, $p));

// create group record
try {

    $group1 = Cartalyst\Sentry\Facades\Native\Sentry::createGroup(array(
        'name'    => 'staff',
        'permissions' => array(
            'view' => 1,
            'add' => 1,
            'edit' => 0,
            'delete' => 0
        )
    ));

    $group2 = Cartalyst\Sentry\Facades\Native\Sentry::createGroup(array(
        'name'    => 'managers',
        'permissions' => array(
            'view' => 1,
            'add' => 1,
            'edit' => 1,
            'delete' => 1
        )
    ));


    $group3 = Cartalyst\Sentry\Facades\Native\Sentry::createGroup(array(
        'name'    => 'members',
        'permissions' => array(
            'view' => 1,
            'add' => 1,
            'edit' => 0,
            'delete' => 0
        )
    ));

} catch (Exception $e) {
    echo $e->getMessage();
}
?>