<!DOCTYPE html>
<html>
<head>
  <title>Kelola Menu Kantin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6">
  <h1 class="text-xl font-bold mb-4">Kelola Menu Kantin</h1>
  <a href="<?= site_url('menu/add'); ?>" class="bg-green-500 text-white px-3 py-1 rounded">Tambah Menu</a>

  <table class="table-auto w-full mt-4 border">
    <thead>
      <tr class="bg-gray-200">
        <th class="border px-2 py-1">Nama Menu</th>
        <th class="border px-2 py-1">Harga</th>
        <th class="border px-2 py-1">Stok</th>
        <th class="border px-2 py-1">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($menu as $m): ?>
      <tr>
        <td class="border px-2 py-1"><?= $m->nama_menu ?></td>
        <td class="border px-2 py-1"><?= $m->harga ?></td>
        <td class="border px-2 py-1"><?= $m->stok ?></td>
        <td class="border px-2 py-1">
          <a href="<?= site_url('menu/edit/'.$m->id); ?>" class="bg-blue-500 text-white px-2 py-1 rounded">Edit</a>
          <a href="<?= site_url('menu/delete/'.$m->id); ?>" onclick="return confirm('Hapus?')" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <br>
  <a href="<?= site_url('dashboard'); ?>" class="bg-gray-500 text-white px-3 py-1 rounded">Kembali</a>
</body>
</html>
