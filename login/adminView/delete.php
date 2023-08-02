<?php
	include('../book_db.php');



$deltitle = $_GET['deltitle'];

$stmt=$db->prepare("DELETE FROM book WHERE title=:dtitle");
$stmt->execute(array(':dtitle'=>$deltitle));

header("location:adminView.php");


?>