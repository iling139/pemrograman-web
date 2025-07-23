<!-- Sidebar Modern dan Ramping -->
<div id="sidebar" class="bg-gray-900 text-white h-screen flex flex-col w-16 md:w-64 transition-all duration-300">
  <div class="flex items-center justify-center md:justify-start md:px-4 py-4">
    <i data-lucide="chef-hat" class="w-6 h-6 text-green-400"></i>
    <span class="hidden md:inline ml-2 text-green-400 font-bold text-xl">Admin Kantin</span>
  </div>

  <nav class="flex-1 flex flex-col space-y-2 md:px-4">
    <a href="<?= site_url('dashboard'); ?>" class="group flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-700 <?= uri_string() == 'dashboard' ? 'bg-gray-700' : '' ?>">
      <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
      <span class="hidden md:inline">Dashboard</span>
    </a>

    <?php if ($this->session->userdata('role') == 'admin'): ?>
      <a href="<?= site_url('menu'); ?>" class="group flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-700 <?= uri_string() == 'menu' ? 'bg-gray-700' : '' ?>">
        <i data-lucide="utensils" class="w-5 h-5"></i>
        <span class="hidden md:inline">Kelola Menu</span>
      </a>
      <a href="<?= site_url('pengguna'); ?>" class="group flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-700 <?= uri_string() == 'pengguna' ? 'bg-gray-700' : '' ?>">
        <i data-lucide="users" class="w-5 h-5"></i>
        <span class="hidden md:inline">Kelola Pengguna</span>
      </a>
    <?php endif; ?>

    <a href="<?= site_url('transaksi'); ?>" class="group flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-700 <?= uri_string() == 'transaksi' ? 'bg-gray-700' : '' ?>">
      <i data-lucide="shopping-cart" class="w-5 h-5"></i>
      <span class="hidden md:inline">Transaksi</span>
    </a>
    
    <a href="<?= site_url('laporan'); ?>" class="group flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-700 <?= uri_string() == 'laporan' ? 'bg-gray-700' : '' ?>">
      <i data-lucide="file-text" class="w-5 h-5"></i>
      <span class="hidden md:inline">Laporan</span>
    </a>
  </nav>

  <!-- Tombol Logout -->
  <div class="md:px-4 mt-auto pb-4">
    <a href="<?= site_url('auth/logout'); ?>" class="group flex items-center gap-2 bg-red-500 hover:bg-red-600 px-3 py-2 rounded">
      <i data-lucide="log-out" class="w-5 h-5"></i>
      <span class="hidden md:inline">Logout</span>
    </a>
  </div>
</div>

<!-- Main Content -->
<main class="ml-64 w-full p-6 overflow-y-auto">
    <!-- Isi halaman laporan di sini -->
  </main>


<script>
  lucide.createIcons();
</script>
