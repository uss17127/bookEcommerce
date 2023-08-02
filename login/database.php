<?php

    $dsn = 'mysql:host=localhost;dbname=bookstore';
    $username_db = 'root';
    $password_db = '';


    try {
        $db = new PDO($dsn, $username_db, $password_db);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        exit();
    }
    

?>

