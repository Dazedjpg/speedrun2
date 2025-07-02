<!DOCTYPE html>
<html>
<head>
  <title>Token</title>
</head>
<body>
  <h1>Token JWT Kamu:</h1>
  <p>{{ $token }}</p>

  <script>
    localStorage.setItem('jwt_token', '{{ $token }}');
    // Redirect ke dashboard atau halaman utama
    window.location.href = "/";
  </script>
</body>
</html>
