<?php

    session_start();
    require('db-connection.php');

    if(!isset($_SESSION['username'])) {
        header("Location: user-login");
        exit();
    }

    $username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VowelWeb Task</title>
    <link rel="stylesheet" href="index.css" />
    
</head>
<body>
    <?php
        require('navbar.php');
    ?> 

    <div style="margin-top: 80px; text-align: right; padding: 10px">
        <h4>Welcome <?php echo $_SESSION['username']; ?></h4>
    </div>

    <div class="product-container">

    <?php
        $username = $_SESSION['username'];
        $dis = mysqli_query($con, "SELECT * FROM `products`");
        if ($dis) {
            while ($row = mysqli_fetch_array($dis)) {
    ?>

    <div class="card">
        <div class="image_container">
            <img src="assets/<?php echo htmlspecialchars($row['Image']); ?>" height="127px" width="192px"/>
        </div>
        <div class="title">
            <span><?php echo htmlspecialchars($row['Name']); ?></span>
        </div>
        <div class="action">
            <div class="price">
                <span><?php echo htmlspecialchars($row['Price']); ?></span>
            </div>
            <button class="cart-button" type="button"
                data-name="<?php echo htmlspecialchars($row['Name']); ?>"
                data-price="<?php echo htmlspecialchars($row['Price']); ?>"
                data-image="<?php echo htmlspecialchars($row['Image']); ?>"
            >
            <svg
                class="cart-icon"
                stroke="currentColor"
                stroke-width="1.5"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"
                stroke-linejoin="round"
                stroke-linecap="round"
                ></path>
            </svg>
            <span>Add to cart</span>
            </button>
        </div>
    </div>
    <?php
            }
        }
    ?>

</div>

<script>

    document.addEventListener("DOMContentLoaded", function() {
    const cartButtons = document.querySelectorAll(".cart-button");

    cartButtons.forEach(button => {
        button.addEventListener("click", function() {
            
            const productName = this.getAttribute("data-name");
            const productPrice = this.getAttribute("data-price");
            const productImage = this.getAttribute("data-image");

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "add_to_cart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert("Product added to cart successfully!");
                    } else {
                        console.error("Server responded with status: " + xhr.status);
                        console.error("Response: " + xhr.responseText);
                    }
                }
            };
            xhr.onerror = function() {
                console.error("Request failed");
            };
            xhr.send(`name=${encodeURIComponent(productName)}&price=${encodeURIComponent(productPrice)}&image=${encodeURIComponent(productImage)}`);
            
        });
    });
});

</script>


    <?php
        require('footer.php');
    ?>
</body>
</html>