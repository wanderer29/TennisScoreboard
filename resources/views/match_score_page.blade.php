<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Match score page</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<header>
    Match score page
</header>
<div class="matchScore">
    <div class="scoreboard">
        <table>
            <thead>
            <tr>
                <th>Players</th>
                <th>Sets</th>
                <th>Games</th>
                <th>Points</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Player 1</td>
                <td id="player1-sets">0</td>
                <td id="player1-games">0</td>
                <td id="player1-points">0</td>
            </tr>
            <tr>
                <td>Player 2</td>
                <td id="player2-sets">0</td>
                <td id="player2-games">0</td>
                <td id="player2-points">0</td>
            </tr>
            </tbody>
        </table>

        <form action="">
            <div>
                <button type="button" formaction="/point/player1">
                    Point to Player 1
                </button>
                <button type="button" formaction="/point/player2">
                    Point to Player 2
                </button>
            </div>
        </form>
    </div>
</div>
<footer>
    author: https://github.com/wanderer29
</footer>
</body>
</html>
