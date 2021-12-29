<?php

include 'server.php';

$usern=$_SESSION['username'];
$sql = "SELECT * FROM users WHERE username='$usern' ";

$result = mysqli_query($db, $sql);
if ($result->num_rows > 0) {

 $row = mysqli_fetch_assoc($result);
 $_SESSION['score'] = $row['score'];
}?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <title>Rock Paper Scissors</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
  </head>
  <body>
    <div class="wrapper">
      <div class="scoreboard" style="text-align:center;"> 
          <div class="score" style="margin: auto;">
              <p>SCORE</p>
              <h1><?php echo $_SESSION['score'];?></h1>
          </div>
      </div>
      <div class="referee" style="display: none;"> 
            <div class="decision"><h1> YOU WIN! </h1></div>
        </div>
      <div class="hands">
            <div class="hand paper">
              <img src="pictures/Hand-1.png" onclick="pickUserHand('paper')"/>
            </div>
            <div class="hand scissors">
              <img src="pictures/Scissors-1.png" onclick="pickUserHand('scissors')"/>
            </div>
            <div class="hand rock">
              <img src="pictures/Rock-1.png" onclick="pickUserHand('rock')"/>                        
            </div>
      </div>
      <div class="contest">       
        <div class="userhand">
            <h1>YOU PICKED</h1>
            <div class="handImageContainer">
              <img id="userPickImage" src="pictures/Hand-1.png">
            </div>
        </div>
        <div class="computerhand">
            <h1>THE COMPUTER PICKED</h1>
            <div class="handImageContainer">
              <img id="computerPickImage" src='pictures/Hand-1.png' /> 
            </div>   
        </div>       
      </div>        
    </div>
            <div class="newGame" style="text-align:center;background: radial-gradient(
      134.34% 134.34% at 50% 0%,
      #4f8bda 0%,
      #565fff 100%
    );" onclick="restartGame()">PLAY AGAIN</div>
    <div style="text-align:center;background: radial-gradient(
      134.34% 134.34% at 50% 0%,
      #4f8bda 0%,
      #565fff 100%
    );">Go back to the main page <a href="index.php">BACK</a></div>
    <script src="index.js"></script>
  </body>
</html>