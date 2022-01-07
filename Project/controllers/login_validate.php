<?php


class login
{
    function check_email($email, $conn )                       //if valid email entered
    { 
        $flag = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$flag)   //if email not valid
        {
            echo '<script type ="text/JavaScript">';  
            echo 'alert("Enter valid email !!")';  
            echo '</script>';
        }
        else
        {
            $getemail=$this->get_email($email,$password ,$conn); 
        }
     
    }

    function get_email($email,$password,$conn)                   //if entered email matches with database records
    {
      $count=new user();
      $email=$count->get_count($email, $conn );
      if($email==1)
      {
         $var=$this->check_password($email,$password,$conn);
      }

    }

    function check_password($email,$password , $conn)                 //if email is correct,match password with database
    {
        $info= new user();
        $pass = $info->get_password($email,$conn); 
        $verify=password_verify($password,$pass); //hash new password
        if($verify)
              header("Location: homepage.php");
        else
            return false;      
    }
}
?>