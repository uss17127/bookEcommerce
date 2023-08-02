<?php

    $dsn='mysql:host=localhost;dbname=bookstore;charset=utf8';
    $username='root';
    $password='';
    try{
    $db = new pdo($dsn,$username,$password);
    }catch(PDOException $e){
    $error_message=$e->getMessage();
    echo $error_message;
    exit();
    }


?>