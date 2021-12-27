<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) 
  {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout']))
   {
	$usern=$_SESSION['username'];
	$db = mysqli_connect('localhost', 'root', '', 'training project');
	$sql = "UPDATE 'users' SET 'status'=0 WHERE 'username'='$usern'";
	$result = $db->query($sql);
  	session_destroy();  //destroy session if user clicks on Logout
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
		<a href = "game.php">
    
		<button type="button" class="homepagebutton" style="margin-bottom: 20px"  >Click Here to Start the Game !</a>
		<br>
		<button type="button" class="homepagebutton" style="margin-bottom: 20px" >Click Here to View LeaderBoard</button>
        <a href = "showdetail.php">
		<br>
		<button type="button" class="homepagebutton"  style="margin-bottom: 20px">Click Here to View Profile !</button></a>
	    </br>
    	<p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
	
   <?php endif ?>
</div>
</body>
</html>