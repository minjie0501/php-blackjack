<?php
session_start();

$error = false;
$lost = false;
$errorMsg = "<div></div>";

if (isset($_GET['error'])) {
    if(($_GET['error'] == 'error-1')){
        $errorMsg = "<div class='error' class='error'>Please enter a correct amount to bet!</div>";
    }else if(($_GET['error'] == 'error-2')){
        $errorMsg = "<div class='error'>Your bet must be at least 5 chips!</div>";
    }else if(($_GET['error'] == 'error-3')){
        $errorMsg = "<div class='error'>You don't have enough chips to bet that much!</div>";
    }
    $error = true;
}

if (isset($_POST['newgame'])) {
    $_SESSION['chips'] = 100;
}

if (isset($_SESSION['chips'])) {
    $chips = $_SESSION['chips'];
} else {
    $chips = 100;
    $_SESSION['chips'] = $chips;
}

if ($chips < 5) {
    $lost = true;
    $errorMsg = "<div class='error'>You don't have enough chips to play anymore! Start a new game!</div>";
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackjack</title>
    <link rel="stylesheet" href="index-style.css">
</head>

<body>
    <?php
    if ($lost) {
        echo "<form action='/php-blackjack/' method='post'>
        <h2>$errorMsg</h2>
        <input type='submit' class='button' name='newgame' id='btn-new' value='New game' />
        </form>";
    } else {
        echo "<h1>Enter the amount you want to bet out of your $chips chips!</h1> <h2>$errorMsg</h2>
        <form action='/php-blackjack/game.php'>
        <input type='text' name='bet' id='bet'><br>
        <input type='submit'>";
    }
    ?>

    </form>
</body>

</html>