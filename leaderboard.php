<?php
include 'server.php';
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'training project');
$usern=$_SESSION['username'];
// SQL query to select data from database
$sql = "SELECT * FROM users ORDER BY score DESC ";
$result=mysqli_query($db,$sql); 
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="UTF-8">
    <title>User Details</title>
<!-- CSS FOR STYLING THE PAGE BEGINS -->
<style>
         body 
        {
            background-image: url('pictures/wallpaper.jpeg') ;
            background-attachment: fixed;
        }
        table 
        {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
        h1
        {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT',' Calibri', 'Trebuchet MS', 'sans-serif';
            color: brown;
            background-color: beige;
            width: 40%;
            margin:auto;
        }
        td
        {
            background-color: white;
            border: 1px solid black;
        }
        th
        {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            background-color: black;
            color: white;
            font-size: x-large;
        }
        td 
        {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
  
        td
        {
            font-weight: lighter;
        }
</style> 
</head>
  
<body>
    <section>
        <div><h1>LEADERBOARD</h1></div>
        <!-- TABLE CONSTRUCTION-->
        <table>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Age</th>
                <th>Score</th>
                <th>Status</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
            <?php   // LOOP TILL END OF DATA 
                while($rows=$result->fetch_assoc())
                {
             ?>
            <tr>
                <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
                <td><?php echo $rows['username'];?></td>
                <td><?php echo $rows['email'];?></td>
                <td><?php echo $rows['Age'];?></td>
                <td><?php echo $rows['score'];?></td>
                <td><?php 
                
                if ($rows['status']==0)
                {
                    echo "<img src='pictures/offline.png' width=15px height=15px />";
                }
                else if ($rows['status']==1)
                {
                    echo "<img src='pictures/online.png' width=19px height=19px />";
                }
                ?></td>
            </tr>  
            <?php
                }
             ?>
             <a href="index.php">Go back</a>
        </table>
    </section>
</body>
</html>