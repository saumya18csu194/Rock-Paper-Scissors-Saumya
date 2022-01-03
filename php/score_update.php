
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
    $score1 = $row['score'];  //to get score from database
    $score1=$score1+1; //update score by 1 when user wins
    $query="UPDATE users SET score='$score1' WHERE username='$usern'";
    $result=mysqli_query($db,$query);
}
$sql = "SELECT * FROM users WHERE username='$usern'";
$results = mysqli_query($db, $sql);
if($results->num_rows > 0)
{
    $match1 = $row['total_match'];  //to get score from database
    $match1=$match1+1; //update score by 1 when user wins
    $query1="UPDATE users SET total_match='$match1' WHERE username='$usern'";
    $result1=mysqli_query($db,$query1);
}
echo "<script>history.back()</script>"; 
?>
