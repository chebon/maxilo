
<?php


ini_set('display_errors', 1);
require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

// configure database
$dsn      = 'mysql:dbname=maxilo;host=localhost';
$u = 'root';
$p = 'chebon01';
Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
    new PDO($dsn, $u, $p));

// find all users
$users = Cartalyst\Sentry\Facades\Native\Sentry::findAllUsers();
?>
<html>
<head></head>
<body>
<h1>Users</h1>
<table border="1">
    <tr>
        <td>Email address</td>
        <td>First name</td>
        <td>Last name</td>
        <td>Status</td>
        <td>Last login</td>
    </tr>
    <?php foreach ($users as $u): ?>
        <?php $userArr = $u->toArray(); ?>
        <tr>
            <td><?php echo $userArr['email']; ?></td>
            <td><?php echo isset($userArr['first_name']) ?
                    $userArr['first_name'] : '-'; ?></td>
            <td><?php echo isset($userArr['last_name']) ?
                    $userArr['last_name'] : '-'; ?></td>
            <td><?php echo ($userArr['activated'] == 1) ?
                    'Active' : 'Inactive'; ?></td>
            <td><?php echo isset($userArr['last_login']) ?
                    $userArr['last_login'] : '-'; ?></td>
            <td><a href="edit.php?id=<?php echo $userArr['id']; ?>">
                    Edit</a></td>
            <td><a href="delete.php?id=<?php echo $userArr['id']; ?>">
                    Delete</a></td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="creation.php">Add new user</a>
<body>
</html>