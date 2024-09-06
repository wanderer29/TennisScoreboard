# Project "Tennis Scoreboard"
A web application implementing a tennis match score table.

## Application functionality
Working with matches:
- Creating a new match
- Viewing completed matches, searching matches by player names
- Calculating points in the current match

Tennis scoring system: https://gotennis.ru/read/world_of_tennis/pravila.html

For simplicity, it is assumed that each match is played according to the following rules:
- The match is played up to two sets (best of 3)
- When the score in the set is 6/6, a tie-break is played up to 7 points.

## Features
- PHP 8.2
- Laravel framework 11.20
- Predis 2.2.2
- HTML/CSS
- MySql 9.0
- Unit Tests

## Application interface
- Home page
  - Links leading to new match pages and a list of completed matches
- New match page
  - Address - /new-match/create.
  - Interface:
    - HTML form with fields “Player 1 name”, “Player 2 name” and “start” button. For simplicity, let’s assume that player names are unique. A player cannot play with himself.
    - Clicking the “start” button will result in a POST request to /new-match
- Match score page
  - Address - /match-score
  - Interface:
    - Table with players' names, current score
    - Forms and buttons for actions - “player 1 won the current point”, “player 2 won the current point”
    - Pressing the buttons leads to a POST request to the address /match-score, the fields of the sent form contain the name of the player who won the point
- Played matches page
  - Address - /matches?page=$query=$player_name&page=$page_number
  - Displays a list of played matches page by page. Allows you to search for a player's matches by name. Pagination is used for page by page display.
  - Interface:
    - Form with a filter by player name. Input field for the name and the “search” button. When clicked, a GET request of the type /matches?query=${NAME} is generated
    - List of found matches
    - Page switcher if more matches are found than fit on one page

## Tests
- If player 1 wins a point at 40-40, the game does not end
- If player 1 wins a point at 40-0, he also wins the game
- At 6-6, a tiebreak begins instead of a regular game
- If player 1 have 6 games and opponent have 4 or less, player 1 win set
- If player 1 have at least 6 games and difference in points with opponent less two games, player 1 won't win set

The application is now available at: http://194.58.126.128/

