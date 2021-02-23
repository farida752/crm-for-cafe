<?php
session_start();
include_once 'dbconnection.php';
include_once 'dropdownhandler.php';


date_default_timezone_set("Egypt");
if($_SERVER['REQUEST_METHOD']=='POST'){
    $fullname = mysqli_real_escape_string($conn,$_POST['fullname']);
    $contactnumber = mysqli_real_escape_string($conn,$_POST['contactnumber']);
    $productname = $_SESSION['saledproductname'];
    $qty = $_SESSION['saledproductqty'];
    $duedate = mysqli_real_escape_string($conn,$_POST['duedate']);

    if(rtrim($fullname)==''||rtrim($contactnumber)==''||rtrim($productname)=='Product Name'||rtrim($qty)==''||rtrim($duedate)==''){
      echo "<script>alert('Some fields are empty please fill them all first!!')</script>;";
    }else{
    productRelated($productname);
    $total = $qty * $GLOBALS['sellingprice'];
    
    $waitername=mysqli_real_escape_string($conn,$_SESSION['username']);
    $sellingdate = mysqli_real_escape_string($conn,date("Y/m/d")." ".date("h:i:sa"));

   
   $state='Unpaid';
   $sql="INSERT INTO customers (fullname,contactnumber,productname,qty,total,duedate,waitername,sellingdate,state)
    VALUES ('$fullname','$contactnumber','$productname','$qty','$total','$duedate','$waitername','$sellingdate','$state') ;";
   mysqli_query($conn,$sql);

   header("Location: customers.php");}}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>cafe website</title>
    <link rel="stylesheet" href="addStyle.css">
  </head>
  <body >
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div id="addproduct">
    <h1 id='title' > Add Invoice </h1>
    <h2 style="margin-left:250px; color:white; margin-bottom:40px; font-family:cursive;"><?php echo $_SESSION['saledproductqty']." of ". $_SESSION['saledproductname'];?></h2>
    
    <input type="text" id="input" name="fullname" placeholder="Full Name">
    
    <input type="text" id="input" name="contactnumber" placeholder="Contact Number">
   
    
    <input type="text" id="input" name="duedate" placeholder="Due Date">
    

    <button id="add" type="submit">Add</button>
</div>
</form>
  </body>
</html>