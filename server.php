<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'training project');  #mysqli_connect(host, username, password, dbname)



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

  	$query = "INSERT INTO users (username, email,password,age) 
  			  VALUES('$username', '$email', '$password','$age')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// LOGIN USER

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
  	  $_SESSION['success'] = "You are now logged in";
      $_SESSION['LAST_ACTIVITY']=time();
      $id=$_SESSION["uid"];
      $sql = "SELECT * FROM `bloggerpost`.`users_activity` WHERE `user_id`='$id'";
       $result = $con->query($sql);
      if($result->num_rows==0){
      $sql = "INSERT INTO `bloggerpost`.`users_activity` (`user_id`, `last_access_At`, `is_online`) VALUES ('$id',current_timestamp(), true);";
      $result = $con->query($sql);
      if($result == true){
       echo "<script> location.href='index.php'; </script>";
                  }

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
$verify=password_verify($password1,mysqli_fetch_array( $results )['password']);
$npassword = password_hash($_POST['newpassword'],PASSWORD_DEFAULT);
  
if ($verify)
{
mysqli_query($db,"UPDATE users set password='" . $npassword . "' where username= '$username' ");
$_SESSION['success'] = "Password Changed";
}
else
{
  array_push($errors, "Password is not correct");
}
}
?>