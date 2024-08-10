<?php

    session_start();
    require('dbconnection.php');

    if(!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <link rel="stylesheet" href="addProducts.css">
</head>
<?php
    require('dbconnection.php');
?>
<body>

    <?php
        require('sidebar.php');
    ?>
    
    <h1 style="text-align: center;">ADD PRODUCTS</h1>

    <div class="form-container">
        <form class="form" method="post" enctype="multipart/form-data">
            <p class="title">Add Your Product </p>
            <div class="flex">
                <label>
                    <input class="input" name="productName" type="text" placeholder="" required="">
                    <span>Brand Name</span>
                </label>

            
            </div>  
                    
            <label>
                <input class="input" name="price" type="text" placeholder="" required="">
                <span>Price</span>
            </label> 
                
            <label>
                <input class="input" name="product" type="file" placeholder="Image" required="">
            </label>
            <button type="submit" name="submit1" class="submit">Submit</button>
            
        </form>

        <?php

            if(isset($_POST['submit1'])){
                if(isset($_FILES['product'])) {
                    $file_name = $_FILES['product']['name'];
                    $file_size = $_FILES['product']['size'];
                    $file_tmp = $_FILES['product']['tmp_name'];
                    $file_type = $_FILES['product']['type'];
                    move_uploaded_file($file_tmp, "assets/" . $file_name);
                }

                $query = mysqli_query($con, "SELECT * FROM `products` WHERE `Image` = '$file_name'");
                $count = mysqli_num_rows($query);

                if($count > 0)
                {
                    echo "This Product is already exist";
                }
                else{
                    mysqli_query($con, "INSERT INTO `products`(`Image`, `Name`, `Price`) VALUES
                        ('$file_name', '$_POST[productName]', '$_POST[price]')");
                }
            }

        ?>

    </div>
</body>
</html>