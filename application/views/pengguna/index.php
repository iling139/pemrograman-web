<!DOCTYPE html>
<html>
<head>
  <title>Kelola Pengguna</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-100">

  <h1 class="text-2xl font-bold mb-4">Data Pengguna</h1>

  <a href="<?= site_url('pengguna/tambah') ?>" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Pengguna</a>

  <div class="bg-white shadow rounded overflow-x-auto">
    <table class="table-auto w-full border">
      <thead class="bg-gray-200">
        <tr>
          <th class="border p-2">Nama Lengkap</th>
          <th class="border p-2">Username</th>
          <th class="border p-2">Role</th>
          <th class="border p-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($pengguna as $p): ?>
        <tr>
          <td class="border p-2"><?= $p->nama_lengkap ?></td>
          <td class="border p-2"><?= $p->username ?></td>
          <td class="border p-2"><?= ucfirst($p->role) ?></td>
          <td class="border p-2">
            <a href="<?= site_url('pengguna/edit/'.$p->id) ?>" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
            <a href="<?= site_url('pengguna/hapus/'.$p->id) ?>" class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Hapus pengguna ini?')">Hapus</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    <a href="<?= site_url('dashboard'); ?>" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
  </div>

</body>
</html>
