<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign In</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">

  <form method="POST" action="{{ route('signin') }}" class="bg-gray-800 p-8 rounded shadow-md w-96">
    @csrf
    <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

    @if (session('error'))
      <div class="bg-red-600 p-2 rounded text-center mb-4">
        {{ session('error') }}
      </div>
    @endif

    <div class="mb-4">
      <label class="block mb-1 font-semibold">Username</label>
      <input type="text" name="username" required class="w-full px-4 py-2 rounded bg-gray-700 focus:outline-none">
    </div>

    <div class="mb-6">
      <label class="block mb-1 font-semibold">Password</label>
      <input type="password" name="password" required class="w-full px-4 py-2 rounded bg-gray-700 focus:outline-none">
    </div>

    <button type="submit" class="bg-red-600 hover:bg-red-700 w-full py-2 rounded font-semibold">
      Sign In
    </button>
  </form>

</body>
</html>
