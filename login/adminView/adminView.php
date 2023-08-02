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
    <link rel="stylesheet" href="adminView.css">
    <title>Admin View</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- font link-->
    <script src="https://kit.fontawesome.com/a182a4d44e.js" crossorigin="anonymous"></script>

        <!--header bar-->
        <nav class="navbar navbar-light justify-content-around" style="background-color: #EDA39D;">
        <a class="navbar-brand" id="brand">Red-Wagon Books</a>
    </nav>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <title>Admin View</title>

</head>


<body>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://kit.fontawesome.com/26c3dac442.js" crossorigin="anonymous"></script>

    <div class="wrapper">

    

        <!-- side navigation-->
        <div class="sidenav">
            <h2 class="border-bottom">ADMIN</h2>

            <ul>
                <li><a href="#section1" class="text-decoration-none"><i class="fa-solid fa-book"></i>Books</a></li>
                <li><a href="#section2" class="text-decoration-none"><i class="fa-solid fa-user"></i>Users</a></li>
                <li><a href="#section3" class="text-decoration-none"><i class="fa-solid fa-file"></i>Reports</a></li>
                <li><a href="#section4" class="text-decoration-none"><i class="fa-solid fa-box-archive"></i>Low Inventory Notice</a></li>
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
                    </h4>
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
                            $query = "SELECT * FROM book ORDER BY Title ASC";
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

    <section class="p-2" id="section2">
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
                    <h4>Users
                    </h4>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Confirmation ID</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM registeredusers ORDER BY FirstName ASC";
                            $statement = $db->prepare($query);
                            $statement->execute();
                            
                            $statement->setFetchMode(PDO::FETCH_ASSOC);
                            $result = $statement->fetchAll();
                            if($result){
                                foreach($result as $row){
                                    ?>
                                    <tr>
                                        <td><?= $row['FirstName']; ?></td>
                                        <td><?= $row['LastName']; ?></td>
                                        <td><?= $row['Email']; ?></td>
                                        <?php
                                            if($row['UserType']==1){
                                                $value='Customer';
                                            }
                                            else if($row['UserType']==2){
                                                $value='Vendor';
                                            }
                                            else{
                                                $value='Admin';
                                            }
                                        ?>
                                        <td><?= $value?></td>
                                        <td><?= $row['ConfirmID']; ?></td>
                                        <td>
                                            <a href="edit2.php?ConfirmID=<?= $row['ConfirmID']?>" class="btn btn-outline-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="code2.php" method="POST">
                                                <button type="submit" name="delete_btn" value="<?=$row['ConfirmID']?>" class="btn btn-outline-danger">Delete</button>
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
    <section class="p-2" id="section3">
    <div class="d-flex justify-content-between">
    <div class="container">
    <h4>Reports
    </h4>


<?php
    $query = "SELECT SUM(orderTotal) AS total_sum FROM ordertable";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $sum = $row['total_sum'];

    $query_two = "SELECT count(FirstName) AS count from registeredusers";
    $stmt_2 = $db->prepare($query_two);
    $stmt_2->execute();
    $row_2 = $stmt_2->fetch(PDO::FETCH_ASSOC);
    $count = $row_2['count'];

    $query_three = "SELECT SUM(quantity) AS book_total FROM orderdetails";
    $stmt_3 = $db->prepare($query_three);
    $stmt_3->execute();
    $row_3 = $stmt_3->fetch(PDO::FETCH_ASSOC);
    $total = $row_3['book_total'];

    $query_four = "SELECT count(orderID) AS order_total FROM ordertable";
    $stmt_4 = $db->prepare($query_four);
    $stmt_4->execute();
    $row_4 = $stmt_4->fetch(PDO::FETCH_ASSOC);
    $order = $row_4['order_total'];


?>
<!--

        <div class="row">
            <div class="col-sm-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                    Total Revenue: $ <?php echo $sum ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
            <div class="card bg-primary text-white">
                    <div class="card-body bg-primary">
                    Number of Users: <?php echo $count ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
            <div class="card bg-primary text-white">
                    <div class="card-body bg-primary">
                    Number of Books: <?php echo $total ?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
                                            
-->
                       
    <!--cards-->
    <div class="container-fluid px-4">
                    <div class="row g-3 my-2">
                        <div class="col-md-3 w-50 h-50">
                            <div
                                class="p-3 shadow-sm d-flex justify-content-around align-items-center rounded" style="background-color: #EDA39D">
                                <div>
                                    <h3 class="fs-2">$<?php echo $sum ?></h3>
                                    <p class="fs-5">Total Generated Sales</p>
                                </div>
                                <i class="fas fa-solid fa-money-bill-1-wave fs-1 primary-text rounded-full secondary-bg p-3"></i>
                            </div>
                        </div>

                        <div class="col-md-3 w-50 h-50">
                            <div
                                class="p-3 shadow-sm d-flex justify-content-around align-items-center rounded" style="background-color: #EDA39D">
                                <div>
                                    <h3 class="fs-2"><?php echo $count ?></h3>
                                    <p class="fs-5">Total Number of Users</p>
                                </div>
                                <i
                                    class="fas fa-solid fa-face-smile fs-1 primary-text rounded-full secondary-bg p-3"></i>
                            </div>
                        </div>

                        <div class="col-md-3 w-50 h-50">
                            <div
                                class="p-3 shadow-sm d-flex justify-content-around align-items-center rounded" style="background-color: #EDA39D">
                                <div>
                                    <h3 class="fs-2"><?php echo $total ?></h3>
                                    <p class="fs-5">Total Books Sold</p> 
                                </div>
                                <i class="fas fa-solid fa-book fs-1 primary-text rounded-full secondary-bg p-3"></i>
                            </div>
                        </div>

                        <div class="col-md-3 w-50 h-50">
                            <div
                                class="p-3 shadow-sm d-flex justify-content-around align-items-center rounded" style="background-color: #EDA39D">
                                <div>
                                    <h3 class="fs-2"><?php echo $order ?></h3>
                                    <p class="fs-5">Total Number Orders</p>
                                </div>
                                <i class="fas fa-truck fs-1 primary-text rounded-full secondary-bg p-3"></i>
                            </div>
                        </div>

                            

                    </div>
            
    </div>
    </section>
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
            </h4>
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
                    $query = "SELECT * FROM book ORDER BY Title ASC";
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

<section class="m-2" id="section4">
<div class="d-flex justify-content-between">
    
<div class="container">
<div class="row">

    <div class="card">
        <div class="card-header">
            <h4>Low Inventory Notice
            </h4>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th>ISBN</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $query_five = "SELECT * FROM book WHERE Stock<10";
                $statement = $db->prepare($query_five);
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
                        </tr>
                        <?php
                        }
                    }
                    ?>
            </tbody>
        </table>
    
</div>
</div>
</div>
</section>



    </div>
    </section>
</div>           
    
</div>

</body>

<!--
total revenue, low inventory, number of books sold (add up quantities), number of registered users
-->

</html>



