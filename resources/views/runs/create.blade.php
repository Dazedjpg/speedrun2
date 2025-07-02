<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Submit Run - {{ $game->game_title }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white p-8 min-h-screen">

  <div class="max-w-2xl mx-auto bg-gray-900 p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Submit Run for {{ $game->game_title }}</h1>

    @if ($errors->any())
      <div class="bg-red-600 p-4 rounded mb-4">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('runs.store', ['id' => $game->game_id]) }}" method="POST">
      @csrf

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Runner Name</label>
        <input type="text" name="runner" class="w-full p-2 rounded text-black" required>
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Time (e.g., 1m 25s 320ms)</label>
        <input type="text" name="time" class="w-full p-2 rounded text-black" required>
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Category</label>
        <select name="category_id" class="w-full p-2 rounded text-black" required>
        <option value="">Select Category</option>
        <option value="300">Any%</option>
         <option value="301">Glitchless</option>
    </select>
    </div>

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Status</label>
        <select name="status" class="w-full p-2 rounded text-black" required>
          <option value="verified">Verified</option>
          <option value="pending">Pending</option>
        </select>
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Video URL (optional)</label>
        <input type="url" name="video" class="w-full p-2 rounded text-black">
      </div>

      <div class="flex justify-between">
        <a href="{{ route('games.show', ['id' => $game->game_id]) }}" class="px-4 py-2 bg-gray-600 rounded hover:bg-gray-700 text-white">Cancel</a>
        <button type="submit" class="px-4 py-2 bg-red-700 hover:bg-red-800 text-white rounded">Submit Run</button>
      </div>
    </form>
  </div>

</body>
</html>
