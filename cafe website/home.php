<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>cafe website</title>
    <link rel="stylesheet" href="stylesheet2.css">
  </head>
  <body>
  <div id = "header-container">
    <label id="website-name"> Cafe website </label>
    <img  src="waiter.png">
    <label id="titles" > <?php echo "welcome: " .$_SESSION['username'] ;?> </label>
    <img  src="calendar.png">
    <label id="titles"> <?php
     date_default_timezone_set("Egypt");
     echo date("Y/m/d")." ". date("h:i:sa");?> </label>
     <button style="background: rgba(255, 99, 71, 0.699);  height:30px; margin-top:15px; font-family:cursive;
    color:cornsilk;
    border-radius: 5px;" onclick="document.location.href='dailyreport.php'">DailyReport</button>"
 </div>

 <div id="menu-container" >
     <img  src="home.png">
     <label id="titles" style='background:rgba(255, 235, 205, 0.356)' onclick="document.location.href='home.php';"> Home </label>
     <img  src="sales.png">
     <label id="titles" onclick="document.location.href='sales.php';"> Sales </label>
     <img  src="storage.png">
     <label id="titles" onclick="document.location.href='products.php';"> Products </label>
     <img src="customers.png">
     <label id="titles" onclick="document.location.href='customers.php';"> Customers </label>
     <img  src="supplier.png">
     <label id="titles" onclick="document.location.href='suppliers.php';">Suppliers </label>
    
</div>
<div id="footer">
    <P> our cafe location is .........</p>
    <p> to know more about us visit ........</p>
    <p> our offers are ..............</p>
</div>
<div id="page-container">
   
<div id="page-button" onclick="document.location.href='sales.php';">
     <img  src="sales.png">
     <label > Sales </label>
     </div>
<div id="page-button" onclick="document.location.href='products.php';">
     <img  src="storage.png">
     <label > Products </label>
     </div>
<div id="page-button" onclick="document.location.href='customers.php';">
     <img  src="customers.png">
     <label > Customers </label>
     </div>
<div id="page-button" onclick="document.location.href='suppliers.php';">
     <img src="supplier.png">
     <label >Suppliers </label>
     </div>
</div>
</body>
</html>