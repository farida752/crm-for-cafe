<?php
include_once 'dbconnection.php';


if($_SERVER['REQUEST_METHOD']=='POST'){
    $supplier = mysqli_real_escape_string($conn,$_POST['supplier']);
    $contactperson = mysqli_real_escape_string($conn,$_POST['contactperson']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $contactnumber = mysqli_real_escape_string($conn,$_POST['contactnumber']);
 
if( rtrim($supplier)==''||rtrim($contactperson)==''||rtrim($address)==''||rtrim($contactnumber)==''){
  echo "<script>alert('Some fields are empty please fill them all first!!')</script>;";
}else{
   $sql="INSERT INTO suppliers (supplier,contactperson,address,contactnumber)
    VALUES ('$supplier','$contactperson','$address','$contactnumber') ;";
  if(!mysqli_query($conn,$sql)){
    echo "<script>alert('This contact person for the supplier company aleardy exists')</script>;";
  }else{

   header("Location: suppliers.php");}}}
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
    <h1 id='title' > Add Supplier </h1>
    
    <input type="text" id="input" name="supplier" placeholder="Supplier">
    
    <input type="text" id="input" name="contactperson" placeholder="Contact Person ">
   
    <input type="text" id="input" name="address" placeholder="Address">
    
    <input type="text" id="input" name="contactnumber" placeholder="Contact Number">
     
    

    <button id="add" type="submit">Add</button>
</div>
</form>
  </body>
</html>