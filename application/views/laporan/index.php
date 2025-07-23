<!DOCTYPE html>
<html>
<head>
  <title>Laporan Transaksi</title>
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
   
    <div class="flex-1 p-8 bg-gray-50">

      <!-- Header -->
      <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Laporan Transaksi</h1>
        <p class="text-gray-500">Filter dan cetak laporan transaksi berdasarkan tanggal dan metode pembayaran.</p>
      </div>

      <!-- Form Filter -->
      <form method="GET" class="bg-white p-6 rounded-lg shadow flex flex-wrap gap-4 mb-6">
        <div class="flex flex-col">
          <label class="text-sm font-medium text-gray-700 mb-1">Tanggal Awal</label>
          <input type="date" name="tanggal_awal" value="<?= $tanggal_awal ?>" class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">
        </div>
        <div class="flex flex-col">
          <label class="text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
          <input type="date" name="tanggal_akhir" value="<?= $tanggal_akhir ?>" class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">
        </div>
        <div class="flex flex-col">
          <label class="text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
          <select name="metode_pembayaran" class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">
            <option value="">Semua</option>
            <option value="tunai" <?= $metode == 'tunai' ? 'selected' : '' ?>>Tunai</option>
            <option value="qris" <?= $metode == 'qris' ? 'selected' : '' ?>>QRIS</option>
          </select>
        </div>
        <div class="flex items-end">
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">Terapkan</button>
        </div>
      </form>

      <!-- Tabel Laporan -->
      <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full table-auto text-sm text-left">
        <thead class="bg-gray-200 text-gray-700 uppercase font-semibold">
          <tr>
            <th class="px-4 py-3 border">Tanggal</th>
            <th class="px-4 py-3 border">Menu Dipesan</th>
            <th class="px-4 py-3 border">Layanan</th>
            <th class="px-4 py-3 border">Metode</th>
            <th class="px-4 py-3 border text-right">Total</th>
          </tr>
        </thead>
        <tbody class="text-gray-800">
          <?php $grand_total = 0; foreach ($transaksi as $t): $grand_total += $t->total; ?>
          <tr class="hover:bg-gray-100 align-top">
            <td class="px-4 py-3 border"><?= date('d-m-Y H:i', strtotime($t->tanggal)) ?></td>
            <td class="px-4 py-3 border">
              <ul class="list-disc ml-4">
                <?php foreach ($t->menu as $m): ?>
                  <li><?= $m->nama_menu ?> x<?= $m->qty ?></li>
                <?php endforeach; ?>
              </ul>
            </td>
            <td class="px-4 py-3 border"><?= $t->tipe_layanan == 'takeaway' ? 'Takeaway' : 'Makan di Tempat' ?></td>
            <td class="px-4 py-3 border"><?= strtoupper($t->metode_pembayaran) ?></td>
            <td class="px-4 py-3 border text-right"><?= number_format($t->total, 0, ',', '.') ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
          <tfoot class="bg-gray-100 font-semibold text-gray-700">
            <tr>
              <td colspan="4" class="px-4 py-3 border text-right">Grand Total</td>
              <td class="px-4 py-3 border text-right"><?= number_format($grand_total, 0, ',', '.') ?></td>
            </tr>
          </tfoot>
        </table>
      </div>

      <!-- Tombol Aksi -->
      <div class="mt-6 flex flex-wrap gap-3">
        <a href="<?= site_url('dashboard'); ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg shadow">Kembali</a>
        <a href="<?= site_url('laporan/cetak?tanggal_awal='.$tanggal_awal.'&tanggal_akhir='.$tanggal_akhir.'&metode_pembayaran='.$metode) ?>" target="_blank"
           class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow">Cetak PDF</a>
        <a href="<?= site_url('laporan/excel?tanggal_awal='.$tanggal_awal.'&tanggal_akhir='.$tanggal_akhir.'&metode_pembayaran='.$metode) ?>"
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg shadow">Export Excel</a>
      </div>
    </div>
  </div>
    </main>


</body>
</html>
