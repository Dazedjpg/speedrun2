<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Detail Game | {{ $game->game_title }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen p-6">

  <div class="max-w-4xl mx-auto bg-gray-900 p-6 rounded shadow">
    <h1 class="text-3xl font-bold mb-4">{{ $game->game_title }}</h1>

    @if ($game->cover_image)
      <div class="mb-6">
        <img src="{{ asset('img/' . $game->cover_image) }}" alt="{{ $game->game_title }}" class="w-full max-h-96 object-cover rounded">
      </div>
    @endif

    <div class="mb-6">
      <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
      <p class="text-gray-300 leading-relaxed">{{ $game->description }}</p>
    </div>

    <div class="flex justify-end">
      <a href="{{ route('games.index') }}" class="bg-maroon text-white px-4 py-2 rounded hover:bg-red-800">
        ← Kembali ke Daftar Game
      </a>
    </div>
  </div>

</body>
</html>