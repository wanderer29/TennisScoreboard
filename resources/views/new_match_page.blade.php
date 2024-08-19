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
    New match
</header>
<div class="form-container">
    <form>
        <label for="name1">Name of the first player</label>
        <label for="name1">(example: Jacob S.P.)</label>
        <input type="text" id="name1" name="name1" required>

        <label for="name1">Name of the second player</label>
        <input type="text" id="name2" name="name2" required>
        <button onclick="window.location.href='/'">
            Home page
        </button>
        <button onclick="window.location.href='match-score'">
            Start game
        </button>
    </form>
</div>
<footer>
    author: https://github.com/wanderer29
</footer>
</body>
</html>
