<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Assignment5 In-class</title>
</head>
<body>
  <div class="section">
  <header>
    <h2>The Virtual Slot Machine!</h2><br><br>
  </header>
  
  <?php
    $fruits = array('fruit/cherry.png', 
                    'fruit/apple.png', 
                    'fruit/grapes.png', 
                    'fruit/lemon.png',
                    'fruit/orange.png', 
                    'fruit/pear.png', 
                    'fruit/watermelon.png');
    $slot1 = 0;
    $slot2 = 0;
    $slot3 = 0;
    $betNum = 1;
    $creditNum = 100;
    
    if(isset($_POST["spin"])){
      
      $slot1 = mt_rand(0,6);
      $slot2 = mt_rand(0,6);
      $slot3 = mt_rand(0,6);
      $betNum = $_POST["inputBet"];
      $creditNum = $_POST["credit"];
      
      if(1 <= $betNum && $betNum <= $creditNum){
        echo "<div id='gameStatus'> &#60; Game Playing &#62; </div>";
        if($slot1 == $slot2 && $slot2 == $slot3){
          $earnNum = 3 * $betNum;
          $creditNum = $creditNum + $earnNum;
          echo "<div> You won!!!! Perfect <br> You got credit: </div>" . $earnNum . "<br>";
        }else if ($slot1 != $slot2 && $slot2 != $slot3){
          $creditNum = $creditNum - $betNum;
          echo "<div> You lost!!! <br> You lost credit: </div>" . $betNum . "<br>";
        }else if ($slot1 == $slot2 || $slot2 == $slot3 || $slot1 ==$slot3){
          $creditNum = $creditNum + $betNum;
          echo "<div> You won!! Two pictures are the same <br> You got credit: </div>" . $betNum . "<br>";
        }
      } else if($betNum <= 0) {
        echo "<br> Please, enter your bet number! <br>";     
      } else echo "<br> Your bet number exceeds your credit! <br> Please, try again within your credit! <br>";     
    } 
    
    $slots = array("$slot1", "$slot2", "$slot3");

    foreach($slots as $value){
      echo "<img src='$fruits[$value]'>";
    } "<br>"
    ?>

    <form action="" method="POST">
        <label for="name"><b>Name: </b></label>
        <input type="text" id="name" name="inputName" required value="<?php if(isset($_POST['inputName'])) {echo $_POST['inputName'];}?>"><br>
        <label for="bet"><b>Your Bet: </b></label>
        <input type="number" min="1" id="bet" name="inputBet" value="<?php if(isset($_POST['inputBet'])) {echo $_POST['inputBet'];}?>" ><br>
        <label for="credit"><b>Credit: </b></label>
        <input type="number" id="credit" name="credit" value="<?php echo $creditNum ?>" readonly="true"><br>
        <button id="btnSpin" type="submit" name="spin">SPIN</button><br><br>
     </form>   
  </div>
</body>
</html>