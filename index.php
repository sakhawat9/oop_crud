<?php

include_once 'classes/Register.php';
$re = new Register();
include_once 'classes/Product.php';
$product = new Product();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />

    <title>Registration Form</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">OOP Crud</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="allStudents.php">All Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="allProducts.php">All Products</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="text-center mb-4">
                    <h3>Student Info</h3>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Photo</th>
                            <th>Address</th>
                        </tr>
                        <?php
                        $allStd = $re->allStudent();
                        $limit = 3;

                        if ($allStd) {
                            $count = 0;

                            while ($row = mysqli_fetch_assoc($allStd)) {
                        ?>
                                <tr>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['phone'] ?></td>
                                    <td><img style="width: 100px;" src="<?= $row['photo'] ?>" class="img-fluid" alt=""></td>
                                    <td><?= $row['address'] ?></td>
                                </tr>
                        <?php
                                $count++;
                                if ($count == $limit) {
                                    break;
                                }
                            }
                        }
                        ?>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Student Info</h3>
        </div>
        <div class="row mt-5">

            <?php
            $allStd = $product->allProducts();
            $limit = 3;

            $count = 0;
            if ($allStd) {
                while ($row = mysqli_fetch_assoc($allStd)) {
            ?>
                    <div class="col-md-4">
                        <div class="p-4 shadow rounded">
                            <img src="<?= $row['photo'] ?>" class="img-fluid mb-3 rounded" alt="">
                            <h3><?= $row['title'] ?></h3>
                            <p><?= $row['subtitle'] ?></p>
                            <p><?= $row['description'] ?></p>
                            <div class="grid gap-5">
                                <a href="productEdit.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-warning">Edit</a>
                                <a href="?delStd=<?= base64_encode($row['id']) ?>" onclick="return confirm('Are you sere to delete')" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
            <?php
                    $count++;
                    if ($count == $limit) {
                        break;
                    }
                }
            }
            ?>
        </div>
    </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>