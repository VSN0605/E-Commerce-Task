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
    <title>All Contacts</title>
    <link rel="stylesheet" href="allProducts.css">
</head>
<?php
    require('dbconnection.php');
?>
<body>
    <?php
        require('sidebar.php');
    ?>

    <h1 style="text-align: center; color: black">ALL CONTACT </h1>

    <div class="container" style="margin-left: 10%;">

        <form method="post" enctype="multipart/form-data">
            <?php
                $dis = mysqli_query($con, "SELECT * FROM contact");
                if($dis) {
           echo '<table class="rwd-table">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Number</th>
                    <th>Date Of Birth</th>
                    <th>Gender</th>
                    <th>Street Address</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Action</th>
                </tr>';

                while ($row = mysqli_fetch_array($dis)){
                echo "<tr>";
                    echo "<td>"; echo $row['id']; echo "</td>";
                    echo "<td>"; echo $row['Name']; echo "</td>";
                    echo "<td>"; echo $row['Number']; echo "</td>";
                    echo "<td>"; echo $row['DOB']; echo "</td>";
                    echo "<td>"; echo $row['Gender']; echo "</td>";
                    echo "<td>"; echo $row['Street_Address']; echo "</td>";
                    echo "<td>"; echo $row['Country']; echo "</td>";
                    echo "<td>"; echo $row['City']; echo "</td>";
                    echo "<td>"; echo $row['State']; echo "</td>";
                    echo "<td>";
                    ?>
                    </form>

                    <form method="post" action="delete_contact.php">
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