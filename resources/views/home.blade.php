<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Arena Speedrun | Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .bg-maroon { background-color: #800000; }
    .text-maroon { color: #800000; }
  </style>
</head>
<body class="bg-black text-white font-sans min-h-screen">

<!-- Navbar -->
<nav class="bg-maroon border-b border-gray-700 px-8 py-4 flex items-center justify-between">
  <div class="flex items-center gap-6">
    <span class="text-white font-bold text-xl">Arena Speedrun</span>
    <a href="/" class="text-white hover:underline">Home</a>
    <a href="/games" class="text-white hover:underline">Games</a>
  </div>

  <div class="flex items-center gap-4">
    <input
      type="text"
      placeholder="Search..."
      class="px-3 py-1 rounded-md text-black focus:outline-none focus:ring-2 focus:ring-maroon"
    />

    @guest
      <a href="{{ route('signup.form') }}" class="text-white hover:underline">Sign Up</a>
      <a href="{{ route('signin.form') }}" class="bg-maroon text-white px-4 py-1 rounded hover:bg-red-900">Sign In</a>
    @endguest

    @auth
      <!-- Profile dropdown -->
      <div class="relative group">
        <button class="flex items-center text-white focus:outline-none">
          <span class="mr-2">{{ Auth::user()->name }}</span>
          <svg class="w-4 h-4 transform group-hover:rotate-180 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div class="absolute right-0 mt-2 w-40 bg-white text-black rounded-md shadow-md opacity-0 group-hover:opacity-100 group-hover:translate-y-1 transition-all duration-200 z-50">
          <a href="/profile" class="block px-4 py-2 hover:bg-gray-200">Profile</a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-200">Logout</button>
          </form>
        </div>
      </div>
    @endauth
  </div>
</nav>

  <div class="container mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-3 gap-6">

  <!-- LATEST RUNS - KIRI -->
  <div class="md:col-span-2 bg-gray-900 rounded-lg p-6">
    <h2 class="text-xl font-bold text-white mb-4">LATEST RUNS</h2>
      
      <!-- Run Item -->
       <div class="space-y-6">
      <a href="{{ url('/games/1004') }}" class="block hover:bg-gray-800 transition rounded-lg px-1 py-2">
  <div class="flex gap-4 items-start border-b border-gray-700 pb-4">
    <img src="{{ asset('img/mario.jpg') }}" alt="Game" class="w-16 h-16 rounded" />
    <div class="flex-1">
      <h3 class="font-semibold text-lg">Super Mario 64</h3>
      <p class="text-white text-sm">Any%</p>
      <div class="flex items-center text-sm text-gray-400 mt-1">
        👑 1st &nbsp;&nbsp; 11m 52s 100ms &nbsp;&nbsp; by <span class="text-white ml-1">Midket</span>
        <span class="ml-auto">53 Minute ago</span>
      </div>
    </div>
  </div>
</a>

        <a href="{{ url('/games/1003') }}" class="block hover:bg-gray-800 transition rounded-lg px-1 py-2">
  <div class="flex gap-4 items-start border-b border-gray-700 pb-4">
    <img src="{{ asset('img/donkeykong.jpg') }}" alt="Game" class="w-16 h-16 rounded" />
    <div class="flex-1">
      <h3 class="font-semibold text-lg">Donkey Kong</h3>
      <p class="text-white text-sm">glitchless</p>
      <div class="flex items-center text-sm text-gray-400 mt-1">
        👑 1st &nbsp;&nbsp; 5m 10s &nbsp;&nbsp; by <span class="text-white ml-1">paynkiller01</span>
        <span class="ml-auto">1 hour ago</span>
      </div>
    </div>
  </div>
</a>

        <a href="{{ url('/games/1002') }}" class="block hover:bg-gray-800 transition rounded-lg px-1 py-2">
  <div class="flex gap-4 items-start border-b border-gray-700 pb-4">
    <img src="{{ asset('img/tetris.jpg') }}" alt="Game" class="w-16 h-16 rounded" />
    <div class="flex-1">
      <h3 class="font-semibold text-lg">Tetris</h3>
      <p class="text-white text-sm">Any%</p>
      <div class="flex items-center text-sm text-gray-400 mt-1">
        👑 1st &nbsp;&nbsp; 18m 12s 21ms &nbsp;&nbsp; by <span class="text-white ml-1">Tentacool</span>
        <span class="ml-auto">1.5 hour ago</span>
      </div>
    </div>
  </div>
</a>

        <a href="{{ url('/games/') }}" class="block hover:bg-gray-800 transition rounded-lg px-1 py-2">
  <div class="flex gap-4 items-start border-b border-gray-700 pb-4">
    <img src="{{ asset('img/pacman.jpg') }}" alt="Game" class="w-16 h-16 rounded" />
    <div class="flex-1">
      <h3 class="font-semibold text-lg">Pac-Man</h3>
      <p class="text-white text-sm">Any%</p>
      <div class="flex items-center text-sm text-gray-400 mt-1">
        👑 1st &nbsp;&nbsp; 12m 44s 211ms &nbsp;&nbsp; by <span class="text-white ml-1">Hideo Kojima</span>
        <span class="ml-auto">2 hour ago</span>
      </div>
    </div>
  </div>
</a>

        <!-- Tambahkan data run lainnya seperti pola di atas -->
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
          <h4 class="font-semibold">The 2nd Edition Twisted Metal Minute...</h4>
          <p class="text-xs text-gray-400">by <span class="text-white">AudiblySmiles</span> • 0 views</p>
        </div>
        <div>
          <p class="text-sm text-white">26 days ago</p>
          <h4 class="font-semibold">Jetrunner Demo $600 Speedrun Bounty...</h4>
          <p class="text-xs text-gray-400">by <span class="text-white">VexGamingTV</span> • 3 views</p>
        </div>
      </div>
    </div>

  </div> <!-- end sidebar -->

</div> <!-- end grid -->

  </div>

</body>
</html>