<nav class="{{ $style['nav'] ?? 'bg-maroon' }} text-white px-6 py-3 flex justify-between items-center fixed top-0 left-0 w-full z-50 shadow-md">
  <!-- Logo -->
  <div class="flex items-center gap-4">
    <span class="text-xl font-bold">Speedrunner</span>
    <a href="/games" class="hover:underline">Games</a>
  </div>

    <!-- Tengah: Search bar -->
    <div class="relative w-full md:w-64">
      <input
        id="search-input"
        type="text"
        placeholder="Search games or users..."
        class="w-full px-10 py-1 rounded-md text-black focus:outline-none focus:ring-2 focus:ring-maroon"
        autocomplete="off"
      />
      <img src="{{ asset('img/search-icon.png') }}" alt="search" class="w-4 h-4 absolute top-1/2 left-3 transform -translate-y-1/2" />
      <ul id="suggestions" class="absolute left-0 w-full bg-white text-black rounded shadow-lg mt-1 hidden z-50"></ul>
    </div>

    <!-- Kanan: Auth -->
    <div class="flex gap-2 mt-2 md:mt-0">
      @guest
        <a href="{{ route('signup.form') }}" class="text-white hover:underline text-sm md:text-base">Sign Up</a>
        <a href="{{ route('signin.form') }}" class="bg-white text-maroon px-3 py-1 rounded text-sm md:text-base hover:bg-gray-200">Sign In</a>
      @endguest

      @auth
        <div class="relative group">
          <button class="flex items-center text-white focus:outline-none">
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

  </div>
</nav>



<script>
document.addEventListener('DOMContentLoaded', () => {
  const input = document.getElementById('search-input');
  const suggestions = document.getElementById('suggestions');

  input.addEventListener('input', async () => {
    const query = input.value.trim();

    if (query.length === 0) {
      suggestions.innerHTML = '';
      suggestions.classList.add('hidden');
      return;
    }

    try {
      const response = await fetch(`/search/suggest?q=${encodeURIComponent(query)}`);
      const results = await response.json();

      if (results.length === 0) {
        suggestions.innerHTML = '<li class="px-4 py-2 text-gray-500">No results found.</li>';
      } else {
        suggestions.innerHTML = results.map(item => `
          <li class="px-4 py-2 hover:bg-gray-200 cursor-pointer" onclick="window.location='${item.url}'">
            <span class="font-semibold capitalize">${item.type}</span>: ${item.name}
          </li>
        `).join('');
      }

      suggestions.classList.remove('hidden');
    } catch (err) {
      console.error('Error fetching suggestions:', err);
      suggestions.classList.add('hidden');
    }
  });

  document.addEventListener('click', (e) => {
    if (!e.target.closest('#search-input') && !e.target.closest('#suggestions')) {
      suggestions.classList.add('hidden');
    }
  });
});
</script>
