<?php include('server.php');


$username =$_SESSION['username'];/* userid of the user */

$oldpass = "";

if(count($_POST)>0) {
$result = mysqli_query($db,"SELECT password from Users where username= '$username' ");
$row=mysqli_fetch_array($result);
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        $oldpass = $row['password'];

    }

}
if($_POST["newpassword"] == $oldpass  )
{
mysqli_query($db,"UPDATE Users set password='" . $_POST["newPassword"] . "' where username= '$username' ");

$message = "Password Changed Sucessfully";
}
else{
 $message = "Password is not correct";
}
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Change Password</h2> 
  </div>
	 
  <form method="post" action="changePassword.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Old Password</label>
  		<input type="password" name="password" >
  	</div>
  	<div class="input-group">
  		<label>New Password</label>
  		<input type="password" name="newpassword">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="change">Change Password</button>
  	</div>

  </form>
</body>
</html>