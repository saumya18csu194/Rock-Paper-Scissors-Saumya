<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
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

  

  // Backend Form validation: To ensure that the form is correctly filled 
  
  if (empty($username)) { array_push($errors, "Username is required"); }  //adding (array_push()) corresponding error unto $errors array
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){array_push($errors, "E-mail is not valid");}
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($age)) { array_push($errors, "Age is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  
  if ($age <= 10 ||  $age >= 100 && preg_match(('[0-1]{1}[0-9]{0,2}'),$age)!=1) //if age is not correct
  {
  	array_push($errors, "Entered Age is wrong");
  }
  //Below is the regex for Minimum eight characters, at least one uppercase letter, one lowercase letter and one number:
  if(preg_match("#(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}#", $password_1)!=1) 
  {
    array_push($errors, "Password requires minimum eight characters, at least one uppercase letter, one lowercase letter and one number");
  }
 
  if ($password_1 != $password_2) //if password and confirm password don't match
  {
  	array_push($errors, "The two passwords do not match");
  }
  // first check the database to make sure a user does not already exist with the same username or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1"; #maximum number of rows to return from the beginning LIMIT set to 1
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['username'] === $username) // if user already exists
    {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) 
    {
      array_push($errors, "email already exists"); //if email already exists
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) 
  {
  	$password = password_hash($password_1,PASSWORD_DEFAULT);//encrypt the password before saving in the database
    $query="INSERT INTO `users`(`username`, `email`, `password`, `Age`, `login_time`) VALUES ('$username','$email','$password','$age',current_timestamp())"; 
    //In above code,  current timestamp is also saved in login_time 
    $result=mysqli_query($db, $query);  
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php'); //move to home page when user registers successfully
  }
}


if (isset($_POST['login_user']))
 {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password1 = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) 
  {
  	array_push($errors, "Username is required");
  }
  if (empty($password1)) 
  {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) // if no errors encountered
  {
  	$query = "SELECT password FROM users WHERE username='$username'" ;
    $results = $db->query($query);
    if($results->num_rows==0)
    {
      $db->close();
      die("User doesn't exist!!");
    }
    $verify=password_verify($password1,mysqli_fetch_array( $results )['password']); //verify that password entered by user is same as in db
    if($verify) //if true
      {  
  	  $_SESSION['username'] = $username;
      $usern=$_SESSION['username'];
      $sql_active="UPDATE `users` SET `status`='1' WHERE username='$usern' "; //set status=1 when user logins
      $result_active = mysqli_query($db, $sql_active);
  	  header('location: index.php'); //move to home page
  	  }
    else 
    {
  		array_push($errors, "Wrong username/password "); //
  	}
  }
}

if (isset($_POST['change']))  //Change Password Request
{
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $currentpwd = mysqli_real_escape_string($db, $_POST['password']);
  $newpwd = mysqli_real_escape_string($db, $_POST['newpassword']);

  if (empty($currentpwd)) {
  	array_push($errors, "Old Password is required");
  }
  if (empty($newpwd)) {
  	array_push($errors, "New Password is required");
  }
  

$oldpass = "";

$query = "SELECT password FROM users WHERE username='$username'" ;
$results = $db->query($query);
if($results->num_rows==0)
{
    $db->close();
    die("User doesn't exist!!");
}

$password1=$_POST['password'];
$passwordnew=$_POST['newpassword'];
$passwordnewconfirm=$_POST['newconfirmpassword'];
$npassword = password_hash($_POST['newpassword'],PASSWORD_DEFAULT);//hash new password


if(preg_match("#(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}#", $passwordnew)!=1)
 {
   array_push($errors, "Password requires minimum eight characters, at least one uppercase letter, one lowercase letter and one number");
 }

$verify=password_verify($password1,mysqli_fetch_array( $results )['password']);//verify if old password matches with database 
if ($verify )//if old pasword is correct
{
  if ($passwordnew!=$passwordnewconfirm) //if new password and confirm new password don't match
    {
      array_push($errors, "The two passwords do not match");
    }
  else //match succesfull
    {
      mysqli_query($db,"UPDATE users set password='" . $npassword . "' where username= '$username' "); //update database with new password
      echo "<script >alert('Password Changed') </script>";
      $_SESSION['success'] = "Password Changed";
      header('location: index.php');
    }
}
else //if old password is not correct
 {
  array_push($errors, "Original Password is not correct");
 }
}
?>