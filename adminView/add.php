<?php
	include('../book_db.php');

?>

<!doctype html>
<html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initisal-scale=1">

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <title>Add Book</title>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mt-4">

            <div class="card">
                <div class="card-header">
                    <h3>Add Book
                    <a href="adminView.php" class="btn btn-danger float-end">BACK</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST">
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" />
                    <div>
                    <div class="mb-3">
                        <label>Author</label>
                        <input type="text" name="author" class="form-control" />
                    <div>
                    <div class="mb-3">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" />
                    <div>
                    <div class="mb-3">
                        <label>ISBN</label>
                        <input type="text" name="isbn" class="form-control" />
                    <div>
                    <div class="mb-3">
                        <label>Stock</label>
                        <input type="text" name="stock" class="form-control" />
                    <div>
                    <div class="mb-3">
                        <label>Vendor</label>
                        <input type="text" name="vendor" class="form-control" />
                    <div>
                    <div class="mb-3 form group">
                        <label>Image</label><br>
                        <input type="file" name="image"  class="form-control-file" id="exampleFormControlFile1">
                    <div>
                    <br>
                    <div class="mb-3">
                        <button type="submit" name="save_btn" class="btn btn-primary"> Save </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

            

</body>

</html>
