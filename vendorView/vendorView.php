<?php
    session_start();
	include('../book_db.php');

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--CSS-->
    <link rel="stylesheet" href="vendorView.css">
    <title>Vendor View</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- font link-->
    <script src="https://kit.fontawesome.com/a182a4d44e.js" crossorigin="anonymous"></script>

        <!--header bar-->
        <nav class="navbar navbar-light justify-content-around" style="background-color: #EDA39D;">
        <a class="navbar-brand" id="brand"  href="../MainPage/mainPage2.php">Red-Wagon Books</a>
    </nav>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <title>Title</title>

</head>


<body>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

    <div class="wrapper">

    

        <!-- side navigation-->
        <div class="sidenav">
            <h2 class="border-bottom">Vendor</h2>
           

            <ul>
            <li><a href="#section1" class="text-decoration-none"><i class="fa-solid fa-book "></i>Books</a></li>
                <li><a href="../mainPage/logout.php" class="text-decoration-none text-danger"> <i class="fas fa-power-off me-2 text-danger"></i>Logout</a></li>
            </ul>

        </div>

       
       
        <div class="main-content">
        
        <section class="p-2" id="section1">

        <div class="d-flex justify-content-between">
            
        <div class="container">
        <div class="row">
            
                <?php
                    if(isset($_SESSION['message'])) :
                ?>
                <h5 class="alert alert-success"><?= $_SESSION['message']; ?> </h5>
                <?php 
                    unset($_SESSION['message']);
                endif; ?>

            <div class="card">
                <div class="card-header">
                    <h4>Books
                    <a href="add.php" class="btn btn-outline-success float-end">ADD</a>
                    </h3>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Price</th>
                            <th>ISBN</th>
                            <th>Stock</th>
                            <th>Vendor</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM book WHERE Vendor = 'Rabbit' ORDER BY Title ASC";
                            $statement = $db->prepare($query);
                            $statement->execute();
                            
                            $statement->setFetchMode(PDO::FETCH_ASSOC);
                            $result = $statement->fetchAll();
                            if($result){
                                foreach($result as $row){
                                    ?>
                                    <tr>
                                        <td><?= $row['Title']; ?></td>
                                        <td><?= $row['Author']; ?></td>
                                        <td>$<?= $row['Price']; ?></td>
                                        <td><?= $row['ISBN']; ?></td>
                                        <td><?= $row['Stock']; ?></td>
                                        <td><?= $row['Vendor']; ?></td>
                                        <td>
                                            <a href="edit.php?id=<?= $row['id']?>" class="btn btn-outline-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="code.php" method="POST">
                                                <button type="submit" name="delete_btn" value="<?=$row['id']?>" class="btn btn-outline-danger">Delete</button>
                                            </form>
                                            </td>
                                    <tr>
                                    <?php
                                }
                            }
                            else{
                                ?>
                                <tr>
                                    <td colspan=""> No record found </td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            
        </div>
    </div>
</div>
    </section>
            
    </div>           
    
</div>

</body>




</html>



