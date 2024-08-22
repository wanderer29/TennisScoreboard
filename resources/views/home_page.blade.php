<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home page</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<header>
    Home page
</header>
<div class="main">
    <button onclick="window.location.href='{{ route('new-match.index') }}'">
        New match page
    </button>
    <button onclick="window.location.href='{{ route('matches.index') }}'">
        Played matches page
    </button>
</div>
<footer>
    author: https://github.com/wanderer29
</footer>
</body>
</html>
