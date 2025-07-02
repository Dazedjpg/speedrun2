<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Arena Speedrun | Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .bg-maroon { background-color: #800000; }
    .text-maroon { color: #800000; }
  </style>
</head>
<body class="bg-black text-white font-sans min-h-screen pt-20">

@include('partials.navbar', ['style' => $style ?? ['nav' => 'bg-maroon']])

<div class="container mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-3 gap-6">

  <!-- LATEST RUNS -->
  <div class="md:col-span-2 bg-gray-900 rounded-lg p-6">
    <h2 class="text-xl font-bold text-white mb-4">LATEST RUNS</h2>

    <div class="space-y-6">
      @foreach($games as $game)
        <a href="{{ url('/games/' . $game->game_id) }}" class="block hover:bg-gray-800 transition rounded-lg px-1 py-2">
          <div class="flex gap-4 items-start border-b border-gray-700 pb-4">
            <img src="{{ asset('img/' . $game->cover_image) }}" alt="{{ $game->game_title }}" class="w-16 h-16 rounded" />
            <div class="flex-1">
              <h3 class="font-semibold text-lg">{{ $game->game_title }}</h3>
              <p class="text-white text-sm">{{ Str::limit($game->description, 50) }}</p>
              <div class="flex items-center text-sm text-gray-400 mt-1">
                👑 View Leaderboard
              </div>
            </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>

  <!-- Sidebar -->
  <div class="flex flex-col space-y-6">

    <!-- CHALLENGES -->
    <div class="bg-gray-900 rounded-lg p-6">
      <h2 class="text-xl font-bold text-white mb-4">CHALLENGES</h2>
      <p class="text-sm text-gray-400 mb-1">Live</p>
      <h3 class="text-white font-semibold mb-2">Undertale Genocide any% Speedrun Challenge</h3>
      <p class="text-sm text-gray-400">Ends in <span class="text-white">4d 11h 45m</span></p>
      <p class="text-sm text-gray-400">Prize pool 🏆 <span class="text-white">$500.00</span></p>
    </div>

    <!-- COMMUNITY NEWS -->
    <div class="bg-gray-900 rounded-lg p-6">
      <h2 class="text-xl font-bold text-white mb-4">COMMUNITY NEWS</h2>
      <div class="space-y-4">
        <div>
          <p class="text-sm text-white">SITE NEWS • 2 days ago</p>
          <h4 class="font-semibold">SRC Series Deltarune Chapter 3 Egg%...</h4>
          <p class="text-xs text-gray-400">by <span class="text-white">Meta</span> • 6 views</p>
        </div>
        <div>
          <p class="text-sm text-white">13 days ago</p>
          <h4 class="font-semibold
