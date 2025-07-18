<!DOCTYPE html>
<html>
<head>
  <title>Dashboard Kantin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Dashboard Kantin</h1>
    <div>
      <span class="mr-4">Halo, <b><?= $nama ?></b> (<?= $role ?>)</span>
      <a href="<?= site_url('auth/logout'); ?>" class="bg-red-500 text-white px-3 py-1 rounded">Logout</a>
    </div>
  </div>

  <div class="grid grid-cols-2 gap-4">
    <div class="bg-white p-4 shadow rounded">
      <h2 class="font-semibold">Ringkasan Hari Ini</h2>
      <p>Total Transaksi: <b><?= $total_transaksi ?></b></p>
    </div>

    <?php if($role == 'admin'): ?>
    <div class="bg-white p-4 shadow rounded">
      <h2 class="font-semibold">Menu Admin</h2>
      <ul class="list-disc ml-4">
        <li><a href="<?= site_url('menu'); ?>" class="text-blue-500">Kelola Menu Kantin</a></li>
        <li><a href="<?= site_url('pegawai'); ?>" class="text-blue-500">Kelola Pegawai</a></li>
        <li><a href="<?= site_url('laporan'); ?>" class="text-blue-500">Laporan Penjualan</a></li>
      </ul>
    </div>
    <?php endif; ?>
    
    <div class="bg-white p-4 shadow rounded">
      <h2 class="font-semibold">Transaksi</h2>
      <a href="<?= site_url('transaksi'); ?>" class="bg-green-500 text-white px-3 py-2 rounded">Buat Transaksi</a>
    </div>
  </div>

</body>
</html>
