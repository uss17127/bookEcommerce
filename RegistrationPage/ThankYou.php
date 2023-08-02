<?php 
session_start();
$email = $_SESSION['InputEmail1'];
$promotionId = $_SESSION['InputPromo'];
$newsLetter = $_SESSION['inlineRadioOptions'];
$firstName = $_SESSION['InputName1'];


    mail($email,'Red-Wagon Promotion', 'As a registered member you have your own promotion code. This code takes takes 5% off each order. 
    Please keep this code saved. Promotion Code: '.$promotionId, 'From: red_wagonbooks@yahoo.com');

    if ($newsLetter == "1") {
        mail($email, 'Red-Wagon Newsletter', 'Thank you, '.$firstName.', for subscribing to Red-Wagon Books Newsletter! We send out monthly book recommendations and updates here.
        We hope you enjoy! <3', 'From: red_wagonbooks@yahoo.com');
    }
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
  </head>
  <body>

    <!--Search Bar and Logo-->
    <nav class="navbar navbar-light justify-content-around" style="background-color: #EDA39D;">
            <a class="navbar-brand" id="brand">Red-Wagon Books</a>
        </nav>

        <div class="px-4 py-4"> 
        <div class="container border border-dark rounded justify-content-around px-2 py-2">
            <form name = "confirm" class="px-3 py-3">
            <div>
                <h4>Thank You for Registering</h4>
            </div>
             
            <div class="px-2 py-2">
                <small>A promotion code will be sent to your email.</small>
            </div>

            <div class="px-2 py-2">
                <a href = "../MainPage/mainPage2.php">
                <button type="button" class="px-1 py-1 btn btn-dark"  style="background-color:#f78b8b;border-color:#f78b8b;color:black" onclick = "check(confirm)">Confirm</button>
                </a>
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