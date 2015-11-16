<?Php
require("functions.php");
session_unset();
session_destroy();

redirect("login.php");
?>
