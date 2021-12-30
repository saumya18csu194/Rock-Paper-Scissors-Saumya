<?php

include 'server.php';

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
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
 body {
   font-family: Mali;
   background
   padding: 48px;
   text-align: center;
   color: black;
   background-image: url('pictures/wallpaper.jpeg') ;
}

#card {
   

   border-radius: 6px;
   display: inline-block;
   box-shadow: 8px 20px 25px rgba(33, 12, 12, 1);
   width: 483px;
   padding-top: 15px;
   padding-bottom: 15px;
   padding-left: 13px;
   padding-right: 13px;
   background-color: cadetblue;
   color:black;
}
h2 
{
    background-color: beige;
    width: 30%;
    margin: auto;
}
.profile {
   
   padding: 5px;
   border-radius: 4px;
}

.name-header {
   font-size: 36px;
   font-weight: 700;
}

#name {
   font-family: Mali;
   color: white;
   font-weight: 200;
}

#new {
   font-size: 29px;
}

#divider {
   border-top: 1.3px solid darkgray;
   margin-top: 5px;
   margin-bottom: 5px;
   width: 456px;
   text-align: center;
   display: inline-block;
}

.preview {
   text-decoration: none;
   font-size: 15px;
   color: white;
   font-family: "Comic Neue", sans-serif;
   padding: 4px 8px 4px 8px;
   border-radius: 6px;
}

.material-icons-two-tone {
   font-family: "Material Icons Two Tone";
   font-weight: normal;
   filter: invert(0.3) sepia(1) saturate(6) hue-rotate(321deg);
   font-style: normal;
   flex-direction: row;
   font-size: 28px;
   display: inline-block;
}

</style>
</head>
<body>
<br><br>
<h2>USER PROFILE</h2>
<br><br>
<div id="card"><img class="profile" src="pictures/images.png" width="90"><br>
   <div class="name-header"><?php echo $_SESSION['username'];?></div>  <!-- Display Username -->
 
   <div id="name"><?php echo $_SESSION['email'];?></div>  <!-- Display Email -->
   <br>

   <div id="new">AGE : <?php echo $_SESSION['Age'];?></div>     <!-- Display Age -->
   <div id="divider"></div>
   <div id="new">SCORE : <?php echo $_SESSION['score'];?></div> <!-- Display Score -->
   <div id="divider"></div>
  

<a href="changepassword.php" style="font-size: 20px" >Change Password</a>  <!-- Redirect to Change Password Page -->

<br>
</br>
<a href="index.php" style="font-size: 20px">Go back to Home Page</a>  <!-- Redirect to Home Page -->
</body>
</html> 
