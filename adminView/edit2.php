<?php
	include('../book_db.php');




?>

<!doctype html>
<html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initisal-scale=1">

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <title>Edit User</title>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mt-4">

            <div class="card">
                <div class="card-header">
                    <h3>Edit Book</h3>
                    <a href="adminView.php" class="btn btn-danger float-end">BACK</a>
                </div>
                <div class="card-body">
                    <?php

                    if(isset($_GET['ConfirmID'])){
                        $firstName_ConfirmID = $_GET['ConfirmID'];

                        $query = "SELECT * FROM registeredusers WHERE ConfirmID=:firstNameConfirmId";
                        $statement = $db->prepare($query);
                        $data = [':firstNameConfirmId' => $firstName_ConfirmID];
                        $statement->execute($data);

                        $result = $statement->fetch(PDO::FETCH_OBJ);
                    }
                    ?>


                <form action="code2.php" method="POST">
                    <input type="hidden" name="firstName_ConfirmID" value="<?= $result->ConfirmID?>" />
                    <div class="mb-3">
                        <label>First Name</label>
                        <input type="text" name="firstName" value="<?= $result->FirstName?>" class="form-control text-secondary" />
                    <div>
                    <div class="mb-3">
                        <label>Last Name</label>
                        <input type="text" name="lastName" value="<?= $result->LastName?>" class="form-control text-secondary" />
                    <div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="text" name="email" value="<?= $result->Email?>" class="form-control text-secondary" />
                    <div>
                    <div class="mb-3">
                        <label>User Type</label>
                        <input type="text" name="userType" value="<?= $result->UserType?>" class="form-control text-secondary" />
                    <div>
                    <div class="mb-3">
                        <label>Confirmation ID</label>
                        <input type="text" name="confirmID" value="<?= $result->ConfirmID?>" class="form-control text-secondary" /><br>
                    <div>
                    <div class="mb-3">
                        <button type="submit" name="update_btn" class="btn btn-primary"> Update </button>
                    </div>
                </form>
</div>


</body>

</html>
