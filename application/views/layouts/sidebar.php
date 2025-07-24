<!-- Sidebar Modern & Elegan -->
<div id="sidebar" class="bg-gray-900 text-white h-screen flex flex-col w-16 md:w-64 transition-all duration-300">
  <!-- Header Sidebar -->
  <div class="flex items-center justify-center md:justify-start md:px-4 py-5 border-b border-gray-800">
    <i data-lucide="chef-hat" class="w-6 h-6 text-green-400"></i>
    <span class="hidden md:inline ml-2 text-green-400 font-bold text-xl tracking-wide">Kantin Digital</span>
  </div>

  <!-- Navigation -->
  <nav class="flex-1 flex flex-col space-y-1 md:px-4 mt-4">
    <a href="<?= site_url('dashboard'); ?>" class="group flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-800 transition <?= uri_string() == 'dashboard' ? 'bg-gray-800' : '' ?>">
      <i data-lucide="layout-dashboard" class="w-5 h-5 <?= uri_string() == 'dashboard' ? 'text-green-400' : '' ?>"></i>
      <span class="hidden md:inline text-sm">Dashboard</span>
    </a>
    <a href="<?= site_url('transaksi'); ?>" class="group flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-800 transition <?= uri_string() == 'transaksi' ? 'bg-gray-800' : '' ?>">
      <i data-lucide="shopping-cart" class="w-5 h-5 <?= uri_string() == 'transaksi' ? 'text-green-400' : '' ?>"></i>
      <span class="hidden md:inline text-sm">Transaksi</span>
    </a>

    <?php if ($this->session->userdata('role') == 'admin'): ?>
      <a href="<?= site_url('menu'); ?>" class="group flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-800 transition <?= uri_string() == 'menu' ? 'bg-gray-800' : '' ?>">
        <i data-lucide="utensils" class="w-5 h-5 <?= uri_string() == 'menu' ? 'text-green-400' : '' ?>"></i>
        <span class="hidden md:inline text-sm">Kelola Menu</span>
      </a>
      <a href="<?= site_url('pengguna'); ?>" class="group flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-800 transition <?= uri_string() == 'pengguna' ? 'bg-gray-800' : '' ?>">
        <i data-lucide="users" class="w-5 h-5 <?= uri_string() == 'pengguna' ? 'text-green-400' : '' ?>"></i>
        <span class="hidden md:inline text-sm">Kelola Pengguna</span>
      </a>
      <a href="<?= site_url('laporan'); ?>" class="group flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-800 transition <?= uri_string() == 'laporan' ? 'bg-gray-800' : '' ?>">
        <i data-lucide="file-text" class="w-5 h-5 <?= uri_string() == 'laporan' ? 'text-green-400' : '' ?>"></i>
        <span class="hidden md:inline text-sm">Laporan</span>
      </a>
    <?php endif; ?>

    
  </nav>

  <!-- Logout -->
  <div class="md:px-4 mt-auto pb-5 border-t border-gray-800">
    <a href="<?= site_url('auth/logout'); ?>" class="group flex items-center gap-3 px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700 transition text-white">
      <i data-lucide="log-out" class="w-5 h-5"></i>
      <span class="hidden md:inline text-sm">Logout</span>
    </a>
  </div>
</div>

<script>
  lucide.createIcons();
</script>
