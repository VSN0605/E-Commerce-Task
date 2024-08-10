<?php

    if(isset($_POST['delete_id']) && is_numeric($_POST['delete_id'])) {
        $ID = $_POST['delete_id'];

        require('dbconnection.php');

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "DELETE FROM `products` WHERE `id` = ?";
        $stmt = mysqli_prepare($con, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $ID);

            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                header("Location: all_products.php?msg=Product Deleted Successfully");
                exit();
            } else{
                echo "Failed: " . mysqli_error($con);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Failed to prepare statement";
        }

        mysqli_close($con);
    } else{
        echo "Invalid ID provided";
    }

?>