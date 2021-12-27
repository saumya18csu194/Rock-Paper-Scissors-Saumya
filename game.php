
<!DOCTYPE html>
<html lang="en">
  <head>

    <title>Rock Paper Scissors</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
  </head>
  <body>
    <div class="wrapper">
      <div class="scoreboard"> 
      
          <div class="title">
              <img src='pictures/title.png' />
          </div>
          <div class="score">
              <p>SCORE</p>
              <h1> 0 </h1>
          </div>
      </div>
      <div class="hands">
            <div class="hand paper">
              <img src="pictures/Paper.png" onclick="pickUserHand('paper')"/>
            </div>
            <div class="hand scissors">
              <img src="pictures/Scissors.png" onclick="pickUserHand('scissors')"/>
            </div>
            <div class="hand rock">
              <img src="pictures/Rock.png" onclick="pickUserHand('rock')"/>                        
            </div>
      </div>
      <div class="contest">       
        <div class="userhand">
            <h1>YOU PICKED</h1>
            <div class="handImageContainer">
              <img id="userPickImage" src="pictures/Paper.png">
            </div>
        </div>
        <div class="referee"> 
            <div class="decision"><h1> YOU WIN! </h1></div>
            <div class="newGame" onclick="restartGame()">PLAY AGAIN</div>
        </div>
        <div class="computerhand">
            <h1>THE COMPUTER PICKED</h1>
            <div class="handImageContainer">
              <img id="computerPickImage" src='pictures/Paper.png' /> 
            </div>   
        </div>       
      </div>        
    </div>
    Go back to the main page <a href="index.php">BACK</a>
    <script src="index.js"></script>
  </body>
</html>