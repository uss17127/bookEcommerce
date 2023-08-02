<?php
session_start();

// if the user clicks the Continue button
if (isset($_POST['nextPage'])) {
    $inputEmail = $_POST['InputEmail1'];
    
    // SQL statement
    $sql = "SELECT * FROM registeredusers WHERE Email='$inputEmail'";
    // Connect to database
    require('database.php');
    // query (SQL command)
    $statement = $db->prepare($sql);
    $statement -> execute();

    // if an account exists in the database with this email
    if ($statement->rowCount() == 1) {
        $_SESSION['thisEmail'] = $inputEmail;
        header('location: passwordConfirmation.php');
    } else if (strlen($inputEmail) == 0) {
        $_SESSION['errorMsg1'] = "Please enter an email.";
    } else {
        $_SESSION['errorMsg1'] = "An account with this email does not exist.";
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
    <link rel="stylesheet" href="forgotPassword.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>


<body>

    <!--Search Bar and Logo-->
    <nav class="navbar navbar-light justify-content-around" style="background-color: #EDA39D;">
        <a class="navbar-brand" id="brand" href="../MainPage/mainPage2.php">Red-Wagon Books</a>
    </nav>


    <!-- User Registration Form -->
    <div class="container px-2 py-2">
        <div class="container border border-dark rounded">
            <form name="forgot" class="px-3 py-3" action="" method="post">
                <h2 id="formTitle">Password Assistance</h2>
                <small id="accountHelp" class="form-text text-muted px-1 py-1">Enter the email address associated with your account.<br></small>
                <div class="form-group">
                    <label for="InputEmail1">Email Address</label>
                    <input type="text" class="form-control" id="InputEmail1" name="InputEmail1" placeholder="Enter Email">
                </div>
                <p id="errorMessage" class="text-danger"><?php if(isset($_SESSION['errorMsg1'])) echo $_SESSION['errorMsg1']?></p>
                <?php unset($_SESSION['errorMsg1']);?>
                <input type="submit" name="nextPage" class="btn btn-dark" class='btn btn-info'style='background-color:#f78b8b;border-color:#f78b8b;color:black' value="Continue">
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