<?php

//Declaring variables
$play_count = 0;
$correct_guesses = 0;
$guess_high = 0;
$guess_low = 0;
$percent_correct = 0;

$running = true;

//How many rounds you want to play
$rounds = 10;


//Clear function for terminal. Works in DOS and UNIX
function clearTerminal() {
  $os = (stripos(PHP_OS, "WIN") === 0) ? "DOS" : "UNIX";
  
  if ($os === "DOS") {
    return system('cls');
  } else {
    return system('clear');
  }
}


//Displaying instructions
echo "\n~~~~~~~The number guesser game~~~~~~~\n";

echo "\nI'm going to think of numbers between 1 and 10 (inclusive). Do you think you can guess correctly?\n";


//Gameplay function
function guessNumber() {
  //Bringing global variables inside the function
  global $guess_high, $guess_low, $correct_guesses, $play_count, $percent_correct, $rounds;

  while ($play_count >= 0 && $play_count < $rounds) {


    echo "\nMake your guess between 1 and 10...\n";

    //Making players guess to number and saving it to variable $guess
    $guess = intval(readline(">> "));

    //Checking if players $guess is number and between 1 to 10
    if (is_numeric($guess) && $guess >= 1 && $guess <= 10) {

      $random = rand(1, 10);

      if ($guess > $random) {
        $guess_high++;
        echo "You guessed wrong. Right number was $random\n";
      } elseif ($guess < $random) {
        $guess_low++;
        echo "You guessed wrong. Right number was $random\n";
      } else {
        echo "You guessed right! Right number was $random\n";
        $correct_guesses++;
      }

      //Incrementing play count every round
      $play_count++;

      //Calculating right answer percentage
      $percent_correct = $correct_guesses / $play_count * 100;
    }
  }
}

//Running new rounds till $running variable is reassigned to false
while ($running) {

  //Starting new round
  guessNumber();

  //Displaying results when playcount does not equal -1
  if ($play_count !== -1) {
    echo "\nAfter $play_count rounds, here are some facts about your guessing:\n\nYou guessed the number correctly $percent_correct% of the time.\n";

    if ($guess_high > $guess_low) {
      echo "When you guessed wrong, you tended to guess high.\n\n";
    } else if ($guess_high < $guess_low) {
      echo "When you guessed wrong, you tended to guess low.\n\n";
    }
  }


  //Asking if user wants to play again
  echo "Do you want to play again? (Y or N)\n";
  $again = readline(">> ");

  //Conditions for stopping or continuing the while loop
  if ($again === "N" || $again === "n") {
    $running = false;
    break;
  } elseif ($again === "Y" || $again === "y") {
    $play_count = 0; //Resetting all variables for new game
    $correct_guesses = 0;
    $guess_high = 0;
    $guess_low = 0;
    $percent_correct = 0;
    clearTerminal(); //Clearing terminal
  } else {
    $play_count = -1; //Asking again because input wasn't Y or N
  }
}
