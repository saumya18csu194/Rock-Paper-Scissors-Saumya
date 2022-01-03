<?php 
  session_start(); 
  if (!isset($_SESSION['username'])) 
  {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div class="header">
	<h1>ROCK  PAPER  SCISSORS</h1>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>
    
    <?php  if (isset($_SESSION['username'])) : ?>
    <div class="animation">	
		<p>Hi,  <strong><?php echo $_SESSION['username']; ?></strong></p> <!-- logged in user information -->
	</div>
		<a href = "game.php"> <!-- Start game on user click  -->
    <div>
		<button type="button" class="homepagebutton" style="margin-bottom: 20px"  >Click Here to Start the Game !</a>
		<a href = "leaderboard.php"> 
		<button type="button" class="homepagebutton" style="margin-bottom: 20px" >Click Here to View LeaderBoard</button></a>
        <a href = "showdetail.php">
		<button type="button" class="homepagebutton"  style="margin-bottom: 20px">Click Here to View Profile !</button></a>
    	<p> <a href='logout.php' style="color: black;">Logout</a> </p> <!-- Go to logout page -->
	</div>
   <?php endif ?>
</div>
</body>
</html>