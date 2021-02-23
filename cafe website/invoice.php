<?php
session_start();
include_once 'dbconnection.php';

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>cafe website</title>
   
    <head>
    <meta charset="utf-8">
    <title>cafe website</title>
    <link rel="stylesheet" href="stylesheet2.css">
    <link rel="stylesheet" href="invoicestyle.css">
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
<div id="maininvoice">
    <h1 id=title> INVOICE </h1>
    <h4 id="info">Invoice info </h4>
    <table>
    <tr>
        <th> Invoice#</th>
        <th> Selling date </th>
        <th> Expiry date </th>      
</tr>
   <tr>
       <td id="id"></td>
       <td id="sellingdate"></td>
       <td id="duedate"></td>  
</tr> 
</table>

<h4 id="info">Customer info </h4>
<table>
    <tr>
        <th> Customer Name</th>
        <th> Contact Number </th>
            
</tr>
   <tr>
       <td id="fullname"></td>
       <td id="contactnumber"></td> 
</tr> 
</table>

<h4 id="info">Details </h4>
<table>
    <tr>
        <th> product Name</th>
        <th> QTY </th>
        <th> Total </th>  
        <th> Waiter Name </th>      
</tr>
   <tr>
       <td id="productname"></td>
       <td id="qty"></td>
       <td id="total"></td>  
       <td id="waitername"></td> 
</tr> 
</table>

<button id="doaction" onclick="doAction()"></button>

 <script>
     //alert(localStorage["sellingdate"]);
             document.getElementById("id").innerHTML = localStorage["id"];
     
             document.getElementById("fullname").innerHTML = localStorage["fullname"] ;
             document.getElementById("contactnumber").innerHTML = localStorage["contactnumber"] ;
             document.getElementById("productname").innerHTML = localStorage["productname"]; 

              document.getElementById("qty").innerHTML = localStorage["qty"] ;

              document.getElementById("total").innerHTML = localStorage["total"] ;
              document.getElementById("duedate").innerHTML = localStorage["duedate"] ;
              document.getElementById("sellingdate").innerHTML = localStorage["sellingdate"] ;
              document.getElementById("waitername").innerHTML = localStorage["waitername"] ;

              if(localStorage["state"]=="Unpaid"){
              document.getElementById("doaction").innerHTML = "PayInvoice";
              }else{
                document.getElementById("doaction").innerHTML = "Paid at "+localStorage["state"];
              }
             doAction=function(){
                 if(localStorage["state"]=="Unpaid"){
                     //var state= localStorage["state"];
                     var id= localStorage["id"];
                     var scr = "topay.php";
                     //scr += "?state="+ state;
                     scr += "?id=" + id;
                     src = encodeURI(scr);
                     window.location.href = src;
                 }else{
                     alert("This Invoice already Paid");
                 }
             }
             
     </script>
  </body>
</html>