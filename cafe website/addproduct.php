<?php
include_once 'dbconnection.php';
include_once 'dropdownhandler.php';

date_default_timezone_set("Egypt");
if($_SERVER['REQUEST_METHOD']=='POST'){
    $brandName = mysqli_real_escape_string($conn,$_POST['brandname']);
    $genericName = mysqli_real_escape_string($conn,$_POST['genericname']);
    $category = mysqli_real_escape_string($conn,$_POST['category']);
    $supplier = mysqli_real_escape_string($conn,$_POST['supplier']);
   //$supplier = "supplier";
    $expiryDate = mysqli_real_escape_string($conn,$_POST['expirydate']);
    $originalPrice = mysqli_real_escape_string($conn,$_POST['originalprice']);
    $sellingPrice = mysqli_real_escape_string($conn,$_POST['sellingprice']);
    $qty = mysqli_real_escape_string($conn,$_POST['qty']);
    $qtyLeft = mysqli_real_escape_string($conn,$_POST['qty']);
    $dateReceived = mysqli_real_escape_string($conn,date("Y/m/d")." ".date("h:i:sa"));

    if(rtrim($brandName)==''||rtrim($genericName)==''||rtrim($category)==''||rtrim($supplier)=='Supplier'||rtrim($expiryDate)==''||rtrim($originalPrice)==''||
    rtrim($sellingPrice)==''||rtrim($qty)==''||rtrim($qtyLeft)==''){
      echo "<script>alert('Some fields are empty please fill them all first!!')</script>;";
    }else{

   $sql="INSERT INTO products (brandname,genericname,category,suppllier,expirydate,originalprice,sellingprice,qty,qtyleft,datereceived)
    VALUES ('$brandName','$genericName','$category','$supplier','$expiryDate','$originalPrice'
    ,'$sellingPrice','$qty','$qtyLeft','$dateReceived') ;";
   if(!mysqli_query($conn,$sql)){
     echo "<script>alert('This Product already exists in your shelves you have to finish selling all its items first')</script>;";
   }else{

   header("Location: products.php");}}}
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
    <h1 id='title' > Add Product </h1>
    
    <input type="text" id="input" name="brandname" placeholder="Brand Name">
    
    <input type="text" id="input" name="genericname" placeholder="Generic Name">
   
    <input type="text" id="input" name="category" placeholder="Category">
    
    <select id="input" name="supplier" style="text-align-last:center;">
        <option  selected="selected">Supplier</option>
        <?php
       
        // Iterating through the product array
        foreach($suppliersnames as $item){
            echo "<option value='$item'>$item</option>";
        }
        ?>
    </select>
     
    <input type="text" id="input" name="expirydate" placeholder="Expiry Date">
    
    <input type="text" id="input" name="originalprice" placeholder="Original Price">
    
    <input type="text" id="input" name="sellingprice" placeholder="Selling Price">

    <input type="text" id="input" name="qty" placeholder="QTY">

    <button id="add" type="submit">Add</button>
</div>
</form>
  </body>
</html>