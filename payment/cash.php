<?php
  //Logged in User
	include('../book_db.php');
  session_start();
  if (isset($_SESSION['user'])) {
    $email = $_SESSION['user'];
    $thisFirstName = "SELECT FirstName FROM registeredusers WHERE Email = '$email'";
    $statement = $db -> prepare($thisFirstName);
    $statement -> execute();
    $printFirstName = $statement -> fetch();

    $thisLastName = "SELECT LastName FROM registeredusers WHERE Email = '$email'";
    $statement2 = $db -> prepare($thisLastName);
    $statement2 -> execute();
    $printLastName = $statement2 -> fetch();

    $_SESSION['profile'] = $printFirstName['FirstName'];
    $_SESSION['profile2'] = $printLastName['LastName'];

  } else {
    $_SESSION['profile'] = "Login";
  }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src ="bootstrap.bundle.js"></script>
    <script src="paymentJS.js"></script>
    <link rel="stylesheet" href="../MainPage/mainPageStyle2.css">
    <link rel="stylesheet" href="paymentCSS.css">
    
</head>

<!--Search Bar and Logo--> 

<body>

<nav class="navbar navbar-light justify-content-around" style="background-color: #EDA39D;">

    <a class="navbar-brand" id="brand" href="../MainPage/mainPage2.php">Red-Wagon Books</a>

    <form method="post" action="../searchBar/searchBar.php">
      <label>Search</label>
      <input type="text" name="search">
      <input type="submit" class="btn btn-outline-dark btn-sm" name="submit">
    </form>

    <div class="d-flex d-none d-md-flex flex-row align-items-center float-right"> <a href="../ShoppingCart/shoppingCart.php"><span class="shop-bag"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="black" class="bi bi-bag" viewBox="0 0 16 16">

            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />

          </svg></span>


      </a>

    </div>

    <div class="d-flex flex-row rounded-circle" width="30">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
      </svg>
      <small>
        <a href="../login/login.php" class="link-dark" style="color: black;font-weight:bold;text-decoration:none">
          <?php
          if ($_SESSION['profile'] == "Login") {
            echo " ";
            echo $_SESSION['profile'];
          }
          ?>
        </a>

        <a href="../editProfile/edit_profile.php" class="link-dark" style="color: black;text-decoration:none;font-weight:bold;;font-size:14px">
          <?php
          if (isset($_SESSION['profile2'])) {
            echo $_SESSION['profile'];
            echo " ";
            echo $_SESSION['profile2'];
          }
          ?>
        </a>

        <a href="../mainPage/logout.php" style="color: black;padding-left:2em;text-decoration:none;font-weight:bold;;font-size:14px">
          <?php
          if (isset($_SESSION['profile2'])) {
            echo "Logout";
          }
          ?>
        </a>

        </form>
      </small>
    </div>

  </nav>


<!--Navigation Menu--> 

<nav class = "navbar navbar-expand-lg navbar-light bg-light"> 

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> 

        <span class="navbar-toggler-icon"></span> 

     </button> 

    <div class="collapse navbar-collapse" id="navbarNav">  

     <ul class="navbar-nav"> 

        <li class="nav-item active"> 

        <a class="nav-link" href="../searchView/searchView.php" style="color:rgba(0,0,0,.55)">Books<span class="sr-only"></span></a>

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


<div class="container py-5">
    <!-- For demo purpose -->
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-6">Payment Forms</h1>
        </div>
    </div> <!-- End -->
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card ">
                <div class="card-header">
                    <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                        <!-- Credit card form tabs -->
                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                            <li class="nav-item"> <a data-toggle="pill" href="creditCard.php" class="nav-link"> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li>
                            <li class="nav-item"> <a data-toggle="pill" href="cash.php" class="nav-link active" style="background-color:#f78b8b;border-color:#f78b8b;color:black"> <span>&#36;</span> Pay in Store </a> </li>
                        </ul>
                    </div> <!-- End -->
                             <h6 class="pb-2">You will have 5 days to pick up your book and pay in store</h6>
                             <div class="form-group "> <label class="radio-inline"> Reserved until: </label>
                            <script type="text/javascript">
                                 var myDate = new Date();
                                 var myDay = myDate.getDate() + 5;
                                 var month = myDate.getMonth() + 1;
                                 var year = myDate.getFullYear();
                                 document.write( month + "/" + myDay + "/" + year);
                            </script>
                            </div>
                              <p class="text-muted"> Note: After 5 days your reservation will expire and you will not be able to pick up the book. </p>
                              <div class="card-footer"> <a class="subscribe btn btn-primary btn-block shadow-sm" href="../orderConfirmation/reservation-confirmation.php" role="button" style="background-color:#f78b8b;border-color:#f78b8b;color:black" >Confirm Reservation</a>
                           </div> <!-- End -->
                    </div>