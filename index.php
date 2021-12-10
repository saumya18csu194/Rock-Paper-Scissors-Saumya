<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
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
	<h2>Home Page</h2>
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
    	<p>Welcome to Rock Paper Scissor Game  <strong><?php echo $_SESSION['username']; ?></strong></p>
		<button type="button" class="btn" style="margin-bottom: 30px"  >Click Here to Start the Game !</button>

		<button type="button" class="btn" style="margin-bottom: 30px" >Click Here to View Active Players !</button>

		<button type="button" class="btn"  style="margin-bottom: 30px">Click Here to View LeaderBoard !</button>
         <a href = "changePassword.php">
		<button type="button" class="btn"  style="margin-bottom: 30px">Click Here to Change Password !</button></a>



    	<p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
    <?php endif ?>
</div>
</body>
</html>