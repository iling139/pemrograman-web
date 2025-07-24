<!DOCTYPE html>
<html>
<head>
  <title>Kelola Menu Kantin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 font-sans">
  <div class="flex">
    
    <!-- Sidebar (tetap di tempat) -->
    <aside class="fixed top-0 left-0 h-screen w-64 bg-white shadow z-10">
      <?php $this->load->view('layouts/sidebar'); ?>
    </aside>
    <main class="ml-64 w-full p-6 overflow-y-auto">

      <!-- Konten Utama -->
      <div class="flex-1 p-6 overflow-y-auto bg-gray-50">
        <!-- Header & Tombol -->
        <div class="mb-6 flex flex-col sm:flex-row sm:justify-between sm:items-center">
          <h1 class="text-3xl font-bold text-gray-800 mb-4 sm:mb-0">Data Menu Kantin</h1>
          <button onclick="toggleForm('formTambah')" class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded shadow">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Tambah Menu
          </button>
        </div>

        <!-- Tambahkan Flash Message setelah ini -->
        <?php if ($this->session->flashdata('success')): ?>
  <div id="flash-success" class="mb-4 p-4 rounded-lg bg-green-100 border border-green-400 text-green-800 transition-opacity duration-500">
    <div class="flex justify-between items-center">
      <span><?= $this->session->flashdata('success'); ?></span>
      <button onclick="closeFlash('flash-success')" class="text-green-700 hover:text-green-900 font-bold text-xl">&times;</button>
    </div>
  </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
  <div id="flash-error" class="mb-4 p-4 rounded-lg bg-red-100 border border-red-400 text-red-800 transition-opacity duration-500">
    <div class="flex justify-between items-center">
      <span><?= $this->session->flashdata('error'); ?></span>
      <button onclick="closeFlash('flash-error')" class="text-red-700 hover:text-red-900 font-bold text-xl">&times;</button>
    </div>
  </div>
<?php endif; ?>


        <!-- Form Tambah -->
        <div id="formTambah" class="bg-white p-6 rounded-lg shadow-md mb-6 hidden">
          <form action="<?= site_url('menu/add'); ?>" method="POST" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-gray-700 font-medium mb-1">Nama Menu</label>
                <input type="text" name="nama_menu" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
              </div>
              <div>
                <label class="block text-gray-700 font-medium mb-1">Harga</label>
                <input type="number" name="harga" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
              </div>
              <div>
                <label class="block text-gray-700 font-medium mb-1">Stok</label>
                <input type="number" name="stok" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
              </div>
              <div>
                <label class="block text-gray-700 font-medium mb-1">Gambar Menu</label>
                <input type="file" name="gambar" class="w-full border border-gray-300 rounded px-3 py-2" />
              </div>
            </div>
            <div class="mt-6 flex justify-end">
              <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">Simpan</button>
              <button type="button" onclick="toggleForm('formTambah')" class="ml-3 px-4 py-2 border border-gray-300 text-gray-700 rounded">Batal</button>
            </div>
          </form>
        </div>
        <!-- Form Edit -->
        <div id="formEdit" class="bg-white p-6 rounded-lg shadow-md mb-6 hidden">
          <form id="editForm" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="edit_id">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-gray-700 font-medium mb-1">Nama Menu</label>
                <input type="text" name="nama_menu" id="edit_nama" required class="w-full border border-gray-300 rounded px-3 py-2" />
              </div>
              <div>
                <label class="block text-gray-700 font-medium mb-1">Harga</label>
                <input type="number" name="harga" id="edit_harga" required class="w-full border border-gray-300 rounded px-3 py-2" />
              </div>
              <div>
                <label class="block text-gray-700 font-medium mb-1">Stok</label>
                <input type="number" name="stok" id="edit_stok" required class="w-full border border-gray-300 rounded px-3 py-2" />
              </div>
              <div>
                <label class="block text-gray-700 font-medium mb-1">Gambar Baru (Opsional)</label>
                <input type="file" name="gambar" class="w-full border border-gray-300 rounded px-3 py-2" />
              </div>
            </div>
            <div class="mt-6 flex justify-end">
              <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">Update</button>
              <button type="button" onclick="toggleForm('formEdit')" class="ml-3 px-4 py-2 border border-gray-300 text-gray-700 rounded">Batal</button>
            </div>
          </form>
        </div>


        <!-- Tabel -->
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
          <table class="min-w-full text-sm text-gray-700">
            <thead class="bg-gray-100 text-xs uppercase font-semibold text-gray-600">
              <tr>
                <th class="px-6 py-3 text-left">Gambar</th>
                <th class="px-6 py-3 text-left">Nama Menu</th>
                <th class="px-6 py-3 text-left">Harga</th>
                <th class="px-6 py-3 text-left">Stok</th>
                <th class="px-6 py-3 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($menu as $m): ?>
              <tr class="border-t hover:bg-gray-50">
                <td class="px-6 py-3">
                  <?php if ($m->gambar): ?>
                    <img src="<?= base_url('uploads/menu/' . $m->gambar); ?>" class="w-16 h-16 object-cover rounded shadow" />
                  <?php else: ?>
                    <span class="italic text-gray-400">Tidak ada</span>
                  <?php endif; ?>
                </td>
                <td class="px-6 py-3"><?= $m->nama_menu ?></td>
                <td class="px-6 py-3">Rp <?= number_format($m->harga, 0, ',', '.') ?></td>
                <td class="px-6 py-3"><?= $m->stok ?></td>
                <td class="px-6 py-3 text-center space-x-2">
                  <button onclick='isiFormEdit(<?= json_encode($m) ?>)' class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">Edit</button>
                  <a href="<?= site_url('menu/delete/'.$m->id); ?>" onclick="return confirm('Hapus menu ini?')" class="inline-block bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </Main>
  </div>

  <script>
  function toggleForm(formId) {
  const formTambah = document.getElementById('formTambah');
  const formEdit = document.getElementById('formEdit');

  if (formId === 'formTambah') {
    formTambah.classList.toggle('hidden');
    formEdit.classList.add('hidden');
  } else if (formId === 'formEdit') {
    formEdit.classList.toggle('hidden');
    formTambah.classList.add('hidden');
  }
}


  function isiFormEdit(menu) {
  document.getElementById('edit_id').value = menu.id;
  document.getElementById('edit_nama').value = menu.nama_menu;
  document.getElementById('edit_harga').value = menu.harga;
  document.getElementById('edit_stok').value = menu.stok;

  // Set action langsung ke URL edit/id
  document.getElementById('editForm').action = '<?= site_url("menu/edit/") ?>' + menu.id;

  toggleForm('formEdit');
}
// Auto hide after 3 seconds
window.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
      const success = document.getElementById('flash-success');
      const error = document.getElementById('flash-error');

      if (success) success.style.opacity = 0;
      if (error) error.style.opacity = 0;

      // Remove from DOM after transition
      setTimeout(() => {
        if (success) success.remove();
        if (error) error.remove();
      }, 500); // after transition
    }, 3000);
  });

  // Manual close button
  function closeFlash(id) {
    const el = document.getElementById(id);
    if (el) {
      el.style.opacity = 0;
      setTimeout(() => el.remove(), 500);
    }
  }

  lucide.createIcons();
</script>


</body>
</html>
