

<?php
// set up autoloader
ini_set('display_errors', 1);
require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

// configure database
$dsn      = 'mysql:dbname=maxilo;host=localhost';
$u = 'root';
$p = 'chebon01';
Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
    new PDO($dsn, $u, $p));

if (isset($_POST['submit'])) {

    try {
        $id = strip_tags($_POST['id']);
        $user = Cartalyst\Sentry\Facades\Native\Sentry::findUserById($id);
        $user->email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $user->first_name = strip_tags($_POST['first_name']);
        $user->last_name = strip_tags($_POST['last_name']);
        $user->password = strip_tags($_POST['password']);

        if ($user->save()) {
            echo 'User successfully updated.';
            exit;
        } else {
            throw new Exception('User could not be updated.');
        }
    } catch (Exception $e) {
        echo 'User could not be created.';
        exit;
    }

} else if (isset($_GET['id'])) {

    try {
        $id = strip_tags($_GET['id']);
        $user = Cartalyst\Sentry\Facades\Native\Sentry::findUserById($id);
        $userArr = $user->toArray();
    } catch (Exception $e) {
        echo 'User could not be found.';
        exit;
    }

    ?>
    <html>
    <head></head>
    <body>
    <h1>Edit User</h1>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"
              method="post">
            Email address: <br/>
            <input type="text" name="email"
                   value="<?php echo $userArr['email']; ?>" /> <br/>
            Password: <br/>
            <input type="password" name="password"
                   value="<?php echo $userArr['password']; ?>" /> <br/>
            First name: <br/>
            <input type="text" name="first_name"
                   value="<?php echo $userArr['first_name']; ?>" /> <br/>
            Last name: <br/>
            <input type="text" name="last_name"
                   value="<?php echo $userArr['last_name']; ?>" /> <br/>
            <input type="hidden" name="id"
                   value="<?php echo $userArr['id']; ?>" /> <br/>
            <input type="submit" name="submit" value="Update" />
        </form>
    </body>
    </html>
<?php
}
?>