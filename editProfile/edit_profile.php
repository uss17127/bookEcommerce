<?php
// connect to database
require('database.php');
// the session must be started at the very beginning. Session is like a global variable that you can access in any page.
session_start();

// if the user session is set from the login page
if (isset($_SESSION['user'])) {
    // $user is a variable that represents the user session variable
    $user = $_SESSION['user'];
} else {
    header("location: login.php");
}

if (isset($_POST['changeFName'])) {
    $userFName = $_POST['firstName'];
    $validInput = true;
    if (empty($userFName)) {
        $_SESSION['message1'] = "First name is required. Please try again.";
        $validInput = false;
    }
    if ($validInput) {
        $statement = $db->prepare("UPDATE registeredusers SET FirstName='$userFName' WHERE Email='$user'");
        $statement->execute();
        $_SESSION['message2'] = "First name is successfully updated.";
    }
}

if (isset($_POST['changeLName'])) {
    $userLName = $_POST['lastName'];
    $validInput = true;
    if (empty($userLName)) {
        $_SESSION['message3'] = "Last name is required. Please try again.";
        $validInput = false;
    }
    if ($validInput) {
        $statement = $db->prepare("UPDATE registeredusers SET LastName='$userLName' WHERE Email='$user'");
        $statement->execute();
        $_SESSION['message4'] = "Last name is successfully updated.";
    }
}

if (isset($_POST['changePass'])) {
    $userPass = $_POST['passWord'];
    $confirmPass = $_POST['confirmPassword'];
    $validInput = true;
    if (empty($userPass)) {
        $_SESSION['message5'] = "New password is required. Please try again.";
        $validInput = false;
    } else if (empty($confirmPass)) {
        $_SESSION['message5'] = "You need to confirm your password. Please try again.";
        $validInput = false;
    } else if (($userPass === $confirmPass) == false) {
        $_SESSION['message5'] = "Passwords do not match. Please try again.";
        $validInput = false;
    }
    if ($validInput) {
        $statement = $db->prepare("UPDATE registeredusers SET Password='$userPass' WHERE Email='$user'");
        $statement->execute();
        $_SESSION['message6'] = "Password is successfully updated.";
    }
}

if (isset($_POST['changeBday'])) {
    $userBday = $_POST['birthday'];
    $validInput = true;
    if (empty($userBday)) {
        $_SESSION['message7'] = "Birthday is required. Please try again.";
        $validInput = false;
    } else if (isRealDate($userBday) == false) {
        $_SESSION['message7'] = "Birthday does not exist or is typed in the wrong format. Please try again.";
        $validInput = false;
    }
    if ($validInput) {
        $statement = $db->prepare("UPDATE registeredusers SET Date='$userBday' WHERE Email='$user'");
        $statement->execute();
        $_SESSION['message8'] = "Birthday is successfully updated.";
    }
}

// ensures if the inputted birthday exists or is typed in the correct format
function isRealDate($date)
{
    if (false === strtotime($date)) {
        // return false if it is not a valid date
        return false;
    }
    if (substr_count($date, "-") != 2) {
        // return false if the number of - is not equal to 2
        return false;
    }
    list($year, $month, $day) = explode('-', $date);
    return checkdate($month, $day, $year);
}

// if the Update Address button is clicked
if (isset($_POST['changeAddress'])) {
    $addrStreet = $_POST['streetAddr'];
    $addrCity = $_POST['cityAddr'];
    $addrState = $_POST['stateAddr'];
    $addrZip = $_POST['zipAddr'];
    $validInput = true;
    if (empty($addrStreet)) {
        $_SESSION['message9'] = "Street is required. Please try again.";
        $validInput = false;
    }
    if (empty($addrCity)) {
        $_SESSION['message10'] = "City is required. Please try again.";
        $validInput = false;
    }
    if (empty($addrState)) {
        $_SESSION['message11'] = "State is required. Please try again.";
        $validInput = false;
    }
    if (empty($addrZip)) {
        $_SESSION['message12'] = "Zip code is required. Please try again.";
        $validInput = false;
    } else if ((is_numeric($addrZip) == false) || (strlen($addrZip) != 5)) {
        $_SESSION['message12'] = "Invalid zip code. Please try again.";
        $validInput = false;
    }
    if ($validInput) {
        $statement = $db->prepare("UPDATE registeredusers SET Street='$addrStreet' WHERE Email='$user'");
        $statement->execute();
        $statement = $db->prepare("UPDATE registeredusers SET City='$addrCity' WHERE Email='$user'");
        $statement->execute();
        $statement = $db->prepare("UPDATE registeredusers SET State='$addrState' WHERE Email='$user'");
        $statement->execute();
        $statement = $db->prepare("UPDATE registeredusers SET Zip='$addrZip' WHERE Email='$user'");
        $statement->execute();
        $_SESSION['message13'] = "Mailing address is successfully updated";
    }

    //Logged in user
    if (isset($_SESSION['user'])) {
        $email = $_SESSION['user'];
        $thisFirstName = "SELECT FirstName FROM registeredusers WHERE Email = '$email'";
        $statement = $db->prepare($thisFirstName);
        $statement->execute();
        $printFirstName = $statement->fetch();

        $thisLastName = "SELECT LastName FROM registeredusers WHERE Email = '$email'";
        $statement2 = $db->prepare($thisLastName);
        $statement2->execute();
        $printLastName = $statement2->fetch();

        $_SESSION['profile'] = $printFirstName['FirstName'];
        $_SESSION['profile2'] = $printLastName['LastName'];
    } else {
        $_SESSION['profile'] = "Login";
    }
}

if (isset($_POST['subscribeStatus'])) {
    // if the user selected one of the radio buttons
    if (isset($_POST['subscribe'])) {
        $answer = $_POST['subscribe'];
        if ($answer == "sub") {
            $sql = "SELECT Subscribe FROM registeredusers WHERE Email = '$user'";
            $statement = $db->prepare($sql);
            $statement->execute();
            $currentStat = $statement->fetch();

            $_SESSION['currentStatus'] = $currentStat['Subscribe'];
            if ($_SESSION['currentStatus'] == 1) {
                $_SESSION['message14'] = "You are already subscribed.";
            } else {
                $email = $_SESSION['user'];
                $firstName = "SELECT FirstName FROM registeredusers WHERE Email='$user'";
                $statement = $db->prepare($firstName);
                $statement->execute();
                $fName = $statement->fetch();
                $lastName = "SELECT LastName FROM registeredusers WHERE Email='$user'";
                $statement = $db->prepare($lastName);
                $statement->execute();
                $lName = $statement->fetch();
                $sql = "UPDATE registeredusers SET Subscribe = 1 WHERE Email='$user'";
                $statement = $db->prepare($sql);
                $statement->execute();
                $_SESSION['message15'] = "You have successfully subscribed.";
                mail($email, 'Red-Wagon Subscription Confirmation', 'Thank you, ' . $fName['FirstName'] . ' ' . $lName['LastName'] . ', for subscribing to Red-Wagon Books newsletter!', 'From: red_wagonbooks@yahoo.com');
            }
        } else if ($answer == "unsub") {
            $sql = "SELECT Subscribe FROM registeredusers WHERE Email = '$user'";
            $statement = $db->prepare($sql);
            $statement->execute();
            $currentStat = $statement->fetch();

            $_SESSION['currentStatus'] = $currentStat['Subscribe'];
            if ($_SESSION['currentStatus'] == 0) {
                $_SESSION['message14'] = "You are already unsubscribed.";
            } else {
                $email = $_SESSION['user'];
                $sql = "UPDATE registeredusers SET Subscribe = 0 WHERE Email='$user'";
                $statement = $db->prepare($sql);
                $statement->execute();
                $_SESSION['message15'] = "You have successfully unsubscribed.";
                //mail($email, 'Red-Wagon Unsubscription Confirmation', 'You have unsubscribed to Red-Wagon Books newsletter.', 'From: red_wagonbooks@yahoo.com');
            }
        }
    } else {
        $_SESSION['message14'] = "You have not selected. Please try again.";
    }
}
/*
if (isset($_POST['deleteAccount'])) {

}*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- name of tab -->
    <title>Edit Profile</title>
    <link rel="stylesheet" href="edit_profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Header part of the page -->
    <nav class="navbar navbar-light justify-content-around" style="background-color: #EDA39D;padding-left:0">
        <a class="navbar-brand" id="brand" href="../MainPage/mainPage2.php">Red-Wagon Books</a>
        <form method="post" action="../searchBar/searchBar.php">
            <label>Search</label>
            <input type="text" name="search">
            <input type="submit" name="submit" class="btn btn-outline-dark btn-sm">
        </form>
        <div class="d-flex d-none d-md-flex flex-row align-items-center">
        <a href="../ShoppingCart/shoppingCart.php">
            <span class="shop-bag">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="black" class="bi bi-bag" viewBox="0 0 16 16">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                </svg>
            </span>
</a>
        </div>

        <div class="d-flex flex-row rounded-circle" width="30">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
            </svg>
            <small>
                <a href="../login/login.php" class="link-dark" style="color: black;text-decoration:none;font-weight:bold;font-size:14px">
                    <?php
                    if ($_SESSION['profile'] == "Login") {
                        echo " ";
                        echo $_SESSION['profile'];
                    }
                    ?>
                </a>

                <a href="../editProfile/edit_profile.php" class="link-dark" style="color:black;text-decoration:none;font-weight:bold;font-size:14px">
                    <?php
                    if (isset($_SESSION['profile2'])) {
                        echo $_SESSION['profile'];
                        echo " ";
                        echo $_SESSION['profile2'];
                    }
                    ?>
                </a>

                <a href="../mainPage/logout.php" style="color:black;padding-left:2em;text-decoration:none;font-weight:bold;font-size:14px">
                    <?php
                    if (isset($_SESSION['profile2'])) {
                        echo "      Logout";
                    }
                    ?>
                </a>

                </form>
            </small>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" style="color:rgba(0,0,0,.55)" href="../searchView/searchView.php">Books<span class="sr-only"></span></a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Genres
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="../GenrePages/fantasy.php">Fantasy</a>

                        <a class="dropdown-item" href="../GenrePages/romance.php">Romance</a>

                        <a class="dropdown-item" href="../GenrePages/nonfiction.php">Nonfiction</a>

                        <a class="dropdown-item" href="../GenrePages/horror.php">Horror</a>

                        <a class="dropdown-item" href="../GenrePages/historical.php">Historical Fiction</a>

                    </div>
                </li>

            </ul>
        </div>
    </nav>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right" id="profileTitle">Profile Settings</h4>
                    </div>
                    <span class="font-weight-bold">
                        <?php
                        echo "Name: ";
                        // select the FirstName column from the registeredusers table where the Email matches with the user session (email) that was set in login page
                        $firstName = "SELECT FirstName FROM registeredusers WHERE Email='$user'";
                        // query (SQL command)
                        $statement = $db->prepare($firstName);
                        // execute the SQL command
                        $statement->execute();
                        // since the result of this SQL command is one row, you use fetch(). fetchAll() is only used when the command results with multiple rows
                        $fname = $statement->fetch();
                        // print out the value under the column 'FirstName'
                        echo $fname['FirstName'];
                        echo " ";

                        $lastName = "SELECT LastName FROM registeredusers WHERE Email='$user'";
                        $statement = $db->prepare($lastName);
                        $statement->execute();
                        $lname = $statement->fetch();
                        echo $lname['LastName'];
                        ?>
                    </span>
                    <br>
                    <span class="font-weight-bold">
                        <?php
                        echo "Email: ";
                        $electronicMail = "SELECT Email FROM registeredusers WHERE Email='$user'";
                        $statement = $db->prepare($electronicMail);
                        $statement->execute();
                        $eMail = $statement->fetch();
                        echo $eMail['Email'];
                        ?>
                    </span>
                    <br>
                    <span class="font-weight-bold">
                        <?php
                        echo "Birthday: ";
                        $birthday = "SELECT Date FROM registeredusers WHERE Email='$user'";
                        $statement = $db->prepare($birthday);
                        $statement->execute();
                        $bday = $statement->fetch();
                        echo $bday['Date'];
                        ?>
                    </span>
                    <br>
                    <span class="font-weight-bold">
                        <?php
                        echo "Shipping Address: ";
                        ?>
                        <br>
                        <?php
                        $addressStreet = "SELECT Street FROM registeredusers WHERE Email='$user'";
                        $statement = $db->prepare($addressStreet);
                        $statement->execute();
                        $street = $statement->fetch();
                        echo $street['Street'];
                        ?>
                        <br>
                        <?php
                        $addressCity = "SELECT City FROM registeredusers WHERE Email='$user'";
                        $statement = $db->prepare($addressCity);
                        $statement->execute();
                        $city = $statement->fetch();
                        echo $city['City'];
                        echo ", ";

                        $addressState = "SELECT State FROM registeredusers WHERE Email='$user'";
                        $statement = $db->prepare($addressState);
                        $statement->execute();
                        $state = $statement->fetch();
                        echo $state['State'];
                        echo " ";

                        $addressZip = "SELECT Zip FROM registeredusers WHERE Email='$user'";
                        $statement = $db->prepare($addressZip);
                        $statement->execute();
                        $zip = $statement->fetch();
                        echo $zip['Zip'];
                        ?>
                    </span><br><br>
                    <p class="text-success">
                        <?php
                        if (isset($_SESSION['message2'])) {
                            echo $_SESSION['message2'];
                            unset($_SESSION['message2']);
                        }
                        if (isset($_SESSION['message4'])) {
                            echo $_SESSION['message4'];
                            unset($_SESSION['message4']);
                        }
                        if (isset($_SESSION['message6'])) {
                            echo $_SESSION['message6'];
                            unset($_SESSION['message6']);
                        }
                        if (isset($_SESSION['message8'])) {
                            echo $_SESSION['message8'];
                            unset($_SESSION['message8']);
                        }
                        if (isset($_SESSION['message13'])) {
                            echo $_SESSION['message13'];
                            unset($_SESSION['message13']);
                        }
                        if (isset($_SESSION['message15'])) {
                            echo $_SESSION['message15'];
                            unset($_SESSION['message15']);
                        }
                        ?>
                    </p>
                    <!-- Form part of the page -->
                    <form class="editProfile" method="post" name="form" action="edit_profile.php">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">First Name</label>
                                <input type="text" class="form-control" name="firstName" placeholder="first name" value="">
                                <p class="text-danger"><?php if (isset($_SESSION['message1'])) echo $_SESSION['message1']; ?></p>
                                <?php unset($_SESSION['message1']); ?>
                                <div class="mt-2 text-center">
                                    <input type="submit" class='btn btn-info'style='background-color:#f78b8b;border-color:#f78b8b;color:black' name="changeFName" id="fnameBtn" value="Update First Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Last Name</label>
                                <input type="text" class="form-control" name="lastName" value="" placeholder="last name">
                                <p class="text-danger"><?php if (isset($_SESSION['message3'])) echo $_SESSION['message3']; ?></p>
                                <?php unset($_SESSION['message3']); ?>
                                <div class="mt-2 text-center">
                                    <input type="submit" class='btn btn-info'style='background-color:#f78b8b;border-color:#f78b8b;color:black' name="changeLName" id="lnameBtn" value="Update Last Name">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Password</label>
                                <input type="password" class="form-control" name="passWord" placeholder="enter password" value="">
                                <label class="labels">Confirm New Password</label>
                                <input type="password" class="form-control" name="confirmPassword" placeholder="confirm password" value="">
                                <p class="text-danger"><?php if (isset($_SESSION['message5'])) echo $_SESSION['message5']; ?></p>
                                <?php unset($_SESSION['message5']); ?>
                                <div class="mt-2 text-center">
                                    <input type="submit" class='btn btn-info'style='background-color:#f78b8b;border-color:#f78b8b;color:black' name="changePass" id="passBtn" value="Update Password">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Birthday</label>
                                <input type="text" class="form-control" name="birthday" placeholder="YYYY-MM-DD" value="">
                                <p class="text-danger"><?php if (isset($_SESSION['message7'])) echo $_SESSION['message7']; ?></p>
                                <?php unset($_SESSION['message7']); ?>
                                <div class="mt-2 text-center">
                                    <input type="submit"  class='btn btn-info'style='background-color:#f78b8b;border-color:#f78b8b;color:black'name="changeBday" id="bdayBtn" value="Update Birthday">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <p id="typeAddress">Enter your new shipping address here:</p>
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Street</label>
                                <input type="text" class="form-control" name="streetAddr" placeholder="street" value="">
                                <p class="text-danger"><?php if (isset($_SESSION['message9'])) echo $_SESSION['message9']; ?></p>
                                <?php unset($_SESSION['message9']); ?>
                            </div>
                            <div class="col-md-12">
                                <label class="labels">City</label>
                                <input type="text" class="form-control" name="cityAddr" placeholder="city" value="">
                                <p class="text-danger"><?php if (isset($_SESSION['message10'])) echo $_SESSION['message10']; ?></p>
                                <?php unset($_SESSION['message10']); ?>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">State</label>
                                <input type="text" class="form-control" name="stateAddr" placeholder="state" value="">
                                <p class="text-danger"><?php if (isset($_SESSION['message11'])) echo $_SESSION['message11']; ?></p>
                                <?php unset($_SESSION['message11']); ?>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Zip Code (5 digits)</label>
                                <input type="text" class="form-control" name="zipAddr" placeholder="#####" value="" maxlength="5">
                                <p class="text-danger"><?php if (isset($_SESSION['message12'])) echo $_SESSION['message12']; ?></p>
                                <?php unset($_SESSION['message12']); ?>
                            </div>
                            <div class="col-md-12">
                                <div class="mt-2 text-center">
                                    <input type="submit" class='btn btn-info'style='background-color:#f78b8b;border-color:#f78b8b;color:black' name="changeAddress" id="addressBtn" value="Update Address">
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <label for="InputNewsletter">Would you like to sign up for our newsletter?</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="subscribe" id="inlineRadio1" value="sub">
                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="subscribe" id="inlineRadio2" value="unsub">
                            <label class="form-check-label" for="inlineRadio2">No</label>
                        </div>
                        <div class="col-md-12">
                            <div class="mt-2 text-center">
                                <p class="text-danger"><?php if (isset($_SESSION['message14'])) echo $_SESSION['message14']; ?></p>
                                <?php unset($_SESSION['message14']); ?>
                                <input type="submit" class='btn btn-info'style='background-color:#f78b8b;border-color:#f78b8b;color:black' name="subscribeStatus" id="subscription" value="Confirm">
                            </div>
                        </div><br>
                    </form>



                    <div class="mt-2 text-center">
                        <!--<button class="text-danger" onclick="document.getElementById('popup').style.display='block'">Delete Account</button>-->
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">Delete Account</button>
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                                <form class="modal-content" action="deleteAccount.php" method="POST">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Are you sure you want to delete your account?</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-danger btn-sm" name="deleteAccount" id="deleteBtn" value="Delete Account">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>