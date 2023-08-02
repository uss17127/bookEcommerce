<?php
	include('../book_db.php');



$delfirstName = $_GET['delfirstName'];

$stmt=$db->prepare("DELETE FROM registeredusers WHERE title=:dfirstName");
$stmt->execute(array(':dfirstName'=>$delfirstName));

header("location:adminView.php");


?>