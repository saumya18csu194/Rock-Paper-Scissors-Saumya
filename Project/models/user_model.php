<?php
require_once('config.php');
class user extends database                                         // table name users ,using db variable from database class
{

    function get_count($email)              //to check if number of count of users with entered email
    {
        $email_exist="SELECT COUNT(*) FROM users where email='$email'";
        $countemail_query=mysqli_query($conn, $email_exist) or die( mysqli_error($conn));
        $row_email=mysqli_fetch_assoc($countemail_query);
        return $row_email['COUNT(*)'];
    }

    function get_password($email)          //fetch password from email
    {
        $sql1 = "SELECT password FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql1);
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];
        return $password;
    }
}


?>