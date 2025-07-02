<?php
// Tangani form jika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $genre = htmlspecialchars($_POST['genre']);
    $year = htmlspecialchars($_POST['year']);
    $platform = htmlspecialchars($_POST['platform']);
    $description = htmlspecialchars($_POST['description']);

    // Contoh: bisa simpan ke DB di sini, tapi sementara kita tampilkan saja
    echo "<div style='background-color: #0f172a; padding: 20px; color: white; font-family: sans-serif;'>
            <h2>Game added successfully!</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Genre:</strong> $genre</p>
            <p><strong>Release Year:</strong> $year</p>
            <p><strong>Platform:</strong> $platform</p>
            <p><strong>Description:</strong> $description</p>
            <a href='add_game.php' style='color:#38bdf8;'>Add another game</a>
        </div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Game - Arena Speedrun</title>
    <style>
        body {
            background-color: #0b1120;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 60px auto;
            background-color: #111827;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
        }

        h1 {
            font-size: 32px;
            margin-bottom: 5px;
            color: #ffffff;
        }

        p {
            color: #9ca3af;
            margin-bottom: 30px;
            font-size: 14px;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .form-group {
            flex: 1 1 45%;
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            flex: 1 1 100%;
        }

        label {
            margin-bottom: 8px;
            font-weight: 600;
            color: #d1d5db;
        }

        input, select, textarea {
            padding: 12px;
            background-color: #1f2937;
            color: #ffffff;
            border: 1px solid #374151;
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #6366f1;
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-reset {
            background-color: #374151;
            color: #f9fafb;
        }

        .btn-reset:hover {
            background-color: #4b5563;
        }

        .btn-add {
            background-color: #ef4444;
            color: #ffffff;
        }

        .btn-add:hover {
            background-color: #dc2626;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Game</h1>
        <p>Add games to the speedrun leaderboard database</p>

        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Game Name</label>
                <input type="text" name="name" id="name" placeholder="Enter game name" required>
            </div>

            <div class="form-group">
                <label for="genre">Genre</label>
                <select name="genre" id="genre" required>
                    <option value="">Select genre</option>
                    <option>Adventure</option>
                    <option>Action</option>
                    <option>Platformer</option>
                    <option>Puzzle</option>
                    <option>RPG</option>
                    <option>Strategy</option>
                </select>
            </div>

            <div class="form-group">
                <label for="year">Release Year</label>
                <input type="text" name="year" id="year" placeholder="e.g., 2001" required>
            </div>

            <div class="f orm-group">
                <label for="platform">Platform</label>
                <input type="text" name="platform" id="platform" placeholder="e.g., Nintendo, PC" required>
            </div>

            <div class="form-group full-width">
                <label for="description">Description (Optional)</label>
                <textarea name="description" id="description" placeholder="Short description of the game..."></textarea>
            </div>

            <div class="actions">
                <button type="reset" class="btn-reset">Delete</button>
                <button type="submit" class="btn-add">Add Game</button>
            </div>
        </form>
    </div>
</body>
</html>
