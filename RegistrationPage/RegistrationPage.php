
<?php
$dsn='mysql:host=localhost; dbname=bookstore';
$username='root';
$password='';

try 
{
  $db = new PDO($dsn, $username, $password);
  //echo 'Connected successfully<br>';
}
catch (PDOException $e) 
{
  $error=$e->getMessage();
  echo '<p> Unable to connect to database: ' .$error;
  
  exit();
}
$info = "SELECT Email FROM registeredusers";
$statement = $db->query($info);
$emailss = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="RegistrationPageStyle.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script> 
    function printError(elemId, hintMsg) {
        document.getElementById(elemId).innerHTML = hintMsg;
    }

    function check(form) {
        if (form.InputEmail1.value != form.InputEmail2.value) {
            printError("emailErr", "Please make sure your emails match.");
            return false;
        } else {
            printError("emailErr", "");
        }

        var userEmails = <?php echo json_encode($emailss); ?>;
        if(userEmails.includes(form.InputEmail1.value) == true) {
            printError("emailErr", "An account with this email already exists.");
            return false;
        } else {
            printError("emailErr", "");
        }

        if (form.InputPassword1.value != form.InputPassword2.value) {
            //alert("Passwords do not match.");
            printError("passErr", "Please make sure your passwords match.");
            return false;
        } else {
            printError("passErr", "");
        }


        if (form.InputPassword1.value.length < 8) {
            printError("passErr", "Please make sure your password is at least 8 characters long.");
            return false;
        } else {
            printError("passErr", "");
        }


        if (form.InputZip1.value.length != 5) {
            printError("zipErr", "Zip Code must be 5 digits.");
            return false;
        } else {
            printError("zipErr", "");
        }

        if (form.InputBirthday1.value.length != 10 || form.InputBirthday1.value.charAt(2) != '/' ||
            form.InputBirthday1.value.charAt(5) != '/'
        ) {
            printError("birthErr", "Please format birthdate correctly.");
            return false;
        } else {
            printError("birthErr", "");
        }
        
        if(form.InputBirthday1.value.splice(6,9) > 2009) {
            printError("birthErr", "Must be of 13 years of age to register.");
            return false;
        }else {
            printError("birthErr", "");
        }

        return true;
    }
  </script>

  </head>

   
  <body> 

        <!--Search Bar and Logo-->
    <nav class="navbar navbar-light justify-content-around" style="background-color: #EDA39D;">
        <a class="navbar-brand" id="brand" href="../MainPage/mainPage2.php">Red-Wagon Books</a>
    </nav>
    

        <!-- User Registration Form -->  
        <div class="container px-2 py-2">
            <div class="container border border-dark rounded">    
            <form name="register" class="px-3 py-3" action ="RegistrationConfirmation.php" method="post" onsubmit = "return check(this)">
                <h2 id="formTitle">Create an Account</h2>
                <small id="accountHelp" class="form-text text-muted px-1 py-1">Fill in the forms below to create an account.<br>
                If you already have an account, please <a href="../login/login.php">Sign In.</a>
                </small>
                <div class="form-group">
                    <label for="FirstNameInput1">First Name</label>
                    <input type="name" class="form-control" id="InputName1" name="InputName1" placeholder="Enter First Name" required>
                </div>

                <div class="form-group">
                    <label for="LastNameInput1">Last Name</label>
                    <input type="name" class="form-control" id="InputLastName1" name="InputLastName1" placeholder="Enter Last Name" required>
                </div>

                <div class="form-group">
                    <label for="InputEmail1">Email Address</label>
                    <input type="email" class="form-control" id="InputEmail1" name="InputEmail1" placeholder="Enter Email" required>
                </div>

                <div class="form-group"> 
                    <input type="email" class="form-control" id="InputEmail2" name="InputEmail2" placeholder="Confirm Email" required>
                    <small class="error" id="emailErr"></small>
                </div>

                <div class="form-group">
                    <label for="InputPassword1">Password</label>
                    <input type="password" class="form-control" id="InputPassword1" name="InputPassword1" placeholder="Enter Password" required>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" id="InputPassword2"  name="InputPassword2" placeholder="Confirm Password" required>
                  <small class="error" id="passErr"></small>
                </div>

                <div class="form-group">
                <label for="InputPassword1">Birthdate</label>
                    <input type="Birthdate" class="form-control" id="InputBirthday1"  name="InputBirthday1" placeholder="mm/dd/yyyy" required>
                    <small class="error" id="birthErr"></small>
                </div>

                <div class="form-group">
                    <label for="InputAddress1">Address</label>
                    <div class="form-group">
                    <input type="Street" class="form-control" id="InputStreet1" name="InputStreet1" placeholder="Street" required>
                    </div>
                    <div class="form-group">
                    <input type="City" class="form-control" id="InputCity1" name="InputCity1" placeholder="City">
                    </div>
                    <div class="form-group">
                    <input type="State" class="form-control" id="InputState1" name="InputState1" placeholder="State" required>
                    </div>
                    <div class="form-group">
                    <input type="Zip" class="form-control" id="InputZip1" name="InputZip1" placeholder="ZipCode" required>
                    <small class="error" id="zipErr"></small>
                    </div>
                </div>

                <label for="InputNewsletter">Would you like to sign up for our newsletter?</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1" required>
                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="0">
                    <label class="form-check-label" for="inlineRadio2">No</label>
                </div>

                <button type="submit" value ="Submit" class="btn" style='background-color:#f78b8b;border-color:#f78b8b;color:black'>Create Account</button>
                
            </form>
        </div>
        </div>

    <!--Sticky Footer-->
    <footer id="footer" class="mt-auto flex-shrink-0 py-2 bg-dark text-white-50">
        <div class="container">
          <small>Copyright &copy; Red-Wagon Books</small>
        </div>
    </footer>

   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
     
  </body>
</html>