<?php

include_once 'classes/Product.php';
$re = new Product();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $product = $re->addProduct($_POST, $_FILES);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />

  <title>Add Product</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="index.php">OOP Crud</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item ">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="allStudents.php">All Students</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="allProducts.php">All Products</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br>
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <?php
          if (isset($product)) {
          ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong><?= $product ?></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php
          }
          ?>
          <div class="card-header d-flex align-items-center justify-content-between">
            <h3>Add Product</h3>
            <a href="allProducts.php" class="btn btn-info float-right">
              Show Product Info
            </a>
          </div>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
              <label for="">Title</label>
              <input type="text" name="title" placeholder="Enter Title" class="form-control" />
              <label for="">Subtitle</label>
              <input type="text" name="subtitle" placeholder="Enter Subtitle" class="form-control" />
              <label for="">Photo</label>
              <input type="file" name="photo" class="form-control" />
              <label for="">Description</label>
              <textarea name="description" class="form-control"></textarea>

              <br>
              <input type="submit" value="Add Product" class="btn btn-success form-control">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>