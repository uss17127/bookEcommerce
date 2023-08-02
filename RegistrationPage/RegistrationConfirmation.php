<?php
session_start();
$dsn = 'mysql:host=localhost; dbname=bookstore';
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password);
    //echo 'Connected successfully<br>';
} catch (PDOException $e) {
    $error = $e->getMessage();
    echo '<p> Unable to connect to database: ' . $error;
    exit();
}

$firstName = filter_input(INPUT_POST, 'InputName1');
$lastName = filter_input(INPUT_POST, 'InputLastName1');
$email = filter_input(INPUT_POST, 'InputEmail1');
$password = filter_input(INPUT_POST, 'InputPassword1');
$street = filter_input(INPUT_POST, 'InputStreet1');
$city = filter_input(INPUT_POST, 'InputCity1');
$state = filter_input(INPUT_POST, 'InputState1');
$zip = filter_input(INPUT_POST, 'InputZip1', FILTER_VALIDATE_INT);
$date = date('Y-m-d', strtotime($_POST['InputBirthday1']));
$conId = rand(1000, 9000);
//$promotionId = rand(10000,90000);
$promotionId = 10005;
$newsLetter = $_POST['inlineRadioOptions'];


$_SESSION['InputEmail1'] = $email;
$_SESSION['InputPromo'] = $promotionId;
$_SESSION['inlineRadioOptions'] = $newsLetter;
$_SESSION['InputName1'] =  $firstName;

$info = "INSERT INTO registeredusers
				(FirstName, LastName, Email, Password, Street, City, State, Zip, Date, ConfirmID, PromotionCode, Subscribe)
					VALUES
				('$firstName', '$lastName', '$email', '$password', '$street', '$city', '$state', '$zip', '$date', '$conId', '$promotionId', '$newsLetter')";

$statement = $db->prepare($info);
$statement->execute();


mail($email, 'Red-Wagon Confirmation', 'Thank you, ' . $firstName . ', for registering at Red-Wagon Books! Here is your confirmation number: ' . $conId, 'From: red_wagonbooks@yahoo.com');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="RegistrationConfirmationStyle.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script>
        function printError(elemId, hintMsg) {
            document.getElementById(elemId).innerHTML = hintMsg;
        }

        function check(form) {
            var ID = '<?= $conId ?>';
            if (form.InputConfirmID1.value != ID) {
                printError("confirmErr", " This does not match your confirmation code. Please type the correct confirmation code.");
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
            <form name="confirm" class="px-3 py-3" method="post" action="ThankYou.php" onsubmit="return check(this)">
                <div>
                    <h4>One Last Step</h4>
                </div>

                <div class="px-2 py-2">
                    <small>Please check your email for your confirmation ID.</small>
                </div>

                <div class="px-2 py-2">
                    <small>Enter the confirmation ID below.</small>
                </div>

                <div class="form-group">
                    <input type="name" class="form-control" id="InputConfirmID1" name="InputConfirmID1" placeholder="Enter Confirmation ID" required>
                </div>

                <small class="error" id="confirmErr"></small>

                <div class="px-2 py-2">
                    <button type="submit" value="Submit" class="px-1 py-1 btn btn-dark">Confirm</button>
                </div>
            </form>

        </div>
    </div>

    <!--Sticky Footer-->
    <div class="fixed-bottom">
        <footer id="footer" class="flex-shrink-0 py-2 bg-dark text-white-50">
            <div class="container">
                <small>Copyright &copy; Red-Wagon Books</small>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>