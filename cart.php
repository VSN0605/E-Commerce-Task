<?php
session_start();
require('db-connection.php');

if (!isset($_SESSION['username'])) {
    header("Location: user-login");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <?php
    require('navbar.php');
    ?>

    <header>
        <h1>Your Cart</h1>
        <nav>
            <a href="index.php">Home</a>
        </nav>
    </header>

    <main>
        <div class="cart-container">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product Id</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $dis = mysqli_query($con, "SELECT * FROM `cart` WHERE `username` = '$username'");
                    if ($dis) {
                        while ($row = mysqli_fetch_array($dis)) {
                    ?>
                    <tr data-id="<?php echo $row['id']; ?>">
                        <td><?php echo $row['id']; ?></td>
                        <td><img src="assets/<?php echo $row['Image']; ?>" height="50px" width="50px"></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td class="price"><?php echo $row['Price']; ?></td>
                        <td><input type="number" class="quantity" value="<?php echo $row['Quantity']; ?>" min="1"></td>
                        <td class="total"></td>
                        <td>
                            <form method="post" action="removeProduct.php">
                                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="remove-button">Remove</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

            <div class="cart-summary">
                <p>Total: <span id="cart-total">0</span></p>
                <button id="checkout-button" class="checkout-button">Proceed to Checkout</button>
            </div>

            <div id="checkout-summary" style="display:none;">
                <h2>Checkout Summary</h2>
                <table id="checkout-table" class="checkout-table">
                    <thead>
                        <tr>
                            <th>Product Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">Final Amount</td>
                            <td id="final-amount">0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function updateCartTotals() {
                var rows = document.querySelectorAll(".cart-table tbody tr");
                var cartTotal = 0;

                rows.forEach(function(row) {
                    var price = parseFloat(row.querySelector(".price").textContent);
                    var quantity = parseFloat(row.querySelector(".quantity").value);
                    var total = price * quantity;
                    row.querySelector(".total").textContent = total.toFixed(2);
                    cartTotal += total;
                });

                document.getElementById("cart-total").textContent = cartTotal.toFixed(2);
            }

            function generateCheckoutSummary() {
                var rows = document.querySelectorAll(".cart-table tbody tr");
                var summaryTable = document.getElementById("checkout-table").getElementsByTagName('tbody')[0];
                var finalAmount = 0;

                summaryTable.innerHTML = '';

                rows.forEach(function(row) {
                    var id = row.querySelector("td").textContent;
                    var image = row.querySelector("img").src;
                    var name = row.querySelector("td:nth-child(3)").textContent;
                    var price = parseFloat(row.querySelector(".price").textContent);
                    var quantity = parseFloat(row.querySelector(".quantity").value);
                    var total = price * quantity;

                    finalAmount += total;

                    var newRow = summaryTable.insertRow();
                    newRow.innerHTML = `
                        <td>${id}</td>
                        <td><img src="${image}" height="50px" width="50px"></td>
                        <td>${name}</td>
                        <td>${price.toFixed(2)}</td>
                        <td>${quantity}</td>
                        <td>${total.toFixed(2)}</td>
                    `;
                });

                document.getElementById("final-amount").textContent = finalAmount.toFixed(2);
            }

            updateCartTotals();

            var quantityInputs = document.querySelectorAll(".quantity");
            quantityInputs.forEach(function(input) {
                input.addEventListener("input", updateCartTotals);
            });

            document.getElementById("checkout-button").addEventListener("click", function() {
                generateCheckoutSummary();
                document.getElementById("checkout-summary").style.display = "block";
            });
        });
    </script>

    <?php
    require('footer.php');
    ?>
</body>
</html>
