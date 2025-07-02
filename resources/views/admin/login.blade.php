<!DOCTYPE html>
<html>
<head>
  <title>Login Admin</title>
</head>
<body>
  <h2>Admin Login</h2>

  <form method="POST" action="{{ route('admin.login.submit') }}">
    @csrf
    <input type="text" name="admin_name" placeholder="Admin Name" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
  </form>

  @if($errors->any())
    <p style="color: red;">{{ $errors->first() }}</p>
  @endif
</body>
</html>
