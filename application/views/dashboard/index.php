<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="flex">
  <!-- Sidebar -->
  <aside class="fixed top-0 left-0 h-screen w-16 md:w-64 bg-gray-900 text-white transition-all duration-300 z-10">
    <?php $this->load->view('layouts/sidebar'); ?>
  </aside>

  <!-- Main -->
  <main class="ml-16 md:ml-64 w-full p-8 space-y-8">
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
          <i data-lucide="layout-dashboard" class="w-7 h-7 text-blue-600"></i> Dashboard
        </h1>
        <p class="text-gray-600 mt-1">Selamat datang, <b><?= $nama ?></b> (<?= $role ?>)</p>
      </div>
    </div>

    <!-- Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
      <div class="bg-white rounded-lg shadow p-5">
        <div class="flex items-center gap-3 mb-2">
          <i data-lucide="clipboard-list" class="w-6 h-6 text-green-500"></i>
          <h2 class="text-lg font-semibold text-gray-700">Ringkasan Hari Ini</h2>
        </div>
        <p class="text-gray-600">Total Transaksi: <span class="font-bold text-gray-800"><?= $total_transaksi ?></span></p>
      </div>
      <div class="bg-white rounded-lg shadow p-5">
        <div class="flex items-center gap-3 mb-2">
          <i data-lucide="plus-circle" class="w-6 h-6 text-blue-500"></i>
          <h2 class="text-lg font-semibold text-gray-700">Transaksi Cepat</h2>
        </div>
        <a href="<?= site_url('transaksi'); ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
          Buat Transaksi
        </a>
      </div>
    </div>

    <!-- Grafik -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <div class="bg-white p-6 rounded shadow">
        <div class="flex items-center gap-2 mb-4">
          <i data-lucide="line-chart" class="w-6 h-6 text-indigo-500"></i>
          <h2 class="text-lg font-semibold text-gray-800">Grafik Penghasilan</h2>
        </div>
        <canvas id="grafikPenghasilan" height="150"></canvas>
      </div>

      <div class="bg-white p-6 rounded shadow">
        <div class="flex items-center gap-2 mb-4">
          <i data-lucide="pie-chart" class="w-6 h-6 text-purple-500"></i>
          <h2 class="text-lg font-semibold text-gray-800">Menu Terlaris</h2>
        </div>
        <canvas id="donutMenu" height="150"></canvas>
      </div>
    </div>
  </main>
</div>

<!-- Chart.js -->
<script>
const ctx = document.getElementById('grafikPenghasilan').getContext('2d');
new Chart(ctx, {
  type: 'line',
  data: {
    labels: <?= json_encode($labels_harian) ?>,
    datasets: [{
      label: 'Penghasilan Harian (Rp)',
      data: <?= json_encode($penghasilan_harian) ?>,
      borderColor: '#3B82F6',
      backgroundColor: 'rgba(59, 130, 246, 0.2)',
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
        '#22c55e', '#3B82F6', '#F59E0B', '#EF4444',
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

<!-- Lucide & Sidebar -->
<script>
function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  sidebar.classList.toggle('hidden');
}
lucide.createIcons();
</script>

</body>
</html>
