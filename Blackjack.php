<?php 
declare(strict_types=1);


class Blackjack
{
    private Player $player;
    private Player $dealer;
    private Deck $deck;

    public function __construct(Player $player, Player $dealer, Deck $deck)
    {
        $this->player = $player;
        $this->dealer = $dealer;
        $this->deck = $deck;
    }

    public function getPlayer(): object
    {
        return $this->player;
    }

    public function getDealer(): object
    {
        return $this->dealer;
    }

    public function getDeck(): object
    {
        return $this->deck;
    }

}
?>