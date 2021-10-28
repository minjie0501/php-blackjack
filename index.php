<?php

declare(strict_types=1);

require 'Suit.php';
require 'Card.php';
require 'Deck.php';
require 'Player.php';
require 'Blackjack.php';


session_start();

unset($_SESSION['blackjack']);
function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

whatIsHappening();

if (!isset($_SESSION['blackjack'])) {
    $object = new Blackjack();
    $_SESSION['blackjack'] = serialize($object);
}else{
    $object = unserialize($_SESSION['blackjack']);
}

var_dump($object->getDealer());
var_dump($object->getPlayer());
var_dump($object->getPlayer()->getScore());

foreach($object->getDeck()->getCards() AS $card) {
    // echo $card;
    echo $card->getUnicodeCharacter(true);
    echo '<br>';
}





if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Something posted

    if (isset($_GET['hit'])) {
        // btnDelete 
        echo "ASD";
    } else {
        // Assume btnSubmit 
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackjack</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="user-cards">
        <?php ?>
    </div>
    <form action="" method="get">
    <input type="submit" class="button" name="hit" id="hit" value="hit" />
    <input type="submit" class="button" name="stand" value="stand" />
    </form>

</body>

</html>