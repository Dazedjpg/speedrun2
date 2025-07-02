@php
  switch ($game['game_id']) {
      case 400:
          $style = ['bg' => 'bg-yellow-800', 'nav' => 'bg-yellow-800']; // Pacman
          break;
      case 401:
          $style = ['bg' => 'bg-red-950', 'nav' => 'bg-red-700']; // Mario
          break;
      case 402:
          $style = ['bg' => 'bg-blue-950', 'nav' => 'bg-blue-700']; // Tetris
          break;
      case 403:
          $style = ['bg' => 'bg-green-950', 'nav' => 'bg-green-700']; // Donkey Kong
          break;
      default:
          $style = ['bg' => 'bg-gray-900', 'nav' => 'bg-maroon'];
  }
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{ $game['game_title'] }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="{{ $style['bg'] }} bg-black text-white font-sans min-h-screen pt-20">

  @include('partials.navbar', ['style' => $style])

  <!-- Game Info -->
  <div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">{{ $game['game_title'] }}</h1>
    <div class="flex flex-col md:flex-row gap-6">
      <img src="{{ asset('img/' . $game['cover_image']) }}" class="w-full md:w-64 h-auto object-contain rounded" />
      <p class="text-white">{{ $game['description'] }}</p>
    </div>
  </div>

  <!-- Runs Section -->
  <div class="max-w-5xl mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Speedrun Submissions</h2>

    @php
      function convertToMilliseconds($time) {
          preg_match('/(?:(d+)m)?s*(?:(d+)s)?s*(?:(d+)ms)?/', $time, $matches);
          return (int)($matches[1] ?? 0) * 60000 + (int)($matches[2] ?? 0) * 1000 + (int)($matches[3] ?? 0);
      }

      use Illuminate\Support\Facades\Storage;

      $categoriesMap = [
        300 => 'Any%',
        301 => 'Glitchless',
      ];

      $jsonRuns = Storage::disk('public')->get('json/runs.json');
      $runs = json_decode($jsonRuns, true);

      foreach ($runs as &$r) {
        $r['category'] = $categoriesMap[$r['category_id']] ?? 'Unknown';
      }

      $gameRuns = collect($runs)
        ->where('game_id', $game['game_id'])
        ->sortBy(fn($r) => convertToMilliseconds($r['time']))
        ->groupBy('category');

      $categories = array_unique(array_values($categoriesMap));
    @endphp

    <!-- Tabs -->
    <div class="mb-6 flex flex-col md:flex-row justify-between items-center">
      <div class="flex flex-wrap gap-2" id="category-tabs">
        @foreach($categories as $index => $cat)
          <button 
            onclick="showCategory('{{ Str::slug($cat) }}')" 
            class="bg-gray-700 px-4 py-2 rounded hover:bg-gray-600 {{ $loop->first ? 'active-tab' : '' }}"
            id="tab-{{ Str::slug($cat) }}"
          >
            {{ $cat }}
          </button>
        @endforeach
      </div>

      <div class="mt-4 md:mt-0">
        <a href="{{ route('runs.create', ['id' => $game['game_id']]) }}" class="bg-maroon hover:bg-red-800 text-white px-5 py-2 rounded text-sm md:text-base">
  ➕ Submit Run
</a>
      </div>
    </div>

    <!-- Category Tables -->
    @foreach($categories as $index => $cat)
      <div class="category-table {{ !$loop->first ? 'hidden' : '' }}" id="cat-{{ Str::slug($cat) }}">
        @php $runsInCategory = $gameRuns[$cat] ?? collect(); @endphp

        @if ($runsInCategory->isEmpty())
          <p class="text-gray-400 mb-6">No runs available in this category.</p>
        @else
          <table class="min-w-full text-left border border-white border-collapse mb-8">
            <thead class="bg-gray-800 text-white">
              <tr>
                <th class="py-2 px-4 border border-white">Rank</th>
                <th class="py-2 px-4 border border-white">Runner</th>
                <th class="py-2 px-4 border border-white">Time</th>
                <th class="py-2 px-4 border border-white">Status</th>
                <th class="py-2 px-4 border border-white">Video</th>
                <th class="py-2 px-4 border border-white">Submitted At</th>
              </tr>
            </thead>
            <tbody class="text-gray-300">
              @foreach($runsInCategory->values() as $rank => $run)
                <tr class="border-t border-white">
                  <td class="py-2 px-4 border border-white">{{ $rank + 1 }}</td>
                  <td class="py-2 px-4 border border-white">{{ $run['runner'] }}</td>
                  <td class="py-2 px-4 border border-white">{{ $run['time'] }}</td>
                  <td class="py-2 px-4 border border-white">{{ $run['status'] }}</td>
                  <td class="py-2 px-4 border border-white">
                    <a href="{{ $run['video'] }}" target="_blank" class="text-blue-400 hover:underline">Watch</a>
                  </td>
                  <td class="py-2 px-4 border border-white">{{ $run['submitted_at'] }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @endif
      </div>
    @endforeach
  </div>

  <script>
    function showCategory(slug) {
      document.querySelectorAll('.category-table').forEach(el => el.classList.add('hidden'));
      document.querySelectorAll('#category-tabs button').forEach(el => el.classList.remove('bg-gray-500', 'active-tab'));
      document.getElementById('cat-' + slug).classList.remove('hidden');
      document.getElementById('tab-' + slug).classList.add('bg-gray-500', 'active-tab');
    }
  </script>

</body>
</html>
