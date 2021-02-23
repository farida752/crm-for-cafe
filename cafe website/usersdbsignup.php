<?php
session_start();
include_once 'dbconnection.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
$_SESSION['username'] = $_POST['username']; 
$_SESSION['password'] = $_POST['password']; 



   //if the session is signup we need to insert into the db

   $name = mysqli_real_escape_string($conn,$_SESSION['username']);
   $password = mysqli_real_escape_string($conn,$_SESSION['password'] );

   $sql="INSERT INTO users VALUES ('$name','$password');";
   if(!mysqli_query($conn,$sql)){
      echo "<script>alert('You already have an account try to sign in instead ')</script>;";
   }else{
   header("Location: home.php");}


}
?>