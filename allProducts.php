<?php

include_once 'classes/Product.php';
$re = new Product();

if (isset($_GET['delStd'])) {
    $id = base64_decode($_GET['delStd']);
    $delProducts = $re->delProduct($id);
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

    <title>Registration Form</title>
</head>

<body>
    <br>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <?php
                    if (isset($delProducts)) {
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><?= $delProducts ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="card-header d-flex align-items-center justify-content-between">

                        <h3>All Products Info</h3>
                        <a href="addProduct.php" class="btn btn-info float-right">
                            Add Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">

            <?php
            $allStd = $re->allProducts();
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