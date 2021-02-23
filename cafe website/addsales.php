<?php
session_start();
include_once 'dbconnection.php';
include_once 'dropdownhandler.php';

date_default_timezone_set("Egypt");
if($_SERVER['REQUEST_METHOD']=='POST'){
    $productname = mysqli_real_escape_string($conn,$_POST['productname']);
    $qty = mysqli_real_escape_string($conn,$_POST['qty']);
    $paid_invoice = mysqli_real_escape_string($conn,$_POST['paid/invoice']);

    if(rtrim($productname)=='Product Name'||rtrim($qty)==''||rtrim($paid_invoice)=='paid/invoice'){
      echo "<script>alert('Some fields are empty please fill them all first!!')</script>;";
     }else{

    $waitername = mysqli_real_escape_string($conn,$_SESSION['username']);
    //fuction in the required php page that you give it the product name and it gives you all its data
    productRelated($productname);
    $category =  mysqli_real_escape_string($conn,$GLOBALS['category']);
    $price =    $qty * $GLOBALS['sellingprice'];
    $profit = $price-($qty * $GLOBALS['originalprice']);
   // $dateReceived = mysqli_real_escape_string($conn,date("Y/m/d")." ".date("h:i:sa"));
   $dateReceived = mysqli_real_escape_string($conn,date("Y/m/d")." ".date("h:i:sa"));
   $brandname = mysqli_real_escape_string($conn,$GLOBALS['brandname']);
   $dateproReceived = mysqli_real_escape_string($conn,$GLOBALS['datereceived']);
   $dateproexpiry = mysqli_real_escape_string($conn,$GLOBALS['expirydate']);
   $sellingprice = mysqli_real_escape_string($conn,$GLOBALS['sellingprice']);
   $originalprice = mysqli_real_escape_string($conn,$GLOBALS['originalprice']);
   $qtypro = mysqli_real_escape_string($conn,$GLOBALS['qtypro']);
   $supplier = mysqli_real_escape_string($conn,$GLOBALS['supplier']);
   $proid = mysqli_real_escape_string($conn,$GLOBALS['id']);

   //if the qty required exceeds the qty left 
   if($qty>$GLOBALS['qtyleft']){
     $less=$GLOBALS['qtyleft'];
   echo "<script> alert('this sale exceed the quantity Left , we have only '+ $less ) </script>;";
   }else{
//save the sale data to the data base table sales
   $sql="INSERT INTO sales (productname,qty,paidORinvoice,date,waitername,category,price,profit)
    VALUES ('$productname','$qty','$paid_invoice','$dateReceived','$waitername','$category','$price','$profit') ;";
   mysqli_query($conn,$sql);

   // update the product table of our data base by subtracting the quantatiy just saled
   $newQtyLeft=$GLOBALS['qtyleft']-$qty;
   //if the product ended so move it from the product table to the ended product table
   if($newQtyLeft==0){
    $sqlinsertended="INSERT INTO endedproducts (brandname,genericname,category,datereceived,expirydate,endeddate,supplier,sellingprice,originalprice,qty)
    VALUES ('$brandname','$productname','$category','$dateproReceived','$dateproexpiry','$dateReceived','$supplier','$sellingprice','$originalprice','$qtypro') ;";
   mysqli_query($conn,$sqlinsertended);

   $sqldelete="DELETE FROM products WHERE id = '".$proid." ';";
   mysqli_query($conn,$sqldelete);
   }else{
     //if the qtyleft is still not zero just update it 
   $sqlUpdate="UPDATE products SET qtyleft= '".$newQtyLeft."' WHERE genericname = '".$productname." ';";
   mysqli_query($conn,$sqlUpdate);}
 
   //if the customer didn't pay and make invoice we should save it then
   if($paid_invoice=='Invoice'){
     $_SESSION['saledproductname']=$productname ;
     $_SESSION['saledproductqty']=$qty;
    header("Location: addcustomerinvoice.php");
   }else{
   header("Location: sales.php");}}}}
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
    <h1 id='title' > Add Sale </h1>
    
    <select id="input" name="productname" style="text-align-last:center;">
        <option  selected="selected">Product Name</option>
        <?php
       
        // Iterating through the product array
        foreach($productsnames as $item){
            echo "<option value='$item'>$item</option>";
        }
        ?>
    </select>
    
    <input type="text" id="input" name="qty" placeholder="QTY">
   
    
    <select id="input" name="paid/invoice" style="text-align-last:center;">
        <option  selected="selected">paid/invoice</option>
        <option value='Paid'>Paid</option>
        <option value='Invoice'>Invoice</option>
    </select>
    

    <button id="add" type="submit">Add</button>
</div>
</form>
  </body>
</html>