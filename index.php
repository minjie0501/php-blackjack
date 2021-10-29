<?php

declare(strict_types=1);

require 'Suit.php';
require 'Card.php';
require 'Deck.php';
require 'Player.php';
require 'Blackjack.php';

session_start();

if (isset($_GET['new'])) {
    unset($_SESSION['blackjack']);
}

// if (isset($_GET['bet'])) {
//     $betChips = $_GET['bet'];
//     // $_SESSION['chips'] = $_SESSION['chips'] - $betChips;
//     echo $_SESSION['chips'];
// }else{
//     $betChips = 5;
// }




if (!isset($_SESSION['blackjack'])) {
    $object = new Blackjack();
    $_SESSION['blackjack'] = serialize($object);
} else {
    $object = unserialize($_SESSION['blackjack']);
    // $chips = $_SESSION['chips'];
}

$playerCards = [];
$dealerCards = [];
$currentDeck = $object->getDeck();
$player = $object->getPlayer();
$dealer = $object->getDealer();
$resultMsg = "Good luck!";
$showDealerCards = false;
$hidden = false;
$chips = 100;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['hit'])) {
        if ($player->hasLost() == false) {
            $player->hit($currentDeck);
            $_SESSION['blackjack'] = serialize($object);
        }
    } else if (isset($_GET['stand'])) {
        $object->getDealer()->hit($currentDeck);
        $_SESSION['blackjack'] = serialize($object);
        unset($_SESSION['blackjack']);
        $hidden = true;
        $showDealerCards = true;
        if ($object->compareScore($player, $dealer) == "player") {
            $resultMsg = "You won!";
        } else if ($object->compareScore($player, $dealer) == "dealer") {

            $resultMsg = "You lost!";
        } else {
            $resultMsg = "Tie!";
        }
    } else if (isset($_GET['surrender'])) {

        $hidden = true;
        $resultMsg = "You lost!";
    }
}


foreach ($object->getPlayer()->getPlayerCards() as $card) {
    array_push($playerCards, $card->getUnicodeCharacter(true));
}

foreach ($object->getDealer()->getPlayerCards() as $card) {
    array_push($dealerCards, $card->getUnicodeCharacter(true));
}

if ($player->hasLost() == true) {
    $resultMsg = "You lost!";
    $hidden = true;
}

if ($dealer->getScore() == 21 && $player->getScore() == 21) {
    $resultMsg = "Tie!";
    $hidden = true;
    $showDealerCards = true;
} else if ($player->getScore() == 21) {
    $resultMsg = "You won!";
    $hidden = true;
} else if ($dealer->getScore() == 21) {
    $resultMsg = "You lost!";
    $hidden = true;
    $showDealerCards = true;
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
    <div class="container">
        <div class="row row-1">
            <div class="col col-1">
                <h2>Player</h2>
                <h3>Score: <?php echo $player->getScore(); ?></h3>
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
                <h2>Dealer</h2>
                <h3>Score: <?php 
                echo ($showDealerCards) ? $dealer->getScore() :  $object->getDealer()->getPlayerCards()[0]->getValue();?>
                </h3><?php
                if ($showDealerCards == false) {
                    echo $dealerCards[0];
                } else {
                    foreach ($dealerCards as $card) {
                        echo $card;
                    }
                }
                ?>
            </div>
        </div>
        <div class="row row-2">
            <form action="" method="get">
                <input type="submit" class="button" name="hit" <?php if ($hidden) echo "hidden='hidden'"; ?> value="hit" />
                <input type="submit" class="button" name="stand" <?php if ($hidden) echo "hidden='hidden'"; ?> value="stand" />
                <input type="submit" class="button" name="surrender" <?php if ($hidden) echo "hidden='hidden'"; ?> value="surrender" />
            </form>
            <form action="/php-blackjack/" method="get">
                <input type="submit" class="button" name="new" id="btn-new" value="new" />
            </form>
        </div>
    </div>


</body>

</html>