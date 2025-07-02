<!DOCTYPE html>
<html lang="en" class="bg-black text-white">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Speedrun')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-maroon { background-color: #800000; }
    </style>
</head>
<body class="font-sans min-h-screen p-8">
    @yield('content')
</body>
</html>
