<?php
//Logged in User
session_start();
require('database.php');
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
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="mainPageStyle2.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>


  <!--Search Bar and Logo-->
  <nav class="navbar navbar-light justify-content-around" style="background-color: #EDA39D;padding-left:0">
    <a class="navbar-brand" id="brand" href="../MainPage/mainPage2.php">Red-Wagon Books</a>

    <form method="post" action="../searchBar/searchBar.php">
      <label>Search</label>
      <input type="text" name="search">
      <input type="submit" class="btn btn-outline-dark btn-sm" name="submit">
    </form>

    <div class="d-flex d-none d-md-flex flex-row align-items-center"> <a href="../ShoppingCart/shoppingCart.php"><span class="shop-bag"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="black" class="bi bi-bag" viewBox="0 0 16 16">
            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
          </svg></span>
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

        <a href="../editProfile/edit_profile.php" class="link-dark" style="color: black;text-decoration:none;font-weight:bold;font-size:14px">
          <?php
          if (isset($_SESSION['profile2'])) {
            echo $_SESSION['profile'];
            echo " ";
            echo $_SESSION['profile2'];
          }
          ?>
        </a>

        <a href="logout.php" style="color: black;padding-left:2em;text-decoration:none;font-weight:bold;font-size:14px">
          <?php
          if (isset($_SESSION['profile2'])) {
            echo "    Logout";
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

  <!--Carousel-->
  <div class="d-flex justify-content-around">
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="Image-1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="Image-2.webp" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="classicBooks.jpg" class="d-block w-100" alt="...">
        </div>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  <hr>

  <h3 class="container d-flex justify-content-around">Find Books to Cozy Up to</h3>

  <div id="extra" class="container d-flex justify-content-around">
    <div class="row px-1 py-1">
      <div class="col">
        <img class="img-fluid" src="BooksTea.jpg">
      </div>
      <div class="col">
        <img class="img-fluid" src="BookTravel.jpg">
      </div>
      <div class="col">
        <img class="img-fluid" src="AestheticBook.webp">
      </div>
    </div>
  </div>
  <div id="extra" class="container d-flex justify-content-around">
    <div class="row px-1 py-1">
      <div class="col">
        <img class="img-fluid" src="BookCluster.jpg">
      </div>
      <div class="col">
        <img class="img-fluid" src="BooksBed.jpg">
      </div>
      <div class="col">
        <img class="img-fluid" src="BookFlower.jpg">
      </div>
    </div>
  </div>

  <!--Sticky Footer-->
  <footer id="footer" class="mt-auto flex-shrink-0 py-2 bg-dark text-white-50">
    <div class="container">
      <small>Copyright &copy; Red-Wagon Books</small>
    </div>
  </footer>

  <script>
    $(document).ready(function() {
      $('#myCarousel').carousel({
        interval: 3000
      });
      $(".carousel-control-prev").click(function() {
        $("#myCarousel").carousel("prev");
      });
      $(".carousel-control-next").click(function() {
        $("#myCarousel").carousel("next");
      });
    });
  </script>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>