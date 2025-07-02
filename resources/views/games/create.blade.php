<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Game | Arena Speedrun</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen p-6">

  <div class="max-w-2xl mx-auto bg-gray-900 p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Tambah Game Baru</h2>

    @if ($errors->any())
      <div class="bg-red-600 text-white p-3 rounded mb-4">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Judul Game</label>
        <input type="text" name="game_title" class="w-full p-2 rounded text-black" required>
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Deskripsi</label>
        <textarea name="description" rows="4" class="w-full p-2 rounded text-black" required></textarea>
      </div>

      <div class="mb-6">
        <label class="block mb-1 font-semibold">Cover Image</label>
        <input type="file" name="cover_image" class="w-full p-2 bg-white rounded text-black" required>
      </div>

      <div class="flex justify-between">
        <a href="{{ route('games.index') }}" class="px-4 py-2 bg-gray-600 rounded hover:bg-gray-700 text-white">
          Batal
        </a>
        <button type="submit" class="px-4 py-2 bg-maroon rounded hover:bg-red-800 text-white">
          Simpan
        </button>
      </div>
    </form>
  </div>

</body>
</html>
