<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Played matches page</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<header>
    Played matches page
</header>
<div class="games">
    <div class="gamesTitle">
        <div>Player 1</div>
        <div>Player 2</div>
        <div>Winner</div>
    </div>


    @foreach($games as $game)
        <div class="game">
            <div class="gameParameter">
                {{ $game->getPlayer1Name->name}}
            </div>
            <div class="gameParameter">
                {{ $game->getPlayer2Name->name }}
            </div>
            <div class="gameParameter">
                {{ $game->getWinnerName->name }}
            </div>
        </div>

    @endforeach
    <button onclick="window.location.href='/'">
        Main page
    </button>
</div>
<footer>
    author: https://github.com/wanderer29
</footer>
</body>
</html>
