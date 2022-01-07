<?php 
class database
{
    function estabilish_con()
    {
        $server = "localhost";
        $user = "root";
        $pass = "";
        $database = "training project";
        $conn = mysqli_connect($server, $user, $pass, $database);

        if ($conn)                //to check if connection exists
        {
            return $conn;
        } 
        else 
        {
            die("<script>alert('Connection Failed.')</script>");
        }
    }

}
?>