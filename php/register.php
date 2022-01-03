
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>"  required>  <!-- All compulsory fields -->
    </div>
	<div class="input-group">
  	  <label>Age</label>
  	  <input type="number" name="age" min="10" max="100" required>    
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?> "required>
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$" required>  <!-- Regex for password match -->
		<span class="tooltip" data-tooltip="Password should be at least 8 characters and include a capital letter and symbols">?</span>
           
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2" required>  <!-- Re-enter password -->
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>  
  	</div>
  	<p>
  		Already a member? <a href="login.php"style="color:black">Sign in</a>   <!-- Redirect to login page if user wants to login rather than register -->
  	</p> 
  </form>
</body>
</html>
