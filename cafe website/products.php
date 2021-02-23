<?php
session_start();
include_once 'dbconnection.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>cafe website</title>
    <link rel="stylesheet" href="stylesheet2.css">
    <link rel="stylesheet" href="productsStyleSheet.css">
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
 </div>

 <div id="menu-container" >
     <img  src="home.png">
     <label id="titles"  onclick="document.location.href='home.php';"> Home </label>
     <img  src="sales.png">
     <label id="titles" onclick="document.location.href='sales.php';" > Sales </label>
     <img  src="storage.png">
     <label id="titles" onclick="document.location.href='products.php';" style='background:rgba(255, 235, 205, 0.356)'> Products </label>
     <img src="customers.png">
     <label id="titles" onclick="document.location.href='customers.php';"> Customers </label>
     <img  src="supplier.png">
     <label id="titles" onclick="document.location.href='suppliers.php';">Suppliers </label>
</div>

<div id="main-page">
    <div id="page-header">
    <img  src="storage.png">
    <h1 id="page-title"> Products </h1>
    <button style="margin-left:720px;  background: rgba(255, 99, 71, 0.699); height:30px; margin-top:15px; font-family:cursive;
    color:cornsilk;
    border-radius: 5px;" onclick="document.location.href='endedProducts.php'">EndedProducts</button>
    </div>

    <div id="page-info">
    <h2 > <?php 
    $count="SELECT count(id) FROM  products ;";
    $res=mysqli_query($conn,$count);
    $rows=mysqli_fetch_assoc($res);
    echo "Total Number Of Products: ".$rows['count(id)'];?> </h2>
    <h2 > <?php 
    $less="SELECT count(id) FROM  products WHERE qtyleft<10 ;";
    $res1=mysqli_query($conn,$less);
    $rows=mysqli_fetch_assoc($res1);
    
    echo "<span style='color:RED;'>".$rows['count(id)']."</span>"." Products are below QTY of 10"?> </h2>
    </div>
   <div id = "row2">
       <form id="form-search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="text" id="search-field" placeholder="Search for product" name="searchfield" >
</form>

    <div id= "add-product" onclick="document.location.href='addproduct.php'">
    <img  id="icon" src="plus.png">
    <label id="label">AddProduct </label>
    </div>
</div>
<div id="tablediv">
<table>
    <tr>
        <th> Brand name </th>
        <th> Generic name </th>
        <th> Category </th>
        <th> Supplier </th>
        <th> Date received </th>
        <th> Date expiry </th>
        <th> Original price </th>
        <th> Selling price</th>
        <th> QTY </th>
        <th> QTY left </th>
</tr>
<?php

if(!isset($_POST['searchfield'])||$_POST['searchfield']==""){
    $GLOBALS['sql']="SELECT * FROM  products ;";
    $GLOBALS['result']=mysqli_query($conn,$GLOBALS['sql']);
}else{
   // echo $_POST['searchfield'];
//There  is a word to search
$sql="SELECT * FROM products WHERE brandname =? OR genericname =? OR category =? OR suppllier =? 
  OR originalprice =? OR sellingprice =? OR qty =? OR qtyleft =? OR datereceived =? OR expirydate =? ;";

$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
   echo "The statement failed";
}else{
    mysqli_stmt_bind_param($stmt,"ssssssssss",$_POST['searchfield'],$_POST['searchfield'],$_POST['searchfield']
    ,$_POST['searchfield'],$_POST['searchfield'],$_POST['searchfield'],$_POST['searchfield'],
    $_POST['searchfield'],$_POST['searchfield'],$_POST['searchfield']);
    

   mysqli_stmt_execute($stmt);
   $GLOBALS['result']= mysqli_stmt_get_result($stmt);
  
}
}

 if(mysqli_num_rows($GLOBALS['result'])>0){
while($rows=mysqli_fetch_assoc($GLOBALS['result'])){
    if($rows['qtyleft']<10){
        echo "<tr style='background-color: rgb(141, 15, 15);'>";
    }else{echo "<tr>";}
    echo 
    " <td>".$rows['brandname']."</td> <td>".
    $rows['genericname']."</td> <td>".
    $rows['category']."</td> <td>".
    $rows['suppllier']."</td> <td>".
    $rows['datereceived']."</td> <td>".
    $rows['expirydate']."</td> <td>".
    $rows['originalprice']."</td> <td>".
    $rows['sellingprice']."</td> <td>".
    $rows['qty']."</td> <td>".
    $rows['qtyleft']."</td> </tr>";}
    echo "</table></div>";
 }
?>
  
</div>
</body>
 
 </html>