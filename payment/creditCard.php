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
        <a href="../login/login.php" class="link-dark" style="color: black;font-weight:bold;text-decoration:none;font-size:14px">
          <?php
          if ($_SESSION['profile'] == "Login") {
            echo " ";
            echo $_SESSION['profile'];
          }
          ?>
        </a>

        <a href="../editProfile/edit_profile.php" class="link-dark" style="color: black;text-decoration:none;font-weight:bold;font-size:14px">
          <?php
          if (isset($_SESSION['profile2'])) {
            echo $_SESSION['profile'];
            echo " ";
            echo $_SESSION['profile2'];
          }
          ?>
        </a>

        <a href="../mainPage/logout.php" style="color: black;padding-left:2em;text-decoration:none;font-weight:bold;font-size:14px">
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
                            <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active" style="background-color:#f78b8b;border-color:#f78b8b;color:black"> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li>
                            <li class="nav-item"> <a data-toggle="pill" href="cash.php" class="nav-link "> <span>&#36;</span> Pay in Store </a> </li>
                            
                        </ul>
                    </div> <!-- End -->
                    <!-- Credit card form content -->
                    <div class="tab-content">
                        <!-- credit card info-->
                        <div id="credit-card" class="tab-pane fade show active pt-3">
                        <form name="payment" action="../orderConfirmation/order-confirmation.php" method="POST">
                        <div class="form-group"> <label for="billingInfo">
                                        <h5>Billing Information</h5>
                                    </label>
                                     <h6>Address</h6>
                                         <input type="text" name="billingstreetName" placeholder="Enter Street Name" required class="form-control " > </div>                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group"> 
                                            <div class="input-group"> <input type="text" placeholder="City" name="billingcityName" class="form-control" required> 
                                            <input type="text" placeholder="State" name="billingstateName" class="form-control" required> 
                                             <input type="text" placeholder="Zip Code" name="billingzipcode" class="form-control" required> 
                                            </div>
                                        </div>
                                    </div>         
                                </div>           
                                
                                
                                <div class="form-group"> <label for="billingInfo">
                                        <h5>Shipping Information</h5>
                                    </label>
                                    <h6>Address</h6>
                                         <input type="text" name="shippingstreetName" placeholder="Enter Street Name" required class="form-control " > </div>                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group"> 
                                            <div class="input-group"> <input type="text" placeholder="City" name="shippingcityName" class="form-control" required> 
                                            <input type="text" placeholder="State" name="shippingstateName" class="form-control" required> 
                                             <input type="text" placeholder="Zip Code" name="shippingzipcode" class="form-control" required> 
                                            </div>
                                        </div>
                                    </div>         
                                </div>   

                                     <div class="form-group"> <label for="username">
                                        <h6>Card Owner</h6>
                                    </label>
                                         <input type="text" name="username" placeholder="Card Owner Name" required class="form-control "> </div>                                  
                                         <div class="form-group"> <label for="cardNumber">
                                        <h6>Card number</h6>
                                    </label>
                                    <div class="input-group"> <input type="text" maxlength="16" name="cardNumber" placeholder="Enter card number" class="form-control " required>
                                        <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group"> <label><span class="hidden-xs">
                                                    <h6>Expiration Date</h6>
                                                </span></label>
                                            <div class="input-group"> <input type="number" min="01" max="12" maxlength="2" placeholder="MM" name="expirationMM" class="form-control" required> 
                                            <input type="number" min="22" maxlength="2" placeholder="YY" name="expirationYY" class="form-control" required> </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                            </label> <input type="text" maxlength="3" name="cvv" required class="form-control"> </div>
                                    </div>
                                </div>
                                <div class="card-footer"> 
                                <input type="submit" class="subscribe btn btn-primary btn-block shadow-sm" value="Confirm Payment" name="submit" style="background-color:#f78b8b;border-color:#f78b8b;color:black"/>
                            </form>
                        
                        </div>
                    </div> <!-- End -->

  
                    <!-- End -->
                </div>
            </div>
        </div>
    </div>