<!DOCTYPE html>
<html>
<head>
  <title>Tambah Menu</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-md mx-auto bg-white p-4 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Tambah Menu</h1>

    <!-- Tambahkan enctype -->
    <form method="POST" action="<?= site_url('menu/add'); ?>" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="block font-semibold">Nama Menu</label>
        <input type="text" name="nama_menu" required class="w-full border p-2 rounded">
      </div>

      <div class="mb-3">
        <label class="block font-semibold">Harga</label>
        <input type="number" step="0.01" name="harga" required class="w-full border p-2 rounded">
      </div>

      <div class="mb-3">
        <label class="block font-semibold">Stok</label>
        <input type="number" name="stok" required class="w-full border p-2 rounded">
      </div>
      
      <!-- Input file untuk gambar menu -->
      <div class="mb-3">
        <label class="block font-semibold">Gambar Menu</label>
        <input type="file" name="gambar_menu" accept="image/*" required class="w-full border p-2 rounded">
      </div>

      <div class="flex justify-between">
        <a href="<?= site_url('menu'); ?>" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
      </div>
    </form>
  </div>
</body>
</html>
