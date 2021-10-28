<?php

declare(strict_types=1);

require 'Suit.php';
require 'Card.php';
require 'Deck.php';
require 'Player.php';
require 'Blackjack.php';


session_start();


//unset($_SESSION['blackjack']); // NOTE: delete this
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

// whatIsHappening();
if(isset($_GET['new'])){
    unset($_SESSION['blackjack']);
}


if (!isset($_SESSION['blackjack'])) {
    $object = new Blackjack();
    $_SESSION['blackjack'] = serialize($object);
} else {
    $object = unserialize($_SESSION['blackjack']);
}



$playerCards = [];
$dealerCards = [];

$currentDeck = $object->getDeck();
$player = $object->getPlayer();
$dealer = $object->getDealer();
$resultMsg = "Good luck!";

$hidden = false;


// var_dump($currentDeck);
// var_dump($object->getPlayer()->getPlayerCards());
// var_dump($object->getPlayer()->getScore());
// var_dump($object->getDeck()->getCards());





if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['hit'])) {
        if($player->hasLost() == false){
            $player->hit($currentDeck);
            $_SESSION['blackjack'] = serialize($object);
        }
    } else if(isset($_GET['stand'])){
        $object->getDealer()->hit($currentDeck);
        $_SESSION['blackjack'] = serialize($object);
        unset($_SESSION['blackjack']);
        $hidden = true;
    }
}

foreach ($object->getPlayer()->getPlayerCards() as $card) {
    array_push($playerCards, $card->getUnicodeCharacter(true));
}

foreach ($object->getDealer()->getPlayerCards() as $card) {
    array_push($dealerCards, $card->getUnicodeCharacter(true));
}

if ($player->hasLost() == true) {
    $resultMsg = "You lost";
    $hidden = true;
}

if($player->getScore() == 21){
    $resultMsg = "You won";
    $hidden = true;
}
// var_dump($object->getDealer()->hit($currentDeck));
// $object->getDealer()->hit($currentDeck);
// $_SESSION['blackjack'] = serialize($object);


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
    <div class="container">
        <div class="row row-1">
            <div class="col col-1">
                <h4>Player</h4>
                <h5>Score: <?php echo $player->getScore(); ?></h5>
                <?php
                foreach ($playerCards as $card) {
                    echo $card;
                }
                ?>
            </div>
            <div class="col col-2">
                <?php echo "<h2>$resultMsg</h2>"; ?>
            </div>
            <div class="col col-3">
                <h4>Dealer</h4>
                <h5>Score: <?php echo $dealer->getScore(); ?></h5>
                <?php
                foreach ($dealerCards as $card) {
                    echo $card;
                }
                ?>
            </div>
        </div>
        <div class="row row-2">
            <form action="" method="get">
                <input type="submit" class="button" name="hit" <?php if($hidden)echo "hidden='hidden'"; ?> value="hit" />
                <input type="submit" class="button" name="stand" <?php if($hidden)echo "hidden='hidden'"; ?> value="stand" />
            </form>
            <form action="/php-blackjack/" method="get">
                <input type="submit" class="button" name="new" id="btn-new" value="new" />
            </form>
        </div>
    </div>


</body>

</html>