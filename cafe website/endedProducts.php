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
    <h1 id="page-title"> Ended Products </h1>
    <button style="margin-left:700px;  background: rgba(255, 99, 71, 0.699);  height:30px; margin-top:15px; font-family:cursive;
    color:cornsilk;
    border-radius: 5px;" onclick="document.location.href='products.php'">Products</button>
    </div>

    <div id="page-info">
    <h2 > <?php 
    $count="SELECT count(id) FROM  endedproducts ;";
    $res=mysqli_query($conn,$count);
    $rows=mysqli_fetch_assoc($res);
    echo "Total Number Of Ended Products: ".$rows['count(id)'];?> </h2>
    <h2 > </h2>
    </div>
   <div id = "row2">
       <form id="form-search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="text" id="search-field" placeholder="Search for product" name="searchfield" >
</form>

    <div id= "add-product" style="margin-bottom:50px">
    
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
        <th> Ended date </th>
        <th> Original price </th>
        <th> Selling price</th>
        <th> QTY </th>
       
</tr>
<?php

if(!isset($_POST['searchfield'])||$_POST['searchfield']==""){
    $GLOBALS['sql']="SELECT * FROM  endedproducts ;";
    $GLOBALS['result']=mysqli_query($conn,$GLOBALS['sql']);
}else{
   // echo $_POST['searchfield'];
//There  is a word to search
$sql="SELECT * FROM endedproducts WHERE brandname =? OR genericname =? OR category =? OR supplier =? 
  OR originalprice =? OR sellingprice =? OR qty =? OR endeddate =? OR datereceived =? OR expirydate =? ;";

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
   
    echo 
    "<tr> <td>".$rows['brandname']."</td> <td>".
    $rows['genericname']."</td> <td>".
    $rows['category']."</td> <td>".
    $rows['supplier']."</td> <td>".
    $rows['datereceived']."</td> <td>".
    $rows['expirydate']."</td> <td>".
    $rows['endeddate']."</td> <td>".
    $rows['originalprice']."</td> <td>".
    $rows['sellingprice']."</td> <td>".
    $rows['qty']."</td> </tr>";}
    echo "</table></div>";
 }
?>
  
</div>
</body>
 
 </html>