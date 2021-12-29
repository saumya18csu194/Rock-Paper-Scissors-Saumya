
<?php
session_start();
include 'server.php';
if(isset($_SESSION['username'])){
    $usern=$_SESSION['username'];
    $sql_active="UPDATE `users` SET `status`='0' WHERE username='$usern' ";
    $result_active = mysqli_query($db, $sql_active);
    session_destroy();   // function that Destroys Session 
    header("Location: Login.php");
  }
  else{
   header("Location: Login.php");
  }
?> 

