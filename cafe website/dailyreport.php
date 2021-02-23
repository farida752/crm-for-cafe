<?php
session_start();
include_once 'dbconnection.php';


if(!isset($_POST['searchfield'])||$_POST['searchfield']==""){
    $GLOBALS['day']= date("Y/m/d");
    $_SESSION['title']="Daily Report" ;}
else{
    $GLOBALS['day']=$_POST['searchfield'];
    $_SESSION['title']="Report From Day ".$_POST['searchfield']." Until Today";
}
$todaydate=$GLOBALS['day'];

//#total sales:
$totalSalesSql='SELECT count(id) FROM  sales WHERE date >= "'.$todaydate.'";';
$res1=mysqli_query($conn,$totalSalesSql);
$rows1=mysqli_fetch_assoc($res1);
$_SESSION['totalSales']=$rows1['count(id)'];



//#total money from paid sales :
$totalPaidSalesSql='SELECT sum(price) FROM sales WHERE  paidORinvoice = "Paid" AND date >= "'.$todaydate.'";';
$res2=mysqli_query($conn,$totalPaidSalesSql);
$rows2=mysqli_fetch_assoc($res2);
$_SESSION['totalPaidSales']=$rows2['sum(price)'];
if($_SESSION['totalPaidSales']==""){$_SESSION['totalPaidSales']=0;}

//#total new invoices 
$totalInvoicesSql='SELECT count(id) FROM sales WHERE  paidORinvoice = "Invoice" AND date >= "'.$todaydate.'";';
$res3=mysqli_query($conn,$totalInvoicesSql);
$rows3=mysqli_fetch_assoc($res3);
$_SESSION['totalInvoices']=$rows3['count(id)'];

//#total number of newly paid invoices :
$totalNumPaidInvoicesSql='SELECT count(id) FROM customers WHERE  state != "Unpaid" AND state >= "'.$todaydate.'";';
$res4=mysqli_query($conn,$totalNumPaidInvoicesSql);
$rows4=mysqli_fetch_assoc($res4);
$_SESSION['totalNumPaidInvoices']=$rows4['count(id)'];

//#total money gained from newly paid invoices:
$totalPaidInvoicesSql='SELECT sum(total) FROM customers WHERE  state != "Unpaid" AND state >= "'.$todaydate.'";';
$res5=mysqli_query($conn,$totalPaidInvoicesSql);
$rows5=mysqli_fetch_assoc($res5);
$_SESSION['totalPaidInvoices']=$rows5['sum(total)'];
if($_SESSION['totalPaidInvoices']==""){$_SESSION['totalPaidInvoices']=0;}

//#total number of newly added products:
$totalNewProductsSql='SELECT count(id) FROM products WHERE datereceived >= "'.$todaydate.'";';
$res6=mysqli_query($conn,$totalNewProductsSql);
$rows6=mysqli_fetch_assoc($res6);
$_SESSION['totalnewproducts']=$rows6['count(id)'];

//#total today ended products:
$totalEndedproductsSql='SELECT count(id) FROM endedproducts WHERE endeddate >= "'.$todaydate.'";';
$res7=mysqli_query($conn,$totalEndedproductsSql);
$rows7=mysqli_fetch_assoc($res7);
$_SESSION['totalEndedproducts']=$rows7['count(id)'];
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>cafe website</title>
    <link rel="stylesheet" href="stylesheet2.css">
    <link rel="stylesheet" href="report.css">
  </head>
  <body style="background: url('Coffee-beans-background.jpg') no-repeat center center fixed;
  background-size: cover;">
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
     <label id="titles" onclick="document.location.href='sales.php';"> Sales </label>
     <img  src="storage.png">
     <label id="titles" onclick="document.location.href='products.php';"> Products </label>
     <img src="customers.png">
     <label id="titles" onclick="document.location.href='customers.php';"> Customers </label>
     <img  src="supplier.png">
     <label id="titles" onclick="document.location.href='suppliers.php';">Suppliers </label>   
</div>
<div id="mainreport">
    <h1 id="title"><?php echo $_SESSION['title'] ;?> </h1>
    <h4 id="data"> <?php echo "Total number of sales = ".$_SESSION['totalSales'] ;?> </h4>
   
    <h4 id="data"> <?php echo "Total money gained from paid sales = ". $_SESSION['totalPaidSales']." L.E" ;?> </h4>
    
    <h4 id="data"> <?php echo "Total number of new invoices  =". $_SESSION['totalInvoices'] ;?> </h4>
   
    <h4 id="data"> <?php echo "Total number of newly paid invoices  =". $_SESSION['totalNumPaidInvoices'] ;?> </h4>
    <h4 id="data"> <?php echo "Total money gained from  newly paid invoices  =". $_SESSION['totalPaidInvoices']." L.E"  ;?> </h4>
    <h4 id="data"> <?php echo "Total money gained = ". $_SESSION['totalPaidInvoices'] + $_SESSION['totalPaidSales'] ." L.E" ;?> </h4>
   
    <h4 id="data"> <?php echo "Total newly added products = ". $_SESSION['totalnewproducts'];?> </h4>
   
    <h4 id="data"> <?php echo "Total number of today ended products = ". $_SESSION['totalEndedproducts'];?> </h4>

    
       <form id="form-search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
       <h4 id="info"> Enter the day you want to start the report from : </h3>
    <input type="text" id="search-field" placeholder="date on form yyyy/mm/dd " name="searchfield" onsearch="window.location.reload()" >
</form>
</div>
</body>
</html