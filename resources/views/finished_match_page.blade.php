<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Match result</title>

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
<div class="finished-match">
    <h2>Match between {{ $match['player1']['name'] }} and {{ $match['player2']['name'] }}</h2>
    <h2>Score table:</h2>

    <table class="match-result-table">
        <tr>
            <th></th>
            <th>{{ $match['player1']['name'] }}</th>
            <th>{{ $match['player2']['name'] }}</th>
        </tr>
        <tr>
            <td>Sets</td>
            <td>{{ $match['player1']['sets'] }}</td>
            <td>{{ $match['player2']['sets'] }}</td>
        </tr>
        <tr>
            <td>Games</td>
            <td>{{ $match['player1']['games'] }}</td>
            <td>{{ $match['player2']['games'] }}</td>
        </tr>
        <tr>
            <td>Points</td>
            <td>{{ $match['player1']['points'] }}</td>
            <td>{{ $match['player2']['points'] }}</td>
        </tr>
    </table>

    <h3>Winner: {{ $match[$winner]['name'] }}</h3>
</div>
<footer>
    author: https://github.com/wanderer29
</footer>
</body>
</html>
