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
	<link rel="stylesheet" type="text/css" href="style.css">
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
    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Hi,  <strong><?php echo $_SESSION['username']; ?></strong></p>
		<a href = "game.php">
    <div>
		<button type="button" class="homepagebutton" style="margin-bottom: 20px"  >Click Here to Start the Game !</a>
		<a href = "leaderboard.php">
		<button type="button" class="homepagebutton" style="margin-bottom: 20px" >Click Here to View LeaderBoard</button></a>
        <a href = "showdetail.php">
		<button type="button" class="homepagebutton"  style="margin-bottom: 20px">Click Here to View Profile !</button></a>
    	<p> <a href='logout.php' style="color: red;">Logout</a> </p>
	</div>
   <?php endif ?>
</div>
</body>
</html>
<script>

var userOnline = setInterval(function () {
    $.get("backend/userOnline.php");
}, 1000);

</script>