<?php
session_start();
require('database.php');
$accountEmail = $_SESSION['thisEmail'];

// if the user clicks the Submit button
if (isset($_POST['resetPwd'])) {
    $newPassword = $_POST['InputPassword1'];
    $confirmPassword = $_POST['InputPassword2'];
    $validInput = true;
    if ($newPassword == "") {
        $_SESSION['errorMsg3'] = "Please enter a new password.";
        $validInput = false;
    } else if ($confirmPassword == "") {
        $_SESSION['errorMsg4'] = "Please confirm your new password.";
        $validInput = false;
    } else if ($newPassword != $confirmPassword) {
        $_SESSION['errorMsg4'] = "Passwords do not match. Please try again.";
        $validInput = false;
    }
    if ($validInput) {
        $statement = $db->prepare("UPDATE registeredusers SET Password='$newPassword' WHERE Email='$accountEmail'");
        $statement->execute();
        header('location: login.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="newPassword.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>


<body>

    <!--Search Bar and Logo-->
    <nav class="navbar navbar-light justify-content-around" style="background-color: #EDA39D;">
        <a class="navbar-brand" id="brand">Red-Wagon Books</a>
    </nav>


    <!-- User Registration Form -->
    <div class="container px-2 py-2">
        <div class="container border border-dark rounded">
            <form name="changepwd" class="px-3 py-3" action="" method="post">
                <h2 id="formTitle">Change Password</h2>
                <small id="accountHelp" class="form-text text-muted px-1 py-1">Enter your new password below.</small>

                <div class="form-group">
                    <input type="password" class="form-control" id="newPwd1" name="InputPassword1" placeholder="Enter New Password">
                    <p id="errorMessage" class="text-danger"><?php if (isset($_SESSION['errorMsg3'])) echo $_SESSION['errorMsg3'] ?></p>
                    <?php unset($_SESSION['errorMsg3']); ?>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" id="newPwd2" name="InputPassword2" placeholder="Confirm New Password">
                    <p id="errorMessage" class="text-danger"><?php if (isset($_SESSION['errorMsg4'])) echo $_SESSION['errorMsg4'] ?></p>
                    <?php unset($_SESSION['errorMsg4']); ?>
                </div>

                <input type="submit" name="resetPwd" class="btn btn-dark" value="Submit">

            </form>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>