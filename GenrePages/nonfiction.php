<?php
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
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="genre.css">
  <title>Nonfiction</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

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

        <a href="../editProfile/edit_profile.php" class="link-dark" style="color: black;font-weight:bold;text-decoration:none">
          <?php
          if (isset($_SESSION['profile2'])) {
            echo $_SESSION['profile'];
            echo " ";
            echo $_SESSION['profile2'];
          }
          ?>
        </a>

        <a href="../mainPage/logout.php" style="color: black;padding-left:2em;font-weight:bold;text-decoration:none">
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

          <a class="nav-link" href="../searchView/searchView.php">Books<span class="sr-only"></span></a>

        </li>

        <li class="nav-item dropdown">

          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Nonfiction <span class="sr-only">(current)</span>

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

  <!--Book Display-->
  <div class="bookDisplay p-5 ">
    <style>
      .bookDisplay {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
      }
    </style>

    <?php

    $stmt = $db->prepare("SELECT * FROM book WHERE GenreID = 3");
    $stmt->execute();

    while ($row = $stmt->fetch()) {
      $title = $row['Title'];
      $author = $row['Author'];
      $price = $row['Price'];
      $isbn = $row['ISBN'];
      $des = $row['Description'];
      //$image = $row['Image'];
      //$imagee = "<img src = '6Glasses.jpg'>";
      //$image=" SELECT * FROM book";

      echo "<div style= 'margin: 2%; text-align: center; width: 160px; height: 330px'>";
      echo "<img src=../searchView/bookImages/$row[Image]><br>";
      echo "<b>$title</b><br>";
      echo "$author<br>";
      echo "$$price<br>";
      echo "ISBN: $isbn";
    ?>


      <form name="search" action="../productPage/productPage.php" method="GET">
        <input type="hidden" name="Image" value="<?php echo $row['Image']; ?>" />
        <input type="hidden" name="Title" value="<?php echo $row['Title']; ?>" />
        <input type="hidden" name="Author" value="<?php echo $row['Author']; ?>" />
        <input type="hidden" name="Price" value="<?php echo $row['Price']; ?>" />
        <input type="hidden" name="ISBN" value="<?php echo $row['ISBN']; ?>" />
        <input type="hidden" name="Description" value="<?php echo $row['Description']; ?>" />
        <input type="submit" class="btn btn-outline-dark btn-sm" value="View Book" name="submit" />
      </form>

      <!--
    <form>
      <input type="button"  value="View Book" onclick="window.location.href='../productPage/productPage.php';"/>
    </form>
  -->


    <?php
      echo "</div>";
      //echo "<table class='table my_table'>
      //<tr class='info'> <th> Image </th><th>Name</th><th>ID</th><th>Price</th></tr>";

      //foreach ($db->query($q) as $row) {
      //echo "<img src=bookImages/$row[Image]
      //</tr>";
      //}
      //echo "</table>";
    }

    ?>
  </div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
<div class="fixed-bottom">

  <footer id="footer" class="flex-shrink-0 py-2 bg-dark text-white-50">

    <div class="container">

      <small>Copyright &copy; Red-Wagon Books</small>

    </div>

  </footer>

</div>

</html>