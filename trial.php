
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
    $score1 = $row['score'];
    $score1=$score1+1;
    $query="UPDATE users SET score='$score1' WHERE username='$usern'";
    $result=mysqli_query($db,$query);
    //echo $score1;
    //echo $result;
}

//return $score;
echo "<script>history.back()</script>"; 
?>
