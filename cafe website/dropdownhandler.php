<?php
include_once 'dbconnection.php';

   $productsSql="SELECT * FROM products;";
   $productsResult=mysqli_query($conn,$productsSql);
   $productsnames=array();
   while($productsRows=mysqli_fetch_assoc($productsResult)){
    array_push($productsnames,$productsRows['genericname']);
   }

   $GLOBALS['stmt'] = mysqli_stmt_init($conn);
   function productRelated($productname){
   $sql="SELECT * FROM products WHERE genericname =?;";
   
   if(!mysqli_stmt_prepare($GLOBALS['stmt'],$sql)){
      echo "the statement failed";
   }else{
      mysqli_stmt_bind_param($GLOBALS['stmt'],"s",$productname);
      mysqli_stmt_execute($GLOBALS['stmt']);
      $result=mysqli_stmt_get_result($GLOBALS['stmt']);

      while($row=mysqli_fetch_assoc($result)){
          $GLOBALS['sellingprice']=$row['sellingprice'];
          $GLOBALS['category']=$row['category'];
          $GLOBALS['originalprice']=$row['originalprice'];
          $GLOBALS['qtyleft']=$row['qtyleft'];
          $GLOBALS['id']=$row['id'];
          $GLOBALS['brandname']=$row['brandname'];
          $GLOBALS['supplier']=$row['suppllier'];

          $GLOBALS['datereceived']=$row['datereceived'];
          $GLOBALS['expirydate']=$row['expirydate'];

          $GLOBALS['qtypro']=$row['qty'];
          
      }}
     

   }

   $supplierSql="SELECT * FROM suppliers;";
   $supplierResult=mysqli_query($conn,$supplierSql);
   $suppliersnames=array();
   while($supplierRows = mysqli_fetch_assoc($supplierResult)){
      array_push( $suppliersnames, $supplierRows['supplier'] );
      
   }
?>