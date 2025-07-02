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
  </div>
</nav>

<!-- Flash Message -->
<div class="max-w-6xl mx-auto mt-6 px-4">
  @if(session('success'))
    <div class="bg-green-600 text-white p-3 rounded mb-4">
      {{ session('success') }}
    </div>
  @endif

  <!-- Tombol Tambah Game -->
  <div class="flex justify-end mb-6">
    <a href="{{ route('games.create') }}" class="bg-maroon text-white px-4 py-2 rounded hover:bg-red-800">
      + Tambah Game
    </a>
  </div>
</div>

<!-- Game List -->
<div class="p-6">
  <h1 class="text-3xl font-bold mb-6 text-center">Games List</h1>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
    @foreach($games as $game)
      <div class="bg-gray-900 p-4 rounded shadow hover:shadow-lg">
        <a href="{{ route('games.show', ['id' => $game['game_id']]) }}">
          <img 
            src="{{ asset('img/' . $game['cover_image']) }}" 
            alt="{{ $game['game_title'] }}" 
            class="w-full h-48 object-cover rounded mb-3"
          />
          <h2 class="text-xl font-semibold text-white">{{ $game['game_title'] }}</h2>
        </a>

        <!-- Tombol Edit & Delete -->
        <div class="flex justify-between mt-4">
          <a href="{{ route('games.edit', $game['game_id']) }}"
             class="text-sm bg-yellow-500 text-black px-3 py-1 rounded hover:bg-yellow-600">
            Edit
          </a>

          <form action="{{ route('games.destroy', $game['game_id']) }}" method="POST"
                onsubmit="return confirm('Hapus game ini?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="text-sm bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
              Delete
            </button>
          </form>
        </div>
      </div>
    @endforeach
  </div>
</div>

</body>
</html>
