<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="contact.css">

    <?php
        require('db-connection.php');
    ?>

</head>
<body>
    <?php
        require('navbar.php');
    ?>
     
    <div class="main-container">
    <section class="container1">
    <header>Registration Form</header>
        <form class="form" method="post">
            <div class="input-box">
                <label>Full Name</label>
                <input required="" name="name" placeholder="Enter full name" type="text">
            </div>
            <div class="column">
                <div class="input-box">
                    <label>Phone Number</label>
                    <input required="" name="number" placeholder="Enter phone number" type="telephone">
                </div>
                <div class="input-box">
                    <label>Birth Date</label>
                    <input required="" name="dob" placeholder="Enter birth date" type="date">
                </div>
            </div>
            <div class="gender-box">
                <label>Gender</label>
                <div class="gender-option">
                <div class="gender">
                    <input checked="" name="gender" value="Male" id="check-male" type="radio">
                    <label for="check-male">Male</label>
                </div>
                <div class="gender">
                    <input name="gender" value="Female" id="check-female" type="radio">
                    <label for="check-female">Female</label>
                </div>
                <div class="gender">
                    <input name="gender" value="Prefer not to say" id="check-other" type="radio">
                    <label for="check-other">Prefer not to say</label>
                </div>
                </div>
            </div>
            <div class="input-box address">
                <label>Address</label>
                <div class="column">
                  <input required="" name="streetAddress" placeholder="Enter street address" type="text">
                  <input required="" name="city" placeholder="Enter your city" type="text">
                </div>
                <div class="column">
                  <input required="" name="state" placeholder="Enter your state" type="text">
                  <input required="" name="country" placeholder="Enter your country" type="text">
                </div>
            </div>
            <button name="submit">Submit</button>
        </form>
    </section>
    <?php

        if(isset($_POST['submit']))
        {
            mysqli_query($con, "INSERT INTO `contact` (`Name`, `Number`, `DOB`, `Gender`, `Street_Address`, `Country`, `City`, `State`) VALUES
                ('$_POST[name]', '$_POST[number]', '$_POST[dob]', '$_POST[gender]', '$_POST[streetAddress]', '$_POST[city]', '$_POST[state]', '$_POST[country]')");
        }
        
    ?>
    </div>

    <?php
        require('footer.php');
    ?>

</body>
</html>