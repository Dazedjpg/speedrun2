<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login | Arena Speedrun</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen flex items-center justify-center">

  <div class="bg-gray-900 p-8 rounded shadow max-w-md w-full">
    <h2 class="text-2xl font-bold mb-6 text-center text-maroon-500">Admin Login</h2>

    @if(session('success'))
      <div class="bg-green-600 p-3 rounded text-white mb-4 text-center">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="bg-red-600 p-3 rounded text-white mb-4">
        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <form action="{{ route('admin.login') }}" method="POST" class="space-y-4">
      @csrf
      <div>
        <label class="block mb-1 font-semibold">Email</label>
        <input type="email" name="email" class="w-full p-2 rounded text-black" required value="{{ old('email') }}">
      </div>

      <div>
        <label class="block mb-1 font-semibold">Password</label>
        <input type="password" name="password" class="w-full p-2 rounded text-black" required>
      </div>

      <div class="flex justify-between items-center">
        <a href="/" class="text-sm text-gray-400 hover:underline">← Kembali ke Home</a>
        <button type="submit" class="bg-maroon px-4 py-2 rounded text-white hover:bg-red-800">Login</button>
      </div>
    </form>
  </div>

</body>
</html>
