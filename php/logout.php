
<?php
include 'server.php';
if(isset($_SESSION['username'])){
    $usern=$_SESSION['username'];
    $sql_active="UPDATE `users` SET status='0' WHERE username='$usern' "; //set status=0 if user clicks on logout
    $result_active = mysqli_query($db, $sql_active);
    session_destroy();   // function that Destroys Session 
    header("Location: Login.php");
  }

?> 

