<!DOCTYPE html>
<html>
<head>
  <title>All Runs</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans min-h-screen pt-20">


  @include('partials.navbar', ['style' => $style ?? ['nav' => 'bg-maroon']])
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">All Runs</h1>

    <div class="space-y-4">
      @foreach($runs as $run)
        <a href="{{ route('runs.show', ['id' => $run['run_id']]) }}" class="block bg-gray-900 p-4 rounded hover:bg-gray-800">
          <h2 class="text-xl font-semibold">{{ $run['runner'] }}</h2>
          <p>Game ID: {{ $run['game_id'] }} | Category ID: {{ $run['category_id'] }} | Time: {{ $run['time'] }}</p>
          <p>Status: {{ $run['status'] }} | Rank: {{ $run['rank'] }}</p>
        </a>
      @endforeach
    </div>
  </div>

</body>
</html>
