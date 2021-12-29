const handOptions = {
    "rock": "pictures/Rock-1.png",
    "paper": "pictures/Hand-1.png",
    "scissors": "pictures/Scissors-1.png"
  }
  
  
  //let SCORE = 0;
  
  const pickUserHand = (hand) => {
    let hands = document.querySelector(".hands");
    hands.style.display = "none";
  
    let contest = document.querySelector(".contest");
    contest.style.display = "flex";
  
    // set user Image
    document.getElementById("userPickImage").src = handOptions[hand];
  
    pickComputerHand(hand);
  };
  
  const pickComputerHand = (hand) => {
      let hands = ["rock", "paper", "scissors"];
      let cpHand = hands[Math.floor(Math.random() * hands.length)];
      // set computer image 
      document.getElementById("computerPickImage").src = handOptions[cpHand]
      
      referee(hand, cpHand);
  };
  
  const referee = (userHand, cpHand) => {
    if (userHand == "paper" && cpHand == "scissors") {
      setDecision("YOU LOSE!");
      
    }
    if (userHand == "paper" && cpHand == "rock") {
      setDecision("YOU WIN!");
      setTimeout(function (){location.href="trial.php";}, 500);
      //location.href="trial.php";
      
      
     // setScore(SCORE + 1);
    }
    if (userHand == "paper" && cpHand == "paper") {
      setDecision("It's a tie!");
    }
    if (userHand == "rock" && cpHand == "scissors") {
      setDecision("YOU WIN!");
      setTimeout(function (){location.href="trial.php";}, 500);
     
      //location.href="trial.php";
       
      
      //setScore(SCORE + 1);
      
      

    }
    if (userHand == "rock" && cpHand == "paper") {
      setDecision("YOU LOSE!");
      
    }
    if (userHand == "rock" && cpHand == "rock") {
      setDecision("It's a tie!");
    }
    if (userHand == "scissors" && cpHand == "scissors") {
      setDecision("It's a tie!");
    }
    if (userHand == "scissors" && cpHand == "rock") {
      setDecision("YOU LOSE!");
      
    }
    if (userHand == "scissors" && cpHand == "paper") {
      setDecision("YOU WIN!");
      setTimeout(function (){location.href="trial.php";}, 500);
      
     
      //location.href="trial.php";
      
      //setScore(SCORE + 1);
    }
    document.getElementsByClassName('referee')[0].style.display="block";
    document.getElementsByClassName('newGame')[0].style.display="block";
  };
  
  const restartGame = () => {
    document.getElementsByClassName('referee')[0].style.display="none";
    document.getElementsByClassName('newGame')[0].style.display="none";
    let contest = document.querySelector(".contest");
    contest.style.display = "none";
  
    let hands = document.querySelector(".hands");
    hands.style.display = "flex";
  }
  
  const setDecision = (decision) => {
    document.querySelector(".decision h1").innerText = decision;
  }
  
  const setScore = (newScore) => {
    SCORE = newScore;
    document.querySelector(".score h1").innerText = newScore;
  }
