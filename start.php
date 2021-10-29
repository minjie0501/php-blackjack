<?php 
session_start();

if (isset($_SESSION['chip'])) {
    $chips = $_SESSION['chip'];
} else {
    $chips = 100;
    $_SESSION['chips'] = $chips;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackjack</title>
    <link rel="stylesheet" href="main-style.css">
</head>
<body>
    Enter the amount you want to bet out of your <?php echo $chips?> chips!
    <form action="/php-blackjack/index.php">
    <input type="text" name="bet">
    <input type="submit">
</form>
</body>
</html>