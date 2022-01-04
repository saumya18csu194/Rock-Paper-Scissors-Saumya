<?php

include 'server.php';
error_reporting(E_ERROR | E_PARSE);
$usern=$_SESSION['username'];
$sql = "SELECT * FROM users WHERE username='$usern' ";

$result = mysqli_query($db, $sql);
if ($result->num_rows > 0) {

 $row = mysqli_fetch_assoc($result);
 //retrieve user details from database and store
 $_SESSION['username'] = $row['username'];
 $_SESSION['email'] = $row['email'];
 $_SESSION['Age'] = $row['Age'];
 $_SESSION['score'] = $row['score'];
 $_SESSION['total_match'] = $row['total_match'];
 $_SESSION['login_time'] = $row['login_time'];
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/styleshowdetail.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>



<div id="card">
<header>
<h1>USER PROFILE</h1>
</header>
<img class="profile" src="../pictures/images.png" width="90"><br>

   <div class="name-header"><?php echo $_SESSION['username'];?></div>  <!-- Display Username -->
 
   <div id="name"><?php echo $_SESSION['email'];?></div>  <!-- Display Email -->
  
   <br>

   <div id="new">AGE : <?php echo $_SESSION['Age'];?></div>     <!-- Display Age -->
   <div id="divider"></div>
   <div id="new">SCORE : <?php echo $_SESSION['score'];?></div> <!-- Display Score -->
   <div id="divider"></div>
   <div id="new">MATCHES PLAYED : <?php echo $_SESSION['total_match'];?></div> <!-- Display Score -->
   <div id="divider"></div>

<a href="changepassword.php" style="font-size: 20px"  >Change Password</a>  <!-- Redirect to Change Password Page -->

<br>
</br>
<div class="buttonback">
       
       <a href="index.php" ><button class="btn"><i style="font-size:42px;color:black">&#129072;</i></button></a>
           </div>  <!-- Redirect to Home Page -->
</body>
</html> 
