<!DOCTYPE html>
<html>
<head>
  <title>Kelola Pengguna</title>
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
          <h1 class="text-3xl font-bold text-gray-800 mb-4 sm:mb-0">Data Pengguna Kantin</h1>
          <button onclick="toggleForm('formTambah')" class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded shadow">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Tambah Pengguna
          </button>
        </div>

        <!-- Form Tambah -->
        <div id="formTambah" class="bg-white p-6 rounded-lg shadow-md mb-6 hidden">
          <form action="<?= site_url('pengguna/add'); ?>" method="POST" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
              </div>
              <div>
                <label class="block text-gray-700 font-medium mb-1">Username</label>
                <input type="text" name="username" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
              </div>
              <div>
                <label class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
              </div>
              <div>
                <label class="block text-gray-700 font-medium mb-1">Role</label>
                <select name="role" class="w-full border border-gray-300 rounded px-3 py-2">
                  <option value="kasir">Kasir</option>
                  <option value="admin">Admin</option>
                </select>
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
                <label class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="edit_nama" required class="w-full border border-gray-300 rounded px-3 py-2" />
              </div>
              <div>
                <label class="block text-gray-700 font-medium mb-1">Username</label>
                <input type="text" name="username" id="edit_username" required class="w-full border border-gray-300 rounded px-3 py-2" />
              </div>
              <div>
                <label class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password" id="edit_password" required class="w-full border border-gray-300 rounded px-3 py-2" />
              </div>
              <div>
                <label class="block text-gray-700 font-medium mb-1">Role</label>
                <select name="role" id="edit_role" class="w-full border border-gray-300 rounded px-3 py-2">
                  <option value="kasir">Kasir</option>
                  <option value="admin">Admin</option>
                </select>
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
                <th class="px-6 py-3 text-left">Nama Lengkap</th>
                <th class="px-6 py-3 text-left">Username</th>
                <th class="px-6 py-3 text-left">Role</th>
                <th class="px-6 py-3 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($pengguna as $p): ?>
              <tr class="border-t hover:bg-gray-50">
                <td class="border p-2"><?= $p->nama_lengkap ?></td>
                <td class="border p-2"><?= $p->username ?></td>
                <td class="border p-2"><?= ucfirst($p->role) ?></td>
                <td class="border p-2">
                  <button onclick='isiFormEdit(<?= json_encode($p) ?>)' class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">Edit</button>
                  <a href="<?= site_url('pengguna/hapus/'.$p->id); ?>" onclick="return confirm('Hapus pengguna ini?')" class="inline-block bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</a>
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


function isiFormEdit(pengguna) {
  document.getElementById('edit_id').value = pengguna.id;
  document.getElementById('edit_nama').value = pengguna.nama_lengkap;
  document.getElementById('edit_username').value = pengguna.username;
  document.getElementById('edit_role').value = pengguna.role;

  document.getElementById('editForm').action = '<?= site_url("pengguna/edit/") ?>' + pengguna.id;
  toggleForm('formEdit');
}


lucide.createIcons();
</script>

</body>
</html>
