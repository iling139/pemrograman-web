<!DOCTYPE html>
<html>
<head>
  <title>Dashboard Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
      <div class="flex-1 p-4 overflow-y-auto">
        
        <!-- Tombol toggle sidebar mobile -->
        <div class="md:hidden mb-4">
          <button onclick="toggleSidebar()" class="bg-gray-800 text-white px-4 py-2 rounded">☰ Menu</button>
        </div>

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
          <h1 class="text-2xl font-bold text-gray-700">Dashboard</h1>
          <p class="text-gray-600">Halo, <b><?= $nama ?></b> (<?= $role ?>)</p>
        </div>

        <!-- Ringkasan & Navigasi Cepat -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
          <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Ringkasan Hari Ini</h2>
            <p>Total Transaksi: <b><?= $total_transaksi ?></b></p>
          </div>
          <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Transaksi Cepat</h2>
            <a href="<?= site_url('transaksi'); ?>" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Buat Transaksi</a>
          </div>
        </div>

        <!-- Grafik -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Grafik Penghasilan</h2>
            <canvas id="grafikPenghasilan" height="150"></canvas>
          </div>
          <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Menu Terlaris</h2>
            <canvas id="donutMenu" height="150"></canvas>
          </div>
        </div>
      </div>
    </main>
  </div>

<!-- Chart JS -->
<script>
const ctx = document.getElementById('grafikPenghasilan').getContext('2d');
new Chart(ctx, {
  type: 'line',
  data: {
    labels: <?= json_encode($labels_harian) ?>,
    datasets: [{
      label: 'Penghasilan Harian (Rp)',
      data: <?= json_encode($penghasilan_harian) ?>,
      borderColor: '#22c55e',
      backgroundColor: 'rgba(34, 197, 94, 0.2)',
      fill: true,
      tension: 0.4,
    }]
  },
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          callback: value => 'Rp ' + value.toLocaleString('id-ID')
        }
      }
    }
  }
});

const ctx2 = document.getElementById('donutMenu').getContext('2d');
new Chart(ctx2, {
  type: 'doughnut',
  data: {
    labels: <?= json_encode(array_column($menu_terlaris, 'nama_menu')) ?>,
    datasets: [{
      data: <?= json_encode(array_column($menu_terlaris, 'total')) ?>,
      backgroundColor: [
        '#10B981', '#3B82F6', '#F59E0B', '#EF4444',
        '#6366F1', '#14B8A6', '#A855F7', '#F472B6'
      ],
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { position: 'right' }
    }
  }
});
</script>

<!-- Toggle Sidebar -->
<script>
function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  sidebar.classList.toggle('hidden');
}
lucide.createIcons();

</script>

</body>
</html>
