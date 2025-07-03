<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard | Arena Speedrun</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .bg-maroon { background-color: #800000; }
    .text-maroon { color: #800000; }
  </style>
</head>
<body class="bg-black text-white font-sans min-h-screen pt-20">

@include('partials.navbar', ['style' => $style ?? ['nav' => 'bg-maroon']])

<div class="container mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-3 gap-6">

  <!-- ADMIN CONTROL PANEL -->
  <div class="md:col-span-2 bg-gray-900 rounded-lg p-6">
    <h2 class="text-xl font-bold text-white mb-4">ADMIN CONTROL PANEL</h2>

    <div class="space-y-4">
      <a href="{{ route('games.create') }}" class="block px-4 py-2 bg-maroon text-white rounded hover:bg-red-700 transition">
        + Tambah Game
      </a>
      <a href="{{ route('categories.create') }}" class="block px-4 py-2 bg-maroon text-white rounded hover:bg-red-700 transition">
        + Tambah Kategori
      </a>
      <a href="{{ route('games.index') }}" class="block px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700 transition">
        Kelola Semua Game
      </a>
      <a href="{{ route('admin.logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
         class="block px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600 transition">
        Logout
      </a>
      <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
        @csrf
      </form>
    </div>
  </div>

  <!-- ADMIN NEWS OR INFO -->
  <div class="bg-gray-900 rounded-lg p-6">
    <h2 class="text-xl font-bold text-white mb-4">ADMIN INFO</h2>
    <p class="text-sm text-gray-400 mb-1">Welcome back</p>
    <h3 class="text-white font-semibold mb-2">{{ Auth::guard('admin')->user()->admin_name }}</h3>
    <p class="text-sm text-gray-400">Manage your platform's games, categories, and monitor activities here.</p>
  </div>

</div>

</body>
</html>
