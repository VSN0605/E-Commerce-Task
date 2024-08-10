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
    <title>All Users</title>
    <link rel="stylesheet" href="allProducts.css">
</head>
<?php
    require('dbconnection.php');
?>
<body>
    <?php
        require('sidebar.php');
    ?>

    <h1 style="text-align: center; color: black">ALL USERS </h1>

    <div class="container">

        <form method="post" enctype="multipart/form-data">
            <?php
                $dis = mysqli_query($con, "SELECT * FROM user_registration");
                if($dis) {
           echo '<table class="rwd-table">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email Id</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>';

                while ($row = mysqli_fetch_array($dis)){
                echo "<tr>";
                    echo "<td>"; echo $row['id']; echo "</td>";
                    echo "<td>"; echo $row['username']; echo "</td>";
                    echo "<td>"; echo $row['email']; echo "</td>";
                    echo "<td>"; echo '****'; echo "</td>";
                    echo "<td>";
                    ?>
                    </form>

                    <form method="post" action="delete_user.php">
                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                        <input type="submit" class="delete" name="delete_btn" value="DELETE">
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