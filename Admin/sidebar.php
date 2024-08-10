<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="sidebar.css">
</head>
<style>
  .log-out{
    height: 30px;
    width: 70px;
    border: 0px;
    color: white;
    border-radius: 10px;
    background-color: red;
    margin-left: 30%;
  }
</style>
<body>
<div id="viewport">
  
  <div id="sidebar">
    <header>
      <a href="#">VowelWeb</a>
    </header>
    <ul class="nav">
      <li>
        <a href="index.php">
          <i class="zmdi zmdi-view-dashboard"></i> Dashboard
        </a>
      </li>
      <li>
        <a href="all_contact.php">
          <i class="zmdi zmdi-link"></i> Contact
        </a>
      </li>
      <li>
        <a href="all_products.php">
          <i class="zmdi zmdi-link"></i> All Products
        </a>
      </li>
      <li>
        <a href="add_products.php">
          <i class="zmdi zmdi-widgets"></i> Add Products
        </a>
      </li>
      <li>
        <a href="allClients.php">
          <i class="zmdi zmdi-widgets"></i> All Clients
        </a>
      </li>
    </ul>
      <a href="log_out.php">
          <input class="log-out" type="submit" value="Log Out">
      </a>
  </div>
</div>
</body>
</html>