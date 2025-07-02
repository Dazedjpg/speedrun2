<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign In | Arena Speedrun</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .bg-maroon { background-color: #800000; }
  </style>
</head>
<body class="bg-black text-white min-h-screen flex items-center justify-center">

  <div class="bg-gray-900 p-8 rounded-lg shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Sign In</h2>

<form action="/signin" method="POST">


      @csrf
  @if (session('error'))
  <div class="bg-red-500 text-white p-3 mb-4 rounded">
    {{ session('error') }}
  </div>
  @endif
      <div class="mb-4">
        <label for="email" class="block mb-1">Email</label>
        <input type="email" id="email" name="email" class="w-full px-3 py-2 rounded text-black" required>
      </div>

      <div class="mb-4">
        <label for="password" class="block mb-1">Password</label>
        <input type="password" id="password" name="password" class="w-full px-3 py-2 rounded text-black" required>
      </div>

      <button type="submit" class="w-full bg-maroon text-white py-2 rounded hover:bg-red-800">
        Sign In
      </button>
    </form>

    <p class="mt-4 text-center text-sm text-gray-400">
      Don't have an account? 
      <a href="{{ route('signup.form') }}" class="text-maroon hover:underline">Sign Up</a>
    </p>
  </div>

</body>
</html>
