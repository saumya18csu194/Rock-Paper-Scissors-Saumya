<?php
include 'server.php';
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'training project');
$usern=$_SESSION['username'];
// SQL query to select data from database


$sql ="SELECT p.*, p.score/p.total_match as kdratio
FROM users p
ORDER BY kdratio DESC LIMIT 10 ";
$result=mysqli_query($db,$sql); 

?>
<!DOCTYPE html>
<html lang="en">
  <link rel="stylesheet" type="text/css" href="../css/styleleaderboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <header>
    <h1>TOP 10 LEADERBOARD</h1>
</header>
<article>
  
   
    <table class="leaderboard">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Age</th>
                <th>Score</th>
                <th>Matches</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
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
                <td><?php echo $rows['total_match'];?></td>
                <td><?php 
                
                if ($rows['status']==0)
                {
                    echo "<img src='../pictures/offline.png' width=17px height=17px />";
                }
                else if ($rows['status']==1)
                {
                    echo "<img src='../pictures/online.png' width=13px height=13px />";
                }
                ?></td>
            </tr>  
            <?php
                }
             ?>
               <div class="buttonback">
       
       <a href="index.php" ><button class="btn"><i style="font-size:42px;color:black">&#129072;</i></button></a>
           </div>
   
        </tbody>
    </table>
</article>