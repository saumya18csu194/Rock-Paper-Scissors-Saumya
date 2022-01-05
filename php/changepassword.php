<?php include('server.php');?>

<!DOCTYPE html>
<html>
<head>
  <title> PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
  <div class="header">
  	<h2>Change Password</h2> 
  </div>
	 
  <form method="post" action="changepassword.php">
  	<?php include('errors.php'); ?>       
  	<div class="input-group">
  		<label>Old Password</label>
  		<input type="password" name="password"  required>
  	</div>
  	<div class="input-group">
  		<label>New Password</label>
  		<input type="password" name="newpassword" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$" required><!-- Regex pattern for at least 8 characters and include a capital letter and symbols-->
  	</div>
  	<div class="input-group">
  		<label>Confirm New Password</label>
  		<input type="password" name="newconfirmpassword"  required>
  	</div>	
  	<div class="input-group">
  		<button type="submit" class="btn" name="change" >Change Password</button>
  	</div>
	  <p>
  			 <a href="showdetail.php">Go Back</a> <!-- Redirect to Home Page -->
  </form>
</body>
</html>