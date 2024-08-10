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
    <title>All Products</title>
    <link rel="stylesheet" href="allProducts.css">
</head>
<?php
    require('dbconnection.php');
?>
<body>
    <?php
        require('sidebar.php');
    ?>

    <h1 style="text-align: center; color: black">ALL PRODCUTS </h1>

    <div class="container">

        <form method="post" enctype="multipart/form-data">
            <?php
                $dis = mysqli_query($con, "SELECT * FROM products");
                if($dis) {
           echo '<table class="rwd-table">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Action</th>
                </tr>';

                while ($row = mysqli_fetch_array($dis)){
                echo "<tr>";
                    echo "<td>"; echo $row['id']; echo "</td>";
                    echo "<td>";?> <img height="50px" width="50px" src="assets/<?php echo $row['Image']; ?>"> <?php echo "</td>";
                    echo "<td>"; echo $row['Name']; echo "</td>";
                    echo "<td>"; echo $row['Price']; echo "</td>";
                    echo "<td>";
                    ?>
                    </form>
                    <form method="post" action="delete_product.php">
                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                        <input type="submit" class="delete" name="delete_btn" value="DELETE">
                    </form>

                    <form method="post" action="update_product.php">
                        <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
                        <input type="submit" class="update" name="update_btn" value="UPDATE">
                    </form>
                    </td>
                </tr>
                <?php
                }
                echo "</tbody>
            </table>";
                } else{
                    echo "Error: " . mysqli_error($con);
                }
                ?>
        

    </div>
</body>
</html>