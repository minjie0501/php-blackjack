<?php 
declare(strict_types=1);


class Player{
    private $cards = [];
    private $lost = false;

    private const BLACK_JACK = 21;

    public function __construct(Deck $deck)
    {
        // $deck->drawCard(); // TODO: draw 2 cards
        array_push($this->cards, $deck->drawCard());
        array_push($this->cards, $deck->drawCard());
    }

    public function getScore(): int
    {
        $total = 0;
        foreach($this->cards as $card){
            $total += $card;
        }
        return $total;
    }

    public function hit(Deck $deck) : array
    {
        array_push($this->cards, $deck->drawCard());
        if($this->getScore()>self::BLACK_JACK) $this->lost = true;
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
?>