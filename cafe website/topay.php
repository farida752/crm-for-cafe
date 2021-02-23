<?php
//print_r($_GET);
//echo $_GET['id'];
include_once 'dbconnection.php';
date_default_timezone_set("Egypt");
$date= date("Y/m/d")." ". date("h:i:sa");

$invoiceid = $_GET['id'];
$sqlUpdate="UPDATE customers SET state= '".$date."' WHERE id = ".$invoiceid." ;";
mysqli_query($conn,$sqlUpdate);

echo "<script> alert('WAIT!! The Invoice Is To Be Paid') </script>;";
header('Refresh: 2; URL=customers.php');