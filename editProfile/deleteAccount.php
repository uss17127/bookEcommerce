<?php
// connect to database
require('database.php');
// the session must be started at the very beginning. Session is like a global variable that you can access in any page.
session_start();

// if the user session is set from the login page
if(isset($_SESSION['user'])) {
    // $user is a variable that represents the user session variable
    $user = $_SESSION['user'];
}
if (isset($_POST['deleteAccount'])) {
    $delete = "DELETE FROM registeredusers WHERE Email='$user'";
    // query (SQL command)
    $statement = $db->prepare($delete);
    $statement -> execute();
    setcookie('user', '', time()-3600, "/");
    setcookie('pass', '', time()-3600, "/");
    header('location: ../MainPage/logout.php');
}
?>