<?php
session_start();

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>cafe website</title>
    <link rel="stylesheet" href="stylesheet1.css">
  </head>
  <body>
 <button id ="button" onclick="document.location.href='login.php';">SignIn </button>
 <form action="usersdbsignup.php" method="post">
 <div id = "container">
 <label id = "title">Name </label>
 <input id = "input" type ="text" placeholder="enter your name" name="username" required>
 <label id = "title">Password </label>
 <input id = "input" type ="text" placeholder="enter your password" name="password" required>
 <button type ="submit" id="button" > SingUp </button>
 </div>
 <form>

  </body>
 
</html>