<!DOCTYPE html>
<html>
<head>
  <title>Run Detail</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans min-h-screen pt-20">

@include('partials.navbar', ['style' => $style ?? ['nav' => 'bg-maroon']])

  <div class="container mx-auto px-4 py-6">
    <a href="{{ route('runs.index') }}" class="text-blue-400 hover:underline">← Back to All Runs</a>

    <div class="bg-gray-900 p-6 rounded mt-4">
      <h1 class="text-2xl font-bold mb-4">Run by {{ $run['runner'] }}</h1>

      <p><strong>Run ID:</strong> {{ $run['run_id'] }}</p>
      <p><strong>Game ID:</strong> {{ $run['game_id'] }}</p>
      <p><strong>Category ID:</strong> {{ $run['category_id'] }}</p>
      <p><strong>User ID:</strong> {{ $run['user_id'] }}</p>
      <p><strong>Time:</strong> {{ $run['time'] }}</p>
      <p><strong>Rank:</strong> {{ $run['rank'] }}</p>
      <p><strong>Status:</strong> {{ $run['status'] }}</p>
      <p><strong>Submitted at:</strong> {{ $run['submitted_at'] }}</p>

      @if(!empty($run['video']))
        <div class="mt-4">
          <p class="mb-2">Video:</p>
          <a href="{{ $run['video'] }}" target="_blank" class="text-blue-400 hover:underline">
            {{ $run['video'] }}
          </a>
        </div>
      @endif
    </div>
  </div>

</body>
</html>
