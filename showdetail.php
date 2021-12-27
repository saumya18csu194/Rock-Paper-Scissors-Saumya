<?php



include 'server.php';


$usern=$_SESSION['username'];
$sql = "SELECT * FROM users WHERE username='$usern' ";

$result = mysqli_query($db, $sql);
if ($result->num_rows > 0) {

 $row = mysqli_fetch_assoc($result);
 $_SESSION['username'] = $row['username'];
 $_SESSION['email'] = $row['email'];
 $_SESSION['Age'] = $row['Age'];
}


?>

<html>

<head>

 <title>details</title>


 <link rel="stylesheet" type="text/css"

  href="style.css">

</head>

<style>

 body{



background-size: cover;

background-attachment: fixed;

 }



 .content{

background: #727a8f;

;

width: 50%;

padding: 30px;

 margin: 10px auto;

font-family: calibri;

border-radius: 8px;

 opacity: 80%;

}



 p{

 font-size: 25px;

 color: black;

 }

table {

 margin: 0 auto;

 font-size: large;

 border: 1px solid black;

 }



 h1 {

 text-align: center;

 color: #006600;

font-size: xx-large;

font-family: 'Gill Sans', 'Gill Sans MT',

' Calibri', 'Trebuchet MS', 'sans-serif';
}



td {

 background-color: #E4F5D4;
 border: 1px solid black;

 }



 th,

 td {

 font-weight: bold;

 border: 1px solid black;

padding: 10px;

 text-align: center;

 }



 td {

font-weight: lighter;

}



 </style>

<body>

<br><br><br>

<div class="content">


<h1>YOUR DETAILS</h1>

<br><br>



<TABLE>

 <TR>

<TD><h4>User Name</h4></TD>

 <TD><?php echo $_SESSION['username'];?></TD>

</TR>

<TR>

 <TD><h4>Email address</h4></TD>

<TD><?php echo $_SESSION['email'];?></TD>

</TR>

<TR>

 <TD><h4>Age</h4></TD>

 <TD><?php echo $_SESSION['Age'];?></TD>

</TR>

</TABLE>
<br>
Change Password <a href="changepassword.php">Change Password</a> 
</p>
<p>
Go back<a href="index.php">Home Page</a> 

</div>

</body>

</html>
