<?php
// starts session to access the session
session_start();
// set the cookie to a past time (-3000) so that it expires
setcookie('loginUser', '', time()-3000);
// freezes up the stored address (session variable)
session_unset();
// completely closes the session
session_destroy();
// redirects to login page
header('location: ../MainPage/mainPage2.php');
?>