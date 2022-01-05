<?php 
require_once("../models/config.php")
require_once("../controllers/login_valid.php")
require_once("../models/login_models.php")
session_start();
if($_SERVER['REQUEST_METHOD']=="POST")
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    $valid=n
}



?>
<!DOCTYPE html>
<html>
<head>
  <title>PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2> 
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" required>
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password" required> 
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not a member yet? <a href="register.php"style="color:black">Sign up</a> <!-- Redirect to Register Page -->
  	</p>
  </form>
</body>
</html>