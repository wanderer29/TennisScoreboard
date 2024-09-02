<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New match</title>

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
<div class="form-container">
    <form action="{{ route('new-match.store') }}" method="POST">
        @csrf
        <label for="name1">Name of the first player</label>
        <label for="name1">(example: Jacob S.P.)</label>
        <input type="text" id="name1" name="name1" required>

        <label for="name1">Name of the second player</label>
        <input type="text" id="name2" name="name2" required>

        <button type="submit">
            Start game
        </button>
        @if (isset($error))
            <p style="color:red">{{ $error }}</p>
        @endif
    </form>

</div>
<footer>
    author: https://github.com/wanderer29
</footer>
</body>
</html>
