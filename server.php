<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'training project');  #mysqli_connect(host, username, password, dbname)
/*
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200))
{  
  session_unset();    
  session_destroy();   
  header('location: login.php');
}
else{
  $usern = $_SESSION["username"];
  $_SESSION['LAST_ACTIVITY'] = time();
  $sql = "UPDATE users SET 'login_time'=current_timestamp(), 'status'=true WHERE 'username'='$usern'";
  $result = $db->query($sql);

  $db->close();
}
*/
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']); # mysqli_real_escape_string escapes special characters in a string 
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);  
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);   #confirm password
  $age=mysqli_real_escape_string($db, $_POST['age']); 

  

  // Form validation: To ensure that the form is correctly filled 
  
  if (empty($username)) { array_push($errors, "Username is required"); }  //adding (array_push()) corresponding error unto $errors array
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){array_push($errors, "E-mail is not valid");}
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($age)) { array_push($errors, "Age is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  //Regex for Minimum eight characters, at least one uppercase letter, one lowercase letter and one number:
 //$pattern="#^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]).{8,32}$#";
 
  if(preg_match("#(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}#", $password_1)!=1) {array_push($errors, "Password requires minimum eight characters, at least one uppercase letter, one lowercase letter and one number");}
 
  if ($password_1 != $password_2) 
  {
	array_push($errors, "The two passwords do not match");
  }



  // first check the database to make sure a user does not already exist with the same username or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1"; #maximum number of rows to return from the beginning LIMIT set to 1
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = password_hash($password_1,PASSWORD_DEFAULT);//encrypt the password before saving in the database

  //	$query = "INSERT INTO 'users' (username, email,password,age,login_time,status) 
  			//  VALUES('$username', '$email', '$password','$age',current_timestamp(),'1')";
    $query="INSERT INTO `users`(`username`, `email`, `password`, `Age`, `login_time`) VALUES ('$username','$email','$password','$age',current_timestamp())";
    $result=mysqli_query($db, $query);
    
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}


if (isset($_POST['login_user']))
 {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password1 = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password1)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) // if no errors encountered
  {
    #$password = password_hash($password,PASSWORD_BCRYPT);
    
  	$query = "SELECT password FROM users WHERE username='$username'" ;
    #$results = mysqli_query($db, $query);
    $results = $db->query($query);
    if($results->num_rows==0){

      $db->close();

      die("User doesn't exist!!");

  }
    #$row = mysql_fetch_array($results);
    $verify=password_verify($password1,mysqli_fetch_array( $results )['password']);

  	
  	
    
    if($verify)
      {
      
  	  $_SESSION['username'] = $username;
  	 
      $usern=$_SESSION['username'];
      $sql_active="UPDATE `users` SET `status`='1' WHERE username='$usern' ";
      $result_active = mysqli_query($db, $sql_active);
  	  header('location: index.php');
      
  	  }
    else 
    {
  		array_push($errors, "Wrong username/password ");
  	}
  }
}

if (isset($_POST['change'])) 
{
  $currentpwd = mysqli_real_escape_string($db, $_POST['password']);
  $newpwd = mysqli_real_escape_string($db, $_POST['newpassword']);

  if (empty($currentpwd)) {
  	array_push($errors, "Old Password is required");
  }
  if (empty($newpwd)) {
  	array_push($errors, "New Password is required");
  }
  $username =$_SESSION['username'];/* userid of the user */

$oldpass = "";

$query = "SELECT password FROM users WHERE username='$username'" ;
#$results = mysqli_query($db, $query);
$results = $db->query($query);
if($results->num_rows==0){

    $db->close();

    die("User doesn't exist!!");

}
  
#$row = mysql_fetch_array($results);
$password1=$_POST['password'];
$passwordnew=$_POST['newpassword'];
$passwordnewconfirm=$_POST['newconfirmpassword'];
$verify=password_verify($password1,mysqli_fetch_array( $results )['password']);
$npassword = password_hash($_POST['newpassword'],PASSWORD_DEFAULT);


if(preg_match("#(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}#", $passwordnew)!=1) {array_push($errors, "Password requires minimum eight characters, at least one uppercase letter, one lowercase letter and one number");}


if ($verify )
{
  if ($passwordnew!=$passwordnewconfirm) 
{
array_push($errors, "The two passwords do not match");
}
else
{
mysqli_query($db,"UPDATE users set password='" . $npassword . "' where username= '$username' ");

echo "<script >alert('Password Changed') </script>";
$_SESSION['success'] = "Password Changed";
header('location: index.php');
}}
else
{
  array_push($errors, "Original Password is not correct");
}
}
?>