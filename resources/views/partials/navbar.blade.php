<nav class="{{ $style['nav'] ?? 'bg-maroon' }} text-white px-6 py-3 flex justify-between items-center fixed top-0 left-0 w-full z-50 shadow-md">
  <!-- Left: Logo + Links -->
  <div class="flex items-center gap-6">
    <a href="/" class="text-xl font-bold hover:underline">Speedrunner</a>
    <a href="/" class="hover:underline">Home</a>
    <a href="/games" class="hover:underline">Games</a>
  </div>

  <!-- Right: Search & Auth -->
  <div class="flex items-center gap-4 relative">
    <!-- Search Input with Suggestions -->
    <div class="relative">
      <input
        id="search-input"
        type="text"
        placeholder="Search..."
        class="px-3 py-1 rounded-md text-black focus:outline-none focus:ring-2 focus:ring-maroon w-56"
        autocomplete="off"
      />
      <ul id="suggestions" class="absolute left-0 w-full bg-white text-black rounded shadow-lg mt-1 hidden z-50"></ul>
    </div>

    @guest
      <a href="{{ route('signin.form') }}" class="bg-white text-maroon px-4 py-1 rounded hover:bg-gray-100 transition">Sign In</a>
    @endguest

    @auth
      <!-- Profile Dropdown -->
      <div class="relative group">
        <button class="flex items-center focus:outline-none">
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

<!-- Suggestion Script -->
<script>
  const input = document.getElementById('search-input');
  const suggestions = document.getElementById('suggestions');

  const searchData = [
    @foreach($games as $g)
      {
        type: 'Game',
        name: '{{ $g['game_title'] }}',
        url: '/games/{{ $g['game_id'] }}',
        image: '{{ $g['cover_image'] }}'
      },
    @endforeach
    @foreach($users as $u)
      {
        type: 'User',
        name: '{{ $u['name'] }}',
        url: '/profile/{{ $u['user_id'] }}'
      },
    @endforeach
  ];

  input.addEventListener('input', () => {
    const query = input.value.toLowerCase().trim();
    suggestions.innerHTML = '';

    if (!query) {
      suggestions.classList.add('hidden');
      return;
    }

    const results = searchData.filter(item =>
      item.name.toLowerCase().includes(query)
    );

    if (results.length === 0) {
      suggestions.classList.add('hidden');
      return;
    }

    results.forEach(result => {
      const li = document.createElement('li');
      li.className = 'px-3 py-2 hover:bg-gray-200 cursor-pointer';

      if (result.type === 'Game') {
        li.innerHTML = `
          <div class="flex items-center gap-2">
            <img src="/img/${result.image}" alt="${result.name}" class="w-8 h-8 object-cover rounded" />
            <span><span class="font-semibold">${result.type}:</span> ${result.name}</span>
          </div>
        `;
      } else {
        li.innerHTML = `<span class="font-semibold">${result.type}:</span> ${result.name}`;
      }

      li.onclick = () => window.location.href = result.url;
      suggestions.appendChild(li);
    });

    suggestions.classList.remove('hidden');
  });

  document.addEventListener('click', (e) => {
    if (!input.contains(e.target) && !suggestions.contains(e.target)) {
      suggestions.classList.add('hidden');
    }
  });
</script>
