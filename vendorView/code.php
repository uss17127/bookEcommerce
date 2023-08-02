<?php
session_start();
include('../book_db.php');


if(isset($_POST['delete_btn']))
{
    $title_id = $_POST['delete_btn'];

    try{

        $query = "DELETE FROM book WHERE id=:title_id";
        $statement = $db->prepare($query);
        $data = [':title_id' => $title_id];
        $query_execute = $statement->execute($data);

        if($query_execute){
            $_SESSION['message'] = "Deleted Successfully";
            header('Location:vendorView.php');
            exit(0);
        }
        else{
            $_SESSION['message'] = "Not Deleted";
            header('Location:vendorView.php');
            exit(0);
        }


    }catch(PDOException $e){
        echo $e->getMessage();
    }

}
if(isset($_POST['update_btn']))
{
    $title_id = $_POST['title_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $isbn = $_POST['isbn'];
    $stock = $_POST['stock'];
    $vendor = $_POST['vendor'];
    $image = $_POST['image'];

    try{

        $query = "UPDATE book SET Title=:title, Author=:author, Price=:price, ISBN=:isbn, Stock=:stock, Vendor=:vendor, Image=:image WHERE id=:title_id LIMIT 1";
        $statement = $db->prepare($query); 

        $data = [
            ':title' => $title,
            ':author' => $author,
            ':price' => $price,
            ':isbn' => $isbn,
            ':stock' => $stock,
            ':vendor' => $vendor,
            ':image' => $image,
            ':title_id' => $title_id,
        ];

        $query_execute = $statement->execute($data);

        if($query_execute){
            $_SESSION['message'] = "Updated Successfully";
            header('Location:vendorView.php');
            exit(0);
        }
        else{
            $_SESSION['message'] = "Not Updated";
            header('Location:vendorView.php');
            exit(0);
        }

    }catch(PDOException $e){
        echo $e->getMessage();
    }
}



    if(isset($_POST['save_btn']))
    {

        $title = $_POST['title'];
        $author = $_POST['author'];
        $price = $_POST['price'];
        $isbn = $_POST['isbn'];
        $stock = $_POST['stock'];
        $vendor = $_POST['vendor'];
        $image = $_POST['image'];

        $query = "INSERT INTO book (title,author,price,isbn,stock,vendor,image) VALUES (:title, :author, :price, :isbn, :stock, :vendor, :image)";
        $query_run = $db->prepare($query);

        $data = [
            ':title' => $title,
            ':author' => $author,
            ':price' => $price,
            ':isbn' => $isbn,
            ':stock' => $stock,
            ':vendor' => $vendor,
            ':image' => $image,

        ];
        $query_execute = $query_run->execute($data);

        if($query_execute){
            $_SESSION['message'] = "Inserted Successfully";
            header('Location:vendorView.php');
            exit(0);
        }
        else{
            $_SESSION['message'] = "Not Inserted";
            header('Location:vendorView.php');
            exit(0);
        }

    
    
    }   
?>