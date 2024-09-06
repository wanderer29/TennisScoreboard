<!doctype html>
<html lang="en">
<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Played matches page</title>

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

<div class="search-container">
    <form action="{{ route('matches.search') }}" method="GET">
        <input type="text" name="query" value="{{ request('query') }}" placeholder="Search by player name" required>
        <button type="submit">Search</button>
    </form>
</div>

<div class="games">
    <h2>Played matches</h2>
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

    <div class="pagination">
        {{ $games->links() }}
    </div>

{{--    <button onclick="window.location.href='{{ route('home_page') }}'">--}}
{{--        Main page--}}
{{--    </button>--}}
</div>
<footer>
    author: https://github.com/wanderer29
</footer>
</body>
</html>
