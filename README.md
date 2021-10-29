# OOP: Blackjack

## Learning objective
- A first dive into OOP (object oriented programming)

## The Goal
Create a blackjack game using OOP in PHP.

### Blackjack Rules
- Cards are between 1-11 points.
    - Faces are worth 10
    - Ace is always worth 11
- Getting more than 21 points, means that you lose.
- To win, you need to have more points than the dealer, but not more than 21.
- The dealer is obligated to keep taking cards until they have at least 15 points.
- We are not playing with blackjack rules on the first turn (having 21 on first turn) - we leave this up to you as a nice to have.

#### Flow
  - A new deck is shuffled
  - Player and dealer get 2 random cards
  - Dealer shows first card he drew to player
  - Player either keeps getting hit (asks for more cards), or stands down.
  - If the player at any point goes above 21, he automatically loses.
  - Once the player is done the dealer keeps taking cards until he has at least 15 points. If he hits above 21 he automatically loses.
  - At the end display the winner

## Extra challenge
 :heavy_check_mark: Implement a betting system (TODO: input validation for bet amount) \
 :heavy_check_mark: Implement the blackjack first turn rule (If the player draws 21 the first turn: he directly wins. If the dealer draws 21 the first turn, he wins. If both draw it, it is a tie.)



