<?php 
declare(strict_types=1);


class Player{
    protected $cards = [];
    private $lost = false;

    protected const BLACK_JACK = 21;

    public function __construct(Deck $deck)
    {
        for ($i=0; $i < 2; $i++) { 
            array_push($this->cards, $deck->drawCard());
        }
    }

    public function getScore(): int
    {
        $total = 0;
        foreach($this->cards as $card){
            $total += $card->getValue();
        }
        return $total;
    }

    public function hit(Deck $deck) : array
    {
        array_push($this->cards, $deck->drawCard());
        if($this->getScore()>self::BLACK_JACK) $this->lost = true;
        return $this->cards;
    }

    public function getPlayerCards() : array
    {
        return $this->cards;
    }

    public function surrender(): bool
    {
        $this->lost = true;
        return $this->lost;
    }

    public function hasLost(): bool
    {
        return $this->lost;
    }
}

class Dealer extends Player
{
    public function hit(Deck $deck) : array
    {   
        while($this->getScore()<15){
            parent::hit($deck);
        }
        return $this->cards;
    }
}
?>