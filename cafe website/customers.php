<?php
session_start();
include_once 'dbconnection.php';
date_default_timezone_set("Egypt");
if($_SERVER['REQUEST_METHOD']=='POST'){
  /* $sqlupdate="UPDATE customers SET state = 'done' WHERE fullname =?;"; /*AND contactnumber = ? AND productname  = ? AND 
   qty  = ? AND duedate  = ? ;";*//*
 
 $stmt = mysqli_stmt_init($conn);
 if(!mysqli_stmt_prepare($stmt,$sqlupdate)){
    echo "The statement failed";
 }else{
   //date("Y/m/d")." ".date("h:i:sa")
     mysqli_stmt_bind_param($stmt,"s",$rows['fullname']/*,$rows['contactnumber']
 ,$rows['productname'],$rows['qty'],$rows['duedate']*//*);
    mysqli_stmt_execute($stmt);
    $GLOBALS['result']= mysqli_stmt_get_result($stmt);
}}*/
//echo $_SESSION['invfullname'];
}
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
     <label id="titles" onclick="document.location.href='products.php';" > Products </label>
     <img src="customers.png">
     <label id="titles" onclick="document.location.href='customers.php';" style='background:rgba(255, 235, 205, 0.356)'> Customers </label>
     <img  src="supplier.png">
     <label id="titles" onclick="document.location.href='suppliers.php';">Suppliers </label>
    
</div>

<div id="main-page">
    <div id="page-header">
    <img  src="customers.png">
    <h1 id="page-title"> Customers Invoices</h1>
    </div>

    <div id="page-info">
    <h2 > <?php 
    $count="SELECT count(id) FROM  customers ;";
    $res=mysqli_query($conn,$count);
    $rows=mysqli_fetch_assoc($res);
    echo "Total Number Of Customers Invoices: ".$rows['count(id)'];?> </h2>
    
    </div>
   <div id = "row2">
       <form id="form-search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="text" id="search-field" placeholder="Search for invoice" name="searchfield" style="margin-bottom:20px;">
</form>

   
</div>
<div id="tablediv">
<table id="tablemain">
  <tbody>
    <tr>
        <th> ID</th>
        <th> Full Name </th>
        <th> Contact Number </th>
        <th> Product Name </th>
        <th> QTY </th>
        <th> Total  </th>
        <th> Due Date  </th>
        <th> selling Date  </th>
        <th> Waiter Name   </th>
        <th> State   </th>
        <th> Action  </th>
       
</tr>
<?php

if(!isset($_POST['searchfield'])||$_POST['searchfield']==""){
    $GLOBALS['sql']="SELECT * FROM  customers ;";
    $GLOBALS['result']=mysqli_query($conn,$GLOBALS['sql']);
}else{
   // echo $_POST['searchfield'];
//There  is a word to search
$sql="SELECT * FROM customers WHERE fullname =? OR contactnumber =? OR productname =? OR qty =? 
  OR total =? OR duedate =? OR waitername =?;";

$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
   echo "The statement failed";
}else{
    mysqli_stmt_bind_param($stmt,"sssssss",$_POST['searchfield'],$_POST['searchfield'],$_POST['searchfield']
    ,$_POST['searchfield'],$_POST['searchfield'],$_POST['searchfield'],$_POST['searchfield']);
    

   mysqli_stmt_execute($stmt);
   $GLOBALS['result']= mysqli_stmt_get_result($stmt);
 
}
}

 if(mysqli_num_rows($GLOBALS['result'])>0){
   $var=array();
while($rows=mysqli_fetch_assoc($GLOBALS['result'])){

    echo 
    "<tr> <td class='row-data'>".$rows['id']."</td> <td class='row-data'>".$rows['fullname']."</td> <td class='row-data'>".
    $rows['contactnumber']."</td> <td class='row-data'>".
    $rows['productname']."</td> <td class='row-data'>".
    $rows['qty']."</td> <td class='row-data'>".
    $rows['total']."</td> <td class='row-data'>".
    $rows['duedate']."</td> <td class='row-data'>".
    $rows['sellingdate']."</td> <td class='row-data'>".
    $rows['waitername']."</td> <td class='row-data'>".
    $rows['state']."</td> <td class='row-data'>";

    
    
    if($rows['state']=='Unpaid'){
      
      echo "<input type='submit'value='Pay' name='pay' style='background-color:green; color:white; border-radius:15px; font-family:cursive;' >"."</td> </tr>";
  
    }else{
      echo "Done"."</td> </tr>";
    }
    
  }
  
    echo "</table></tbody></div>";
 }
 
 
?>
  
</div>
<script> 
            
               var thetable= document.getElementById('tablemain').getElementsByTagName('tbody')[0];
                for(var i =0 ; i<thetable.rows.length;i++){
                      thetable.rows[i].onclick=function() {
                       TableRowClick(this);
                      };
                }
                
            function TableRowClick(therow){
              localStorage["id"] = therow.cells[0].innerHTML;
              localStorage["fullname"] = therow.cells[1].innerHTML;
              localStorage["contactnumber"] = therow.cells[2].innerHTML;
              localStorage["productname"] = therow.cells[3].innerHTML;
              localStorage["qty"] = therow.cells[4].innerHTML;

              localStorage["total"] = therow.cells[5].innerHTML;
              localStorage["duedate"] = therow.cells[6].innerHTML;
              localStorage["sellingdate"] = therow.cells[7].innerHTML;
              localStorage["waitername"] = therow.cells[8].innerHTML;
              localStorage["state"] = therow.cells[9].innerHTML;
             document.location.href='invoice.php';
            };
          
        </script> 
</body>
 
 </html>


        
