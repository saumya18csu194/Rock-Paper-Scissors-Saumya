
<?php
include 'server.php';
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'training project');
$usern=$_SESSION['username'];
$sql = "SELECT * FROM users WHERE username='$usern'";
$results = mysqli_query($db, $sql);
if($results->num_rows > 0)
{
    $row = mysqli_fetch_assoc($results);
    $match1 = $row['total_match'];  //to get score from database
    $match1=$match1+1; //update match by 1 when user plays a game
    $query="UPDATE users SET total_match='$match1' WHERE username='$usern'";
    $result=mysqli_query($db,$query);
}
echo "<script>history.back()</script>"; 
?>