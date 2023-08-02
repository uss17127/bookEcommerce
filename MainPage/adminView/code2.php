<?php
session_start();
include('../book_db.php');


if(isset($_POST['delete_btn']))
{
    $firstName_ConfirmID = $_POST['delete_btn'];

    try{

        $query = "DELETE FROM registeredusers WHERE ConfirmID=:firstName_ConfirmID";
        $statement = $db->prepare($query);
        $data = [':firstName_ConfirmID' => $firstName_ConfirmID];
        $query_execute = $statement->execute($data);

        if($query_execute){
            $_SESSION['message'] = "Deleted Successfully";
            header('Location:adminView.php');
            exit(0);
        }
        else{
            $_SESSION['message'] = "Not Deleted";
            header('Location:adminView.php');
            exit(0);
        }


    }catch(PDOException $e){
        echo $e->getMessage();
    }

}
if(isset($_POST['update_btn']))
{
    $firstName_ConfirmID = $_POST['firstName_ConfirmID'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $userType = $_POST['userType'];
    $confirmID = $_POST['confirmID'];

    try{

        $query = "UPDATE registeredusers SET FirstName=:firstName, LastName=:lastName, Email=:email, UserType=:userType, ConfirmID=:confirmID WHERE ConfirmID=:firstName_ConfirmID LIMIT 1";
        $statement = $db->prepare($query); 

        $data = [
            ':firstName' => $firstName,
            ':lastName' => $lastName,
            ':email' => $email,
            ':userType' => $userType,
            ':confirmID' => $confirmID,
            ':firstName_ConfirmID' => $firstName_ConfirmID,
        ];

        $query_execute = $statement->execute($data);

        if($query_execute){
            $_SESSION['message'] = "Updated Successfully";
            header('Location:adminView.php');
            exit(0);
        }
        else{
            $_SESSION['message'] = "Not Updated";
            header('Location:adminView.php');
            exit(0);
        }

    }catch(PDOException $e){
        echo $e->getMessage();
    }
}



 

    
    
      
?>