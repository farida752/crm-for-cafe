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
     <label id="titles" onclick="document.location.href='sales.php';" style='background:rgba(255, 235, 205, 0.356)'> Sales </label>
     <img  src="storage.png">
     <label id="titles" onclick="document.location.href='products.php';"> Products </label>
     <img src="customers.png">
     <label id="titles" onclick="document.location.href='customers.php';"> Customers </label>
     <img  src="supplier.png">
     <label id="titles" onclick="document.location.href='suppliers.php';">Suppliers </label>
    
</div>

<div id="main-page">
    <div id="page-header">
    <img  src="sales.png">
    <h1 id="page-title"> Daily Sales </h1>
    </div>
    <div id="page-info">
    <h2 ></h2>
    </div>
   
   <div id = "row2">
       <form id="form-search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="text" id="search-field" placeholder="Search for sale" name="searchfield" >
</form>

    <div id= "add-product" onclick="document.location.href='addsales.php'">
    <img  id="icon" src="plus.png">
    <label id="label">AddSales </label>
    </div>
</div>
<div id="tablediv">
<table>
    <tr>
        <th> Product Name </th>
        <th> Category  </th>
        <th> QTY </th>
        <th> Price </th>
        <th> Profit </th>
        <th> Paid/Invoice </th>
        <th> Date</th>
        <th> Waiter Name</th>
        
        
</tr>
<?php

if(!isset($_POST['searchfield'])||$_POST['searchfield']==""){
  $todaydate= date("Y/m/d");
    $GLOBALS['sql']='SELECT * from sales WHERE date >= "'.$todaydate.'";';
    $GLOBALS['result']=mysqli_query($conn,$GLOBALS['sql']);
}else{
   // echo $_POST['searchfield'];
//There  is a word to search
$sql="SELECT * FROM sales WHERE productname =? OR category =? OR price =? OR qty =? 
  OR profit =? OR paid/invoice =? OR date =? OR waitername =? ;";

$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
   echo "The statement failed";
}else{
    mysqli_stmt_bind_param($stmt,"ssssssss",$_POST['searchfield'],$_POST['searchfield'],$_POST['searchfield']
    ,$_POST['searchfield'],$_POST['searchfield'],$_POST['searchfield'],$_POST['searchfield'],
    $_POST['searchfield']);
    

   mysqli_stmt_execute($stmt);
   $GLOBALS['result']= mysqli_stmt_get_result($stmt);
  
}
}

 if(mysqli_num_rows($GLOBALS['result'])>0){
while($rows=mysqli_fetch_assoc($GLOBALS['result'])){
    echo 
    "<tr> <td>".$rows['productname']."</td> <td>".
    $rows['category']."</td> <td>".
    $rows['qty']."</td> <td>".
    $rows['price']."</td> <td>".
    $rows['profit']."</td> <td>".
    $rows['paidORinvoice']."</td> <td>".
    $rows['date']."</td> <td>".
    $rows['waitername']."</td> </tr>";}
    echo "</table></div>";
 }
?>
  
</div>
</body>
 
 </html>