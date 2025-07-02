document.addEventListener('DOMContentLoaded', function () {
  const token = localStorage.getItem('jwt_token');

  if (token) {
    fetch('/api/user', {
      headers: {
        'Authorization': 'Bearer ' + token
      }
    })
    .then(res => res.json())
    .then(data => {
      console.log("User from token:", data);
    });
  }
});
