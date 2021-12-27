<!DOCTYPE html>
<html>
<body>

<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'training project');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$usern= $_SESSION["username"];

$sql = "UPDATE 'users' SET `status`=0 WHERE 'username'='$usern'";
$result = $db->query($sql);

session_destroy();




$db->close();   
        ?> 



</body>
</html>