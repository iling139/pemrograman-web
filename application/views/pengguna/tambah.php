<!DOCTYPE html>
<html>
<head>
  <title>Tambah Pengguna</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-100">

  <h1 class="text-2xl font-bold mb-4">Tambah Pengguna</h1>

  <form method="POST" class="bg-white p-4 rounded shadow max-w-md">
    <div class="mb-3">
      <label class="block font-semibold">Nama Lengkap</label>
      <input type="text" name="nama_lengkap" required class="border p-2 w-full rounded">
    </div>
    <div class="mb-3">
      <label class="block font-semibold">Username</label>
      <input type="text" name="username" required class="border p-2 w-full rounded">
    </div>
    <div class="mb-3">
      <label class="block font-semibold">Password</label>
      <input type="password" name="password" required class="border p-2 w-full rounded">
    </div>
    <div class="mb-3">
      <label class="block font-semibold">Role</label>
      <select name="role" class="border p-2 w-full rounded">
        <option value="kasir">Kasir</option>
        <option value="admin">Admin</option>
      </select>
    </div>
    <div class="flex justify-between">
      <a href="<?= site_url('pengguns'); ?>" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </div>
  </form>

</body>
</html>
