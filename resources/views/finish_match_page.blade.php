<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Match score page</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<header>
    <nav class="navbar">
        <a href="{{ route('home_page') }}">Home</a>
        <a href="{{ route('new-match.create') }}">New Match</a>
        <a href="{{ route('matches.index') }}">Played Matches</a>
    </nav>
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
                <td>{{ $match['player1']['name'] }}</td>
                <td id="player1-sets">{{ $match['player1']['sets'] }}</td>
                <td id="player1-games">{{ $match['player1']['games'] }}</td>
                <td id="player1-points">{{ $match['player1']['points'] }}</td>
            </tr>
            <tr>
                <td>{{ $match['player2']['name'] }}</td>
                <td id="player2-sets">{{ $match['player2']['sets'] }}</td>
                <td id="player2-games">{{ $match['player2']['games'] }}</td>
                <td id="player2-points">{{ $match['player2']['points'] }}</td>
            </tr>
            </tbody>
        </table>

        <form method="POST" action="/match-score">
            @csrf
            <input type="hidden" name="winner" value="player1">
            <button type="submit">
                Point to Player 1
            </button>
        </form>
        <form method="POST" action="/match-score">
            @csrf
            <input type="hidden" name="winner" value="player2">
            <button type="submit">
                Point to Player 2
            </button>
        </form>
    </div>
</div>
<footer>
    author: https://github.com/wanderer29
</footer>
</body>
</html>
