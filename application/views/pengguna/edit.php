<form method="POST" class="bg-white p-4 rounded shadow max-w-md">
  <div class="mb-3">
    <label class="block font-semibold">Nama Lengkap</label>
    <input type="text" name="nama_lengkap" value="<?= $pengguna->nama_lengkap ?>" required class="border p-2 w-full rounded">
  </div>
  <div class="mb-3">
    <label class="block font-semibold">Username</label>
    <input type="text" name="username" value="<?= $pengguna->username ?>" required class="border p-2 w-full rounded">
  </div>
  <div class="mb-3">
    <label class="block font-semibold">Password (kosongkan jika tidak diubah)</label>
    <input type="password" name="password" class="border p-2 w-full rounded">
  </div>
  <div class="mb-3">
    <label class="block font-semibold">Role</label>
    <select name="role" class="border p-2 w-full rounded">
      <option value="kasir" <?= $pengguna->role=='kasir'?'selected':'' ?>>Kasir</option>
      <option value="admin" <?= $pengguna->role=='admin'?'selected':'' ?>>Admin</option>
    </select>
  </div>
  <div class="flex justify-between">
    <a href="<?= site_url('pengguna'); ?>" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
  </div>
</form>
