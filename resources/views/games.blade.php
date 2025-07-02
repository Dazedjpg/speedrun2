<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Arena Speedrun | Games</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .bg-maroon { background-color: #800000; }
    .text-maroon { color: #800000; }
  </style>
</head>
<body class="bg-black text-white min-h-screen">

<!-- Navbar -->
<nav class="bg-maroon border-b border-gray-700 px-8 py-4 flex items-center justify-between">
  <div class="flex items-center gap-6">
    <span class="text-white font-bold text-xl">Speedrunner</span>
    <a href="/" class="text-white hover:underline">Home</a>
    <a href="/games" class="text-white hover:underline">Games</a>
  </div>

  <div class="flex items-center gap-4">
    <input
      type="text"
      placeholder="Search..."
      class="px-3 py-1 rounded-md text-black focus:outline-none focus:ring-2 focus:ring-maroon"
    />
    <a href="/register" class="text-white hover:underline">Sign Up</a>
    <a href="/login" class="bg-maroon text-white px-4 py-1 rounded hover:bg-red-900">Sign In</a>
  </div>
</nav>

<!-- Game List -->
<div class="p-6">
  <h1 class="text-3xl font-bold mb-6 text-center">Games List</h1>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
    @foreach($games as $game)
      <a href="{{ route('games.show', ['id' => $game['game_id']]) }}" class="block hover:scale-105 transform transition duration-200">
        <div class="bg-gray-900 p-4 rounded shadow hover:shadow-lg">
          <img 
            src="{{ asset('img/' . $game['cover_image']) }}" 
            alt="{{ $game['game_title'] }}" 
            class="w-full h-48 object-cover rounded mb-3"
          />
          <h2 class="text-xl font-semibold text-white">{{ $game['game_title'] }}</h2>
        </div>
      </a>
    @endforeach
  </div>
</div>

</body>
</html>
