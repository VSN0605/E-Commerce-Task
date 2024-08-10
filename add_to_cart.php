<?php
session_start();
include('db-connection.php'); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_SESSION['username'])) {
        $user = $_SESSION['username'];
    } else {
        die('No username found in session');
    }

    $name = $_POST['name'];
    $price = $_POST['price'];
    $total = $_POST['price'];
    $image = $_POST['image'];
    $quantity = 1;

    $stmt = $con->prepare("INSERT INTO `cart` (`username`, `Image`, `Name`, `Price`, `Quantity`, `Total`) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($con->error));
    }

    $stmt->bind_param("ssssis", $user, $image, $name, $price, $quantity, $total);

    if ($stmt->execute()) {
        echo "Product added to cart";
    } else {
        echo "Failed to add product to cart: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
}
?>
