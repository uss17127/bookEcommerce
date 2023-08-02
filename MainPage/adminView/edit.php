<?php
	include('../book_db.php');




?>

<!doctype html>
<html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initisal-scale=1">

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <title>Edit Book</title>

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

                    if(isset($_GET['id'])){
                        $title_id = $_GET['id'];

                        $query = "SELECT * FROM book WHERE id=:titleId";
                        $statement = $db->prepare($query);
                        $data = [':titleId' => $title_id];
                        $statement->execute($data);

                        $result = $statement->fetch(PDO::FETCH_OBJ);
                    }
                    ?>


                <form action="code.php" method="POST">
                    <input type="hidden" name="title_id" value="<?= $result->id?>" />
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" value="<?= $result->Title?>" class="form-control text-secondary" />
                    <div>
                    <div class="mb-3">
                        <label>Author</label>
                        <input type="text" name="author" value="<?= $result->Author?>" class="form-control text-secondary" />
                    <div>
                    <div class="mb-3">
                        <label>Price</label>
                        <input type="text" name="price" value="<?= $result->Price?>" class="form-control text-secondary" />
                    <div>
                    <div class="mb-3">
                        <label>ISBN</label>
                        <input type="text" name="isbn" value="<?= $result->ISBN?>" class="form-control text-secondary" />
                    <div>
                    <div class="mb-3">
                        <label>Stock</label>
                        <input type="text" name="stock" value="<?= $result->Stock?>" class="form-control text-secondary" />
                    <div>
                    <div class="mb-3">
                        <label>Vendor</label>
                        <input type="text" name="vendor" value="<?= $result->Vendor?>" class="form-control text-secondary" />
                    <div>
                    <div class="mb-3">
                        <label>Image</label><br>
                        <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                    <div>
                        <br>
                    <div class="mb-3">
                        <button type="submit" name="update_btn" class="btn btn-primary"> Update </button>
                    </div>
                </form>
</div>


</body>

</html>
