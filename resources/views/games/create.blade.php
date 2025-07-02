<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tambah Game | Arena Speedrun</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 font-sans min-h-screen p-6">

  <div class="text-center mb-8">
    <h1 class="text-3xl font-bold text-white mb-2">Tambah Game Baru</h1>
    <p class="text-slate-400">Masukkan informasi game ke leaderboard</p>
  </div>

  <div class="max-w-3xl mx-auto bg-slate-800 rounded-lg shadow-lg p-8">
    @if ($errors->any())
      <div class="bg-red-600 text-white p-4 rounded mb-6">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="game_title" class="block mb-1 font-semibold">Judul Game</label>
          <input type="text" name="game_title" id="game_title"
                 value="{{ old('game_title') }}"
                 class="w-full px-4 py-2 rounded bg-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-red-500" required>
        </div>

        <div>
          <label for="cover_image" class="block mb-1 font-semibold">Cover Image</label>
          <input type="file" name="cover_image" id="cover_image"
                 class="w-full px-4 py-2 rounded bg-slate-700 text-white file:bg-red-600 file:text-white file:border-none file:px-4 file:py-2 file:rounded hover:file:bg-red-700" required>
        </div>

        <div class="md:col-span-2">
          <label for="description" class="block mb-1 font-semibold">Deskripsi</label>
          <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-2 rounded bg-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-red-500" required>{{ old('description') }}</textarea>
        </div>
      </div>

      <div class="flex justify-end mt-6 gap-4">
        <a href="{{ route('games.index') }}"
           class="bg-gray-600 hover:bg-gray-700 px-5 py-2 rounded text-white font-medium">
          Batal
        </a>
        <button type="submit"
                class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded text-white font-medium">
          Simpan
        </button>
      </div>
