<?php 
// the session must be started at the very beginning. Session is like a global variable that you can access in any page.
// session lasts until it is ended; cookies last depending on the time() that you set it to
session_start();
// if the user session is already set (if the user is already logged in)
if (isset($_SESSION['user'])) {
    // if the user cookie is also set
    if (isset($_COOKIE['loginUser'])) {
        if ($_SESSION['typeNumber'] == 1) {
            // you are redirected to the main page because the user already logged in beforehand
            header('location: ../MainPage/mainpage2.php');
        } else if ($_SESSION['typeNumber'] == 2) {
            // if the person logged in is a vendor
            header('location: ../vendorView/vendorView.php');
        } else if ($_SESSION['typeNumber'] == 3) {
            // if the person logged in is an admin
            header('location: ../adminView/adminView.php');
        }
    }
}

// if the user clicks the login button ('login' is the name of the form)
if (isset($_POST['login'])) {
    // getting the form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = $_POST['remember'];

    // SQL statement
    $sql = "SELECT * FROM registeredusers WHERE Email='$email' && Password='$password'";
    // Connect to database
    require('database.php');
    // query (SQL command)
    $statement = $db->prepare($sql);
    $statement -> execute();

    // if the account exists in the database
    if ($statement->rowCount() == 1) {
        // this is to prevent the case of making repetitive user sessions (basically avoiding override and taking up too much resources)
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        /*
        if (isset($_SESSION['accountName'])) {
            unset($_SESSION['accountName']);
        }*/
        // call the email session variable so that the website remembers the user's email (primary key for identifying the user's account)
        // user session is now the same as email variable
        // most important session variable for the entire website
        $_SESSION['user'] = $email;

        /*
        $thisFirstName = "SELECT FirstName FROM registeredusers WHERE Email='$email' && Password='$password'";
        $thisLastName = "SELECT LastName FROM registeredusers WHERE Email='$email' && Password='$password'";
        // echo this session variable onto the top right of the main page
        $_SESSION['accountName'] = $thisFirstName + " " + $thisLastName;
        */

        // if the user wants the website to remember the login info for a temporary amount of time
        if ($remember == 1) {
            // this cookie is created so that after a user logs in once, they are redirected to the main page every time they access the login page
            // time is 3600 because the user should not be logged in to his/her account for too long
            setcookie('loginUser', TRUE, time()+3600);

            // set cookie functions, you need to provide the name, value, and expiry name of the cookie
            
            // these cookies are set so that if the user logs out, then the user's email and password are saved/shown onto the text fields of the form when they go back to the login page
            setcookie('user', $email, time()+60*60*24*10, "/");
            setcookie('pass', $password, time()+60*60*24*10, "/");
        } else {
            // if either the cookie for user or the cookie for password is set, then you have to unset them and expire the cookies
            if (isset($_COOKIE['user'])) {
                unset($_COOKIE['user']);
                setcookie('user', '', time()-3600, "/");
            }
            if (isset($_COOKIE['pass'])) {
                unset($_COOKIE['pass']);
                setcookie('pass', '', time()-3600, "/");
            }
            // this is to prevent the case of making repetitive cookies for logged in users (basically avoiding override and taking up too much resources)
            if (isset($_COOKIE['loginUser'])) {
                unset($_COOKIE['loginUser']);
            }
        }
        $command = "SELECT UserType FROM registeredusers WHERE Email='$email' && Password='$password'";
        $statement2 = $db->prepare($command);
        $statement2->execute();
        $uType = $statement2->fetch();
        $_SESSION['typeNumber'] = $uType['UserType'];
        if ($_SESSION['typeNumber'] == 1) {
            // if the person logged in is a regular user
            header('location: ../MainPage/mainpage2.php');
        } else if ($_SESSION['typeNumber'] == 2) {
            // if the person logged in is a vendor
            header('location: ../vendorView/vendorView.php');
        } else if ($_SESSION['typeNumber'] == 3) {
            // if the person logged in is an admin
            header('location: ../adminView/adminView.php');
        }
    } else {
        // this is to prevent the case of making repetitive message sessions or if the message session is unset incorrectly (basically avoiding override and taking up too much resources)
        if (isset($_SESSION['message'])) {
            unset($_SESSION['message']);
        }
        // creates a session variable for printing out 
        $_SESSION['message'] = "Incorrect username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!-- name of tab -->
        <title>Sign in</title>
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>
        <?php include "login.css" ?>
        </style>
    </head>
    <body>
        <nav class="navbar navbar-light justify-content-around" style="background-color: #EDA39D;">
        <a class="navbar-brand" id="brand" href="../MainPage/mainPage2.php">Red-Wagon Books</a>
        </nav>
        <div class="overlay">
            <div class="contain">
                <h3> Sign In </h3>
                <form class="logIn" method="post" name="form" action="">
                    <!-- Cookies values will be written into email and password -->
                    <div class="eMail">
                        <input type="text" name="email" class="un" id="email" placeholder="Email" value="<?php if(isset($_COOKIE['user'])) echo $_COOKIE['user'];?>">
                    </div>
                    <br>
                    <div class="passWord">
                        <input type="password" name="password" class="pw" id="password" placeholder="Password" value="<?php if(isset($_COOKIE['pass'])) echo $_COOKIE['pass'];?>">
                    </div>
                    <br>

                    <div class="loginButton">
                        <input type="submit"  class='btn btn-info'style='background-color:#f78b8b;border-color:#f78b8b;color:black' name ="login" class="lb" value="Get Started">
                        <!-- This is where it prints out the error message -->
                        <br><br><p id="errorMsg"><?php if(isset($_SESSION['message'])) echo $_SESSION['message']?></p>
                        <!-- This is to unset the message session after it is printed -->
                        <?php unset($_SESSION['message']);?>
                    </div>
                    <br>
                    <div class="formCheck"> 
                        <label class="formCheckLabel text-muted">
                            <input type='hidden' value='0' name="remember">
                            <!-- This php code allows the Remember Me checkbox to be still checked after the user logs out IF AND ONLY IF the user checked this box the first time he/she logged in (if the user cookie was set) -->
                            <input type="checkbox" name="remember" <?php if(isset($_COOKIE['user'])) {?> checked <?php } ?> value="1" class="formCheckInput"> 
                            Keep me signed in
                        </label>
                    </div>
                    <br>
                    <div class="forgotPass">
                        <a href="forgotPassword.php">Forgot Password?</a>
                    </div>
                    <!-- This hyperlink allows the user to go to the register page in case he/she does not have an account already -->
                    <div class="noAccount">
                        Don't have an account? <a href="../RegistrationPage/RegistrationPage.php" class="createAccount">Register</a>
                        <br>
                        <br>
                        <br>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>