<?php

declare(strict_types=1);


class Blackjack
{
    private Player $player;
    private Dealer $dealer;
    private Deck $deck;

    public function __construct()
    {
        $this->deck = new Deck();
        $this->deck->shuffle();
        $this->player = new Player($this->deck);
        $this->dealer = new Dealer($this->deck);
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

    public function compareScore($player, $dealer): string
    {
        if ($this->player->hasLost() == false && $this->dealer->hasLost() == false) {
            if ($this->player->getScore() > $this->dealer->getScore()) {
                return "player";
            } else if ($this->player->getScore() == $this->dealer->getScore()) {
                return "tie";
            } else {
                return "dealer";
            }
        } else {
            return "player";
        }
    }
}
