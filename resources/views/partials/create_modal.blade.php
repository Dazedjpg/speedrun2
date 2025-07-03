<!-- Tombol Trigger Modal -->
<button id="openCategoryModal" class="bg-maroon px-4 py-2 rounded hover:bg-red-800 text-white">
  + Tambah Kategori
</button>

<!-- Modal -->
<div id="categoryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-gray-900 p-6 rounded-lg w-full max-w-lg relative shadow-lg">

    <!-- Tombol Close -->
    <button id="closeCategoryModal" class="absolute top-2 right-3 text-white text-xl">&times;</button>

    <h2 class="text-2xl font-bold mb-6 text-white">Tambah Kategori Baru</h2>

    @if ($errors->any())
      <div class="bg-red-600 text-white p-3 rounded mb-4">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
      @csrf

      <div class="mb-4">
        <label class="block mb-1 font-semibold text-white">Nama Kategori</label>
        <input type="text" name="category_name" class="w-full p-2 rounded text-black" required>
      </div>

      <div class="mb-6">
        <label class="block mb-1 font-semibold text-white">Deskripsi</label>
        <textarea name="description" rows="3" class="w-full p-2 rounded text-black"></textarea>
      </div>

      <div class="flex justify-end gap-2">
        <button type="button" id="cancelCategoryModal" class="bg-gray-600 px-4 py-2 rounded hover:bg-gray-700 text-white">
          Batal
        </button>
        <button type="submit" class="bg-maroon px-4 py-2 rounded hover:bg-red-800 text-white">
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Script -->
<script>
  const openBtn = document.getElementById('openCategoryModal');
  const modal = document.getElementById('categoryModal');
  const closeBtn = document.getElementById('closeCategoryModal');
  const cancelBtn = document.getElementById('cancelCategoryModal');

  openBtn.onclick = () => modal.classList.remove('hidden');
  closeBtn.onclick = cancelBtn.onclick = () => modal.classList.add('hidden');
  window.onclick = (e) => { if (e.target == modal) modal.classList.add('hidden'); };
</script>
