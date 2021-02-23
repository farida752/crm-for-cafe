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
     <label id="titles" onclick="document.location.href='products.php';" '> Products </label>
     <img src="customers.png">
     <label id="titles" onclick="document.location.href='customers.php';" > Customers </label>
     <img  src="supplier.png">
     <label id="titles" onclick="document.location.href='suppliers.php';" style='background:rgba(255, 235, 205, 0.356)'>Suppliers </label>
    
</div>
<div id="main-page">
    <div id="page-header">
    <img  src="supplier.png">
    <h1 id="page-title"> Suppliers </h1>
    </div>

    <div id="page-info">
    <h2 > <?php 
    $count="SELECT count(id) FROM  suppliers ;";
    $res=mysqli_query($conn,$count);
    $rows=mysqli_fetch_assoc($res);
    echo "Total Number Of suppliers: ".$rows['count(id)'];?> </h2>
    
    </div>
   <div id = "row2">
       <form id="form-search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="text" id="search-field" placeholder="Search for supplier" name="searchfield" >
</form>

    <div id= "add-product" onclick="document.location.href='addsupplier.php'">
    <img  id="icon" src="plus.png">
    <label id="label">AddSupplier </label>
    </div>
</div>
<div id="tablediv">
<table>
    <tr>
        <th> Supplier </th>
        <th> Contact Person </th>
        <th> Address</th>
        <th> Contact Number </th>
        
</tr>
<?php

if(!isset($_POST['searchfield'])||$_POST['searchfield']==""){
    $GLOBALS['sql']="SELECT * FROM  suppliers ;";
    $GLOBALS['result']=mysqli_query($conn,$GLOBALS['sql']);
}else{
   // echo $_POST['searchfield'];
//There  is a word to search
$sql="SELECT * FROM suppliers WHERE supplier =? OR contactperson =? OR address =? OR contactnumber =?  ;";

$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
   echo "The statement failed";
}else{
    mysqli_stmt_bind_param($stmt,"ssss",$_POST['searchfield'],$_POST['searchfield'],$_POST['searchfield']
    ,$_POST['searchfield']);
    

   mysqli_stmt_execute($stmt);
   $GLOBALS['result']= mysqli_stmt_get_result($stmt);

}
}

 if(mysqli_num_rows($GLOBALS['result'])>0){
while($rows=mysqli_fetch_assoc($GLOBALS['result'])){
    echo 
    "<tr> <td>".$rows['supplier']."</td> <td>".
    $rows['contactperson']."</td> <td>".
    $rows['address']."</td> <td>".
    $rows['contactnumber']."</td> </tr>";}
    echo "</table></div>";
 }
?>
  
</div>
</body>
 
 </html>