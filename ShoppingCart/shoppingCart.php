<?php
//Logged in User
include('../book_db.php');
session_start();
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="textCss.css">

</head>

<body>
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

    <nav class="navbar navbar-expand-lg navbar-light bg-light">

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



    <!--Product-->



    <?php
    if (isset($_POST['Title'])) {
      $Title = $_POST['Title'];
      $Author = $_POST['Author'];
      $Price = $_POST['Price'];
      $ISBN = $_POST['ISBN'];
      $Image = $_POST['Image'];
      $Quantity = "1";

      if (isset($_SESSION['user'])) {
        $stmt = $db->prepare("INSERT INTO shoppingcart (Title, Author, Price, ISBN, Image, Quantity, email) 
    VALUES ('$Title','$Author','$Price','$ISBN','$Image', '$Quantity', '$email')");
        $stmt->execute();
      } else {
        header('location: ../login/login.php');
      }
    }

    $Subtotal = "0.00";
    $Tax_fee = "0.00";
    $Shipping = "0.00";
    $discount = "0.00";
    $Total = "0.00";


    ?>


    <div class="container mt-5 mb-5">

      <div class="card">

        <div class="invoice p-2">
          <h2>Shopping Cart</h2>
          <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
            <table class="table table-borderless">

              <?php
              if (isset($_POST['increment'])) {
                $statement = $db->prepare("UPDATE shoppingcart SET Quantity=Quantity+1 WHERE ISBN=$ISBN AND email='$email'");
                $statement->execute();
              }
              ?>

              <?php
              if (isset($_POST['decrease'])) {
                $statement = $db->prepare("UPDATE shoppingcart SET Quantity=Quantity-1 WHERE ISBN=$ISBN AND email='$email'");
                $statement->execute();
                $statement = $db->prepare("DELETE FROM shoppingcart WHERE Quantity=0");
                $statement->execute();
              }
              ?>

              <?php
              if (isset($_SESSION['user'])) {
                $stmt = $db->prepare("SELECT * FROM shoppingcart WHERE email='$email'");
                $stmt->execute();

                while ($row = $stmt->fetch()) {
                  $Title = $row['Title'];
                  $Author = $row['Author'];
                  $Quantity = $row['Quantity'];
                  $Price = $row['Price'] * $Quantity;
                  $Price = number_format($Price, 2);
                  $Subtotal += $Price;
                  $Subtotal = number_format($Subtotal, 2);
                  $Tax_fee = $Subtotal * 0.07;
                  $Tax_fee = round($Tax_fee, 2);
                  $Tax_fee = number_format($Tax_fee, 2);
                  $Shipping = "4.99";
                  $Total = $Subtotal + $Tax_fee + $Shipping - $discount;
                  $Total = round($Total, 2);
                  $Total = number_format($Total, 2);
                  $_SESSION['orderTotal'] = $Total;
                  $_SESSION['orderDiscount'] = $discount;
                  $ISBN = $row['ISBN'];
                  $img = $row['Image'];


                  echo "<tr><td width=20%> <img src=../searchView/bookImages/$img width=90> </td>";
                  echo "<td width=60%> <span class=font-weight-bold>$Title</span>";
                  echo "<div class=product-qty> <span class=d-block>Quantity:$Quantity</span> <span> Author: $Author</span> <br>";
                  echo "<span>ISBN: $ISBN<br></span> </div> </td>";
                  echo "<td width=60%>";
                  echo "<div class=text-left> <span class=font-weight-bold>$Price</span>";
                  echo "<form name = 'decreaseQuantity' action='../ShoppingCart/shoppingCart.php' method='POST'>
  <input type='hidden' name='Image' value='$img' />
  <input type='hidden' name='Title' value='$Title' />
  <input type='hidden' name='Author' value='$Author' />
  <input type='hidden' name='Price' value='$Price'/>
  <input type='hidden' name='ISBN' value='$ISBN' />
  <input type='hidden' name='Quantity' value='$Quantity'/>
  <input type='submit' class='btn btn-info' style='background-color:#f78b8b;border-color:#f78b8b;color:black' name='decrease' value=->
  <input type='hidden' name='Image' value='$img' />
  <input type='hidden' name='Title' value='$Title' />
  <input type='hidden' name='Author' value='$Author' />
  <input type='hidden' name='Price' value='$Price'/>
  <input type='hidden' name='ISBN' value='$ISBN' />
  <input type='hidden' name='Quantity' value='$Quantity'/>
  <input type='submit'  class='btn btn-info'style='background-color:#f78b8b;border-color:#f78b8b;color:black' name='increment' value=+>";
                  echo "</form></div>";
                  echo "</td></tr>";
                }
              }
              ?>
              <?php
              if (isset($_POST['applyPromotion'])) {
                $promo = $_POST['promotion'];
                $statement = $db->prepare("SELECT PromotionCode FROM registeredusers WHERE Email='$email'");
                $statement->execute();
                $code = $statement->fetch();
                if ($code['PromotionCode'] == $promo) {
                  $discount = $Subtotal * 0.05;
                  $discount = round($discount, 2);
                  $discount = number_format($discount, 2);
                  $Total = $Subtotal + $Tax_fee + $Shipping - $discount;
                  $Total = round($Total, 2);
                  $Total = number_format($Total, 2);
                  $_SESSION['orderTotal'] = $Total;
                  $_SESSION['orderDiscount'] = $discount;
                } else {
                  echo "This code is incorrect or invalid. Try again";
                }
              }
              ?>

              <tbody>

                <tr>
                  <td width="20%">
                    <div class="text-left"> <span class="font-weight-bold">Apply Discount: </span> </div>
                    <div class="container mb-2"></div>
                    <form name="payment" action="../ShoppingCart/shoppingCart.php" method="POST">
                      <span class="d-block">
                        <input class="form-control" type="Promotion Code" name="promotion" placeholder="Promotion Code" aria-label="Promotion Code">
                        <input type="hidden" name="Image" value="<?php echo $Image; ?>" />
                        <input type="hidden" name="Title" value="<?php echo $Title; ?>" />
                        <input type="hidden" name="Author" value="<?php echo $Author; ?>" />
                        <input type="hidden" name="Price" value="<?php echo $Price; ?>" />
                        <input type="hidden" name="ISBN" value="<?php echo $ISBN; ?>" />
                        <div class="container mb-2"></div>
                        <input type="submit" class="btn btn-outline-success" class='btn btn-info'style='background-color:#f78b8b;border-color:#f78b8b;color:black' value="Apply" name="applyPromotion" />
                    </form>
                    </span>
                    <div class="container mb-2"></div>

                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="row d-flex justify-content-end">
            <div class="col-md-5">
              <table class="table table-borderless">
                <tbody class="totals">
                  <tr>
                    <td>
                      <div class="text-left">
                        <h5>Order Summary</h5>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="text-left"> <span class="text-muted">Subtotal</span> </div>
                    </td>
                    <td>
                      <div class="text-right"> <span>$<?php echo $Subtotal; ?></span> </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="text-left"> <span class="text-muted">Shipping Fee</span> </div>
                    </td>
                    <td>
                      <div class="text-right"> <span>$<?php echo $Shipping; ?></span> </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="text-left"> <span class="text-muted">Tax Fee</span> </div>
                    </td>
                    <td>
                      <div class="text-right"> <span>$<?php echo $Tax_fee; ?></span> </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="text-left"> <span class="text-muted">Discount</span> </div>
                    </td>
                    <td>
                      <div class="text-right"> <span class="text-success">-$<?php echo $discount; ?></span> </div>
                    </td>
                  </tr>
                  <tr class="border-top border-bottom">
                    <td>
                      <div class="text-left"> <span class="font-weight-bold">Total</span> </div>
                    </td>
                    <td>
                      <div class="text-right"> <span class="font-weight-bold">$<?php echo $Total; ?></span> </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <a class="btn btn-outline-success"  class='btn btn-info'style='background-color:#f78b8b;border-color:#f78b8b;color:black' href="../payment/creditCard.php" role="button">Checkout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <script type="text/javascript"></script>
  </body>

</html>
<div class="fixed-bottom">

  <footer id="footer" class="flex-shrink-0 py-2 bg-dark text-white-50">

    <div class="container">

      <small>Copyright &copy; Red-Wagon Books</small>

    </div>

  </footer>