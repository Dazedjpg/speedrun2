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
<body class="bg-black text-white font-sans min-h-screen pt-20">


    @include('partials.navbar', ['style' => $style ?? ['nav' => 'bg-maroon']])

  <!-- Tombol Tambah Game -->
  <div class="flex justify-end mb-6">
    @auth
      @if (Auth::guard('admin')->check())
        <a href="{{ route('games.create') }}" class="px-4 py-2 bg-maroon rounded hover:bg-red-800 text-white">
          + Tambah Game
        </a>
      @endif
    @endauth

  </div>
</div>

<!-- Game List -->
<div class="p-6">
  <h1 class="text-3xl font-bold mb-6 text-center">Games List</h1>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
    @foreach($games as $game)
      <div class="bg-gray-900 p-4 rounded shadow hover:shadow-lg">
        <a href="{{ route('games.show', ['id' => $game->game_id]) }}">
          <img 
            src="{{ asset('img/' . $game->cover_image) }}" 
            alt="{{ $game->game_title }}" 
            class="w-full h-48 object-cover rounded mb-3"
          />
          <h2 class="text-xl font-semibold text-white">{{ $game->game_title }}</h2>
        </a>

        <!-- Tombol Edit & Delete -->
        @auth
        @if (Auth::guard('admin')->check())
        <div class="flex justify-between mt-4">
          <a href="{{ route('games.edit', $game->game_id) }}"
             class="text-sm bg-yellow-500 text-black px-3 py-1 rounded hover:bg-yellow-600">
            Edit
          </a>

          <form action="{{ route('games.destroy', $game->game_id) }}" method="POST"
                onsubmit="return confirm('Hapus game ini?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="text-sm bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
              Delete
            </button>
          </form>
        </div>
        @endif
      @endauth
      </div>
      
    @endforeach
    
  </div>
</div>

</body>
</html>
