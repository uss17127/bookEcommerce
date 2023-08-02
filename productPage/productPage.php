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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="productPage.css">

</head>
<body>

    <nav class="navbar navbar-light justify-content-around" style="background-color: #EDA39D;"> 

        <a class="navbar-brand" id="brand" href="../MainPage/mainPage2.php">Red-Wagon Books</a>     

        <form method = "post" action="../searchBar/searchBar.php">
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
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
          </svg>
          <small>
            <a href="../login/login.php" class="link-dark" style="color: black;font-weight:bold">
              <?php
              if ($_SESSION['profile'] == "Login") {
                echo " ";
                echo $_SESSION['profile'];
              }
              ?>
            </a>

            <a href="../editProfile/edit_profile.php" class="link-dark" style="color: black;text-decoration:none;font-weight:bold">
              <?php
              if (isset($_SESSION['profile2'])) {
                echo $_SESSION['profile'];
                echo " ";
                echo $_SESSION['profile2'];
              }
              ?>
            </a>

            <a href="../mainPage/logout.php" style="color: black;padding-left:2em;text-decoration:none;font-weight:bold">
            <?php
              if (isset($_SESSION['profile2'])) {
                echo "  Logout";
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

            <a class="nav-link" style="padding-left:1em" href="../searchView/searchView.php">Books (current)<span class="sr-only"></span></a>

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
        $Image = $_GET['Image'];
        $Title = $_GET['Title'];
        $Author = $_GET['Author'];
        $Price = $_GET['Price'];
        $ISBN = $_GET['ISBN'];
        $Des = $_GET['Description'];
    ?>
    
        

    <div class="product row justify-content-between align-items-center p-5 m-5">
        <div class ="bookImage col p-5"> 
        <img src="../searchView/bookImages/<?php echo $Image ?>">

        </div>
        <div class="bookInfo col p-5 justify-content-center">
            <h2 class="bookTitle row  justify-content-left align-items-center">
                <?php echo "$Title<br>"; ?>
            </h2>

            <h5 class="authorName row text-muted">
            <?php echo "Author: $Author<br>"; ?>
            </h5>
            <h5 class=" ISBN row text-muted small">
            <?php echo "ISBN: $ISBN<br>"; ?>
            </h5>

            <br>
            <hr>
            <br>
            
            <h3 class="bookPrice">
                <small>$</small><?php echo "$Price<br>"; ?>
            </h3>

            <br>
            
            <div class="row buttons justify-content-center align-items-center">
                <div class="col">
           
    <form name="search" action="../ShoppingCart/shoppingCart.php" method="POST">
        <input type="hidden" name="Image" value="<?php echo $Image;?>" />
        <input type="hidden" name="Title" value="<?php echo $Title;?>" />
        <input type="hidden" name="Author" value="<?php echo $Author; ?>" />
        <input type="hidden" name="Price" value="<?php echo $Price;?>" />
        <input type="hidden" name="ISBN" value="<?php echo $ISBN; ?>" />
        <input type="submit" class="btn btn-primary" value="Add To Cart" name="addToCart" style="background-color:#f78b8b;border-color:#f78b8b;color:black" />
    </form>
                   
                </div>
            </div>
            
        </div> 

        <br>
        <h3 id="overview">Overview</h3>
        <div class="summary border p-5">
            <p>
            <?php echo "$Des<br>"; ?>
            </p>

        </div>


            

    </div>
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> 

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<div class="fixed-bottom">  

<footer id="footer" class="flex-shrink-0 py-2 bg-dark text-white-50"> 

    <div class="container"> 

        <small>Copyright &copy; Red-Wagon Books</small> 

    </div> 

</footer> 
</html>