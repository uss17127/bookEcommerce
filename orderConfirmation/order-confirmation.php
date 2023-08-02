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
        <link rel="stylesheet" href="../MainPage/mainPageStyle2.css">
        <style>
          @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');


          .navbar brand {
            font-family: Playfair Display !important;
          }

          .card {
            border: none
          }

          .logo {
            background-color: #eeeeeea8
          }

          .totals tr td {
            font-size: 13px
          }

          .footer {
            background-color: #eeeeeea8
          }

          .footer span {
            font-size: 12px
          }

          .product-qty span {
            font-size: 12px;
            color: #dedbdb
          }
        </style>
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

          <?php
            $orderNumber = rand(1, 1000);

            $stmt = $db->prepare("SELECT orderNumber FROM orderdetails");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
              if ($orderNumber == $row['orderNumber']) {
                 $orderNumber++;
              }
            }

            if ($_SESSION['orderTotal'] == NULL) {
              $orderNumber = 0;
            }

            $confirmationNumber = rand(1, 1000);

            $stmt = $db->prepare("SELECT confirmationNumber FROM orderdetails");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
              if ($confirmationNumber == $row['confirmationNumber']) {
                  $confirmationNumber++;
              }
            }
            if ($_SESSION['orderTotal'] == NULL) {
              $confirmationNumber = 0;
            }
            if ($_SESSION['orderTotal'] != NULL) {
            $cardName = $_POST['username'];
            $cardNumber = $_POST['cardNumber'];
            $expirationM = $_POST['expirationMM'];
            $expirationY = $_POST['expirationYY'];
            $cvv = $_POST['cvv'];

            $bstreetname = $_POST['billingstreetName'];
            $bcityname = $_POST['billingcityName'];
            $bstatename = $_POST['billingstateName'];
            $bzipcode = $_POST['billingzipcode'];

            $sstreetname = $_POST['shippingstreetName'];
            $scityname = $_POST['shippingcityName'];
            $sstatename = $_POST['shippingstateName'];
            $szipcode = $_POST['shippingzipcode'];

            $billingAddress = $bstreetname." ".$bcityname." ".$bstatename." ".$bzipcode;
            $shippingAddress = $sstreetname." ".$scityname." ".$sstatename." ".$szipcode;

            $stmt = $db->prepare("UPDATE shoppingcart SET orderid='$orderNumber' WHERE email='$email'");
            $stmt->execute();

            $stmt = $db->prepare("INSERT INTO payment (cardOwner, cardNumber, expirationMonth, expirationYear, cvv, orderID, billingAddress) 
            VALUES ('$cardName', '$cardNumber', '$expirationM', '$expirationY','$cvv', '$orderNumber', '$billingAddress')");
            $stmt->execute();

            $stmt = $db->prepare("INSERT INTO orderdetails (ISBN, title, quantity, email, author, price, image, orderNumber) 
            SELECT ISBN, Title, Quantity, email, Author, Price, Image, orderid FROM shoppingcart WHERE email='$email'");
            $stmt->execute();

            $stmt = $db->prepare("UPDATE orderdetails SET orderType='1', confirmationNumber=$confirmationNumber
            WHERE email='$email' AND orderNumber='$orderNumber'");
            $stmt->execute();

            $stmt = $db->prepare("DELETE FROM shoppingcart WHERE email='$email'");
            $stmt->execute();

            $orderTotal = $_SESSION['orderTotal'];

            $stmt = $db->prepare("INSERT INTO ordertable (orderID, email, orderTotal, shippingAddress) VALUES ('$orderNumber', '$email', '$orderTotal', '$shippingAddress')");
            $stmt->execute();
            }

          ?>

          <div class="container mt-5 mb-5">

            <div class="card">

              <h3>Thank you <?php $stmt = $db->prepare("SELECT * FROM registeredusers WHERE email='$email'");
                            $stmt->execute();
                            $row = $stmt->fetch();
                            $first = $row['FirstName'];
                            $last = $row['LastName'];
                            echo $first;
                            echo " ";
                            echo $last;
                            echo "!";
                            ?></h3> <span class="font-weight-bold d-block mt-4"></span> <span>You order has been confirmed!</span>
              <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <td>
                        <div class="py-2"> <span class="d-block text-muted">Order Date</span> <span>
                            <script type="text/javascript">
                              var myDate = new Date();
                              var myDay = myDate.getDate();
                              var month = myDate.getMonth() + 1;
                              var year = myDate.getFullYear();
                              document.write(month + "/" + myDay + "/" + year);
                            </script>
                          </span> </div>
                      </td>
                      <td>
                        <div class="py-2"> <span class="d-block text-muted">Order Id</span>
                          <span>
                            <?php
                            echo $orderNumber;
                            ?>
                          </span>
                        </div>
                      </td>
                      <td>
                        <div class="py-2"> <span class="d-block text-muted">Confirmation Number</span> <span><?php echo $confirmationNumber; ?></span> </div>
                      </td>
                      <td>
                        <div class="py-2"> <span class="d-block text-muted">Shipping Address</span>
                          <span> <?php if ($_SESSION['orderTotal'] != NULL) {
                                  echo $sstreetname;
                                  echo "<br>";
                                  echo $scityname;
                                  echo " ";
                                  echo $sstatename;
                                  echo " ";
                                  echo $szipcode;
                          }
                                  ?></span>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="product border-bottom table-responsive">
                <table class="table table-borderless">
                  <tbody>
                    <tr>

                      <?php
                      $Quantity = "1";
                      $Subtotal = "0.00";
                      $Tax_fee = "0.00";
                      $Shipping = "4.99";
                      $Total = "0.00";

                      $stmt = $db->prepare("SELECT * FROM orderdetails WHERE orderNumber='$orderNumber' AND confirmationNumber=$confirmationNumber AND orderType='1' ORDER BY ISBN ASC");
                      $stmt->execute();

                      while ($row = $stmt->fetch()) {
                        $Title = $row['title'];
                        $Author = $row['author'];
                        $Quantity = $row['quantity'];
                        $Price = $row['price'] * $Quantity;
                        $Price = number_format($Price, 2);
                        $Subtotal += $Price;
                        $Subtotal = number_format($Subtotal, 2);
                        $Tax_fee = $Subtotal * 0.07;
                        $Tax_fee = round($Tax_fee, 2);
                        $Tax_fee = number_format($Tax_fee, 2);
                        $Total = $Subtotal + $Tax_fee + $Shipping;
                        $Total = number_format($Total, 2);
                        $ISBN = $row['ISBN'];
                        $img = $row['image'];
                        echo "<tbody>";
                        echo "<tr><td width=20%> <img src=../searchView/bookImages/$img width=90> </td>";
                        echo "<td width=60%> <span class=font-weight-bold>$Title</span>";
                        echo "<div class=product-qty> <span class=d-block>Quantity:$Quantity</span> <span> Author: $Author</span> <br>";
                        echo "<span>ISBN: $ISBN<br></span> </div> </td>";
                        echo "<td width=60%>";
                        echo "<div class=text-left> <span class=font-weight-bold>$Price</span></div>";
                        echo "</td></tr>";
                      }

                      ?>

                      <?php
                       if ($_SESSION['orderTotal'] != NULL) {  
                        $subject = "Red-Wagon Order Confirmation";
                        $headers = "From: red_wagonbooks@yahoo.com \r\n";
                        $headers .= "MIME-Version: 1.0\r\n";
                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                        $message = "<td><font face='Playfair Display' font size='3'>Hello ".$first."! Thank you for your order with us!<br>";
                        $message .= "Confirmation Number: #".$confirmationNumber."<br>";
                        $message .= "Order ID: #".$orderNumber."<br>";
                        $message .= "Order Date: ".date("Y/m/d")."<br>";
                        $message .= "Shipping Address: <br>".$sstreetname. "<br>" .$scityname." ".$sstatename." ".$szipcode."<br><br>";
                        $message .= "<u>Order Summary:</u><br>";
                        $stmt = $db->prepare("SELECT * FROM orderdetails WHERE orderNumber=$orderNumber AND confirmationNumber=$confirmationNumber AND orderType='1' ORDER BY ISBN ASC");
                        $stmt->execute();                       
                      while ($row = $stmt->fetch()) {
                        $Title = $row['title'];
                        $Author = $row['author'];
                        $Quantity = $row['quantity'];
                        $Price = $row['price'] * $Quantity;
                        $Price = number_format($Price, 2);
                        $ISBN = $row['ISBN'];
                        $message .= "<span>Title: ".$Title."</span><br>";
                        $message .= "<span>Quantity:".$Quantity."</span><br>";
                        $message .= "<span>Author: ".$Author."</span> <br>";
                        $message .= "<span>ISBN: ".$ISBN."<br></span>";
                        $message .= "<span>Price: $".$Price."</span><br>";
                        $message .= "-----------------------------------------";
                        $message .= "<br>";
                      }
                      $message .= "Order Total: $".$_SESSION['orderTotal'];
                      $message .= "</font></td></body></html>";
                      mail($email,$subject, $message, $headers);
                      }
                      ?>               



                      <?php
                      $stmt = $db->prepare("SELECT * FROM orderdetails WHERE email='$email' AND orderNumber='$orderNumber'");
                      $stmt->execute();

                      while ($row = $stmt->fetch()) {
                        $ISBN = $row['ISBN'];
                        $Quantity = $row['quantity'];
                        $statement = $db->prepare("SELECT Stock FROM book WHERE ISBN='$ISBN'");
                        $statement->execute();
                        $code = $statement->fetch();
                        $stock = $code['Stock'];
                        $totalStock = $stock - $Quantity;
                        $stmt2 = $db->prepare("UPDATE book SET Stock='$totalStock' WHERE ISBN='$ISBN'");
                        $stmt2->execute();
                      }
                      ?>

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
                          <div class="text-right"> <span>$<?php if ($Subtotal == 0) {
                            echo "0.00";
                          } else {
                              echo $Shipping;
                            }
                            ?></span> </div>
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
                          <div class="text-right"> <span class="text-success">-$<?php if ($_SESSION['orderDiscount'] == NULL) {
                            echo "0.00";
                          } else {
                            echo $_SESSION['orderDiscount'];
                          }?></span> </div>
                        </td>
                      </tr>
                      <tr class="border-top border-bottom">
                        <td>
                          <div class="text-left"> <span class="font-weight-bold">Total</span> </div>
                        </td>
                        <td>
                          <div class="text-right"> <span class="font-weight-bold">$<?php echo $_SESSION['orderTotal']; ?></span> </div>
                        </td>
                      </tr>
                      <?php $_SESSION['orderDiscount'] = 0; ?>
                      <?php $_SESSION['orderTotal'] = 0; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <p>We will be sending an order confirmation email soon!</p>
              <p class="font-weight-bold mb-0">Thanks for shopping with us!</p> <span>Red Wagon Books</span>
            </div>
          
        
          </div>
          </div>
          </div>
          </div>
          <script type="text/javascript"></script>
        </body>

      </html>