<?php

    session_start();
    require('dbconnection.php');

    if(!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }


if (isset($_POST['update_btn'])) {
    $query = "SELECT * FROM `products` WHERE `id` = '$_POST[update_id]'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        while ($row = mysqli_fetch_assoc($query_run)) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="addProducts.css">
</head>
<body>

    <?php require('sidebar.php'); ?>

    <h1 style="text-align: center;">UPDATE PRODUCTS</h1>

    <div class="form-container">
        <form class="form" method="post" enctype="multipart/form-data">
            <p class="title">Update Your Product </p>
            <label>
                <input class="input" type="text" value="<?php echo $row['id']; ?>" disabled>
                <span>Product ID</span>
            </label> 
            <input type="hidden" name="newID" value="<?php echo $row['id']; ?>">

            <div class="flex">
                <label>
                    <input class="input" name="productName" type="text" value="<?php echo $row['Name']; ?>" required="">
                    <span>Brand Name</span>
                </label>
            </div>  
                    
            <label>
                <input class="input" name="price" type="text" value="<?php echo $row['Price']; ?>" required="">
                <span>Price</span>
            </label> 
                
            <label>
                <input class="input" name="product" type="file" accept="image/*">
                
            </label>
            <button type="submit" name="submit1" class="submit">Submit</button>
        </form>
    </div>

<?php
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

if (isset($_POST['submit1'])) {
    $file_name = '';

    if (isset($_FILES['product']) && $_FILES['product']['name'] != '') {
        $file_name = $_FILES['product']['name'];
        $file_tmp = $_FILES['product']['tmp_name'];
        move_uploaded_file($file_tmp, "assets/" . $file_name);
    } else {
        $file_name = $row['Image'];
    }

    $newID = $_POST['newID'];
    $productName = $_POST['productName'];
    $price = $_POST['price'];

    $query = "UPDATE `products` SET `Image`='$file_name', `Name`='$productName', `Price`='$price' WHERE `id`='$newID'";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        header("Location: all_products.php?msg=Product Updated Successfully");
        exit();
    } else {
        echo "Failed to update: " . mysqli_error($con);
    }
}
?>

</body>
</html>
