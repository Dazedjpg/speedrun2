<!DOCTYPE html>
<html>
<head>
  <title>Tambah Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6">
  <div class="max-w-md mx-auto bg-gray-800 p-6 rounded">
    <h2 class="text-xl font-bold mb-4">Tambah Admin</h2>

    @if ($errors->any())
      <ul class="text-red-400 mb-4">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    @endif

    <form action="{{ route('admin.register') }}" method="POST">
      @csrf
      <label class="block mb-2">Nama</label>
      <input type="text" name="admin_name" class="w-full p-2 rounded text-black mb-4" required>

      <label class="block mb-2">Email</label>
      <input type="email" name="email" class="w-full p-2 rounded text-black mb-4" required>

      <label class="block mb-2">Password</label>
      <input type="password" name="password" class="w-full p-2 rounded text-black mb-4" required>

      <button type="submit" class="bg-maroon hover:bg-red-800 text-white px-4 py-2 rounded">Simpan</button>
    </form>
  </div>
</body>
</html>
