<?php
session_start();
include_once 'dbconnection.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
$_SESSION['username'] = $_POST['username']; 
$_SESSION['password'] = $_POST['password']; 


//if the session is signin we need to search the db for the session

    echo "hi from the session state sign in";
    $sql="SELECT * FROM users WHERE name =? AND password =?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
       echo "the statement failed";
    }else{
       mysqli_stmt_bind_param($stmt,"ss",$_SESSION['username'] ,$_SESSION['password']);
       mysqli_stmt_execute($stmt);
       $result=mysqli_stmt_get_result($stmt);

     // $result=mysqli_query($conn,$sql);
       while($row=mysqli_fetch_assoc($result)){
           echo $row['name'];
       }
       //check if it doesnot exist
       if(mysqli_num_rows($result)==0){
           echo "Name or password is wrong";
           echo mysqli_num_rows($result);
       }else{
           
           header("Location: home.php");
       }

    }
}
?>