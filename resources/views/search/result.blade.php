@extends('layouts.app')

@section('content')
  <div class="max-w-4xl mx-auto p-6 text-white">
    <h1 class="text-2xl font-bold mb-4">Search Results</h1>

    @if($results['games']->isEmpty() && $results['news']->isEmpty() && $results['users']->isEmpty())
      <p>No results found for "{{ $query }}".</p>
    @else
      {{-- Games --}}
      @if(!$results['games']->isEmpty())
        <h2 class="text-xl font-semibold mt-6 mb-2">Games</h2>
        <ul class="list-disc pl-6">
          @foreach($results['games'] as $game)
            <li><a href="{{ url('/games/' . $game['game_id']) }}" class="text-blue-400 hover:underline">{{ $game['game_title'] }}</a></li>
          @endforeach
        </ul>
      @endif

      {{-- News --}}
      @if(!$results['news']->isEmpty())
        <h2 class="text-xl font-semibold mt-6 mb-2">News</h2>
        <ul class="list-disc pl-6">
          @foreach($results['news'] as $item)
            <li><strong>{{ $item['title'] }}</strong> <span class="text-gray-400 text-sm">by {{ $item['author'] }}</span></li>
          @endforeach
        </ul>
      @endif

      {{-- Users --}}
      @if(!$results['users']->isEmpty())
        <h2 class="text-xl font-semibold mt-6 mb-2">Users</h2>
        <ul class="list-disc pl-6">
          @foreach($results['users'] as $user)
            <li>{{ $user['name'] }}</li>
          @endforeach
        </ul>
      @endif
    @endif
  </div>
@endsection
