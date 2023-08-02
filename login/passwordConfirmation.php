<?php
session_start();
$userEmail = $_SESSION['thisEmail'];
$randomId = rand(1000, 9000);

mail($userEmail, 'Red-Wagon Books Password Assistance', 'To authenticate, please use the following confirmation number: ' . $randomId . '. DO NOT SHARE THIS NUMBER WITH ANYONE!', 'From: red_wagonbooks@yahoo.com');

// if the user clicks the Confirm button

/*if (isset($_POST['codeconfirm'])) {
    $confirmID = $_POST['InputConfirmID1'];
    if ($confirmID == "") {
        $_SESSION['errorMsg2'] = "Please enter the confirmation number.";
    } else if ($confirmID == strval($randomId)) {
        header('location: newPassword.php');
    } else {
        $_SESSION['errorMsg2'] = "The confirmation number does not match. Please try again.";
    }
}*/

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="passwordConfirmation.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script>
        function printError(elemId, hintMsg) {
            document.getElementById(elemId).innerHTML = hintMsg;
        }

        function check(form) {
            var ID = '<?= $randomId ?>';
            if (form.InputConfirmID1.value == "") {
                printError("confirmErr", "Please enter a confirmation number.");
                return false;
            } else if (form.InputConfirmID1.value != ID) {
                printError("confirmErr", "The confirmation number does not match. Please try again.");
                return false;
            } else {
                printError("confirmErr", " ");
            }
            return true;
        }
    </script>
</head>

<body>

    <!--Search Bar and Logo-->
    <nav class="navbar navbar-light justify-content-around" style="background-color: #EDA39D;">
        <a class="navbar-brand" id="brand">Red-Wagon Books</a>
    </nav>

    <!--Message-->
    <div class="px-4 py-4">
        <div class="container border border-dark rounded justify-content-around px-2 py-2">
            <form name="verify" class="px-3 py-3" method="post" action="newPassword.php" onsubmit="return check(this)">
                <div>
                    <h2 id="formTitle">Verification required</h2>
                </div>

                <div class="px-2 py-2">
                    <small>Please check your email for your confirmation ID.</small>
                </div>

                <div class="px-2 py-2">
                    <small>Enter the confirmation ID below.</small>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="InputConfirmID1" name="InputConfirmID1" placeholder="Enter Confirmation ID">
                </div>
                <p class="text-danger" id="confirmErr"></p>
                <div class="px-2 py-2">
                    <button type="submit" value="Submit" class="px-1 py-1 btn btn-dark">Confirm</button>
                </div>
            </form>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>