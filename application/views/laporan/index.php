<!DOCTYPE html>
<html>
<head>
  <title>Laporan Transaksi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

  <h1 class="text-2xl font-bold mb-4">Laporan Transaksi</h1>

  <!-- Form Filter -->
  <form method="GET" class="bg-white p-4 rounded shadow mb-4 flex gap-4 flex-wrap">
    <div>
      <label class="block font-semibold">Tanggal Awal</label>
      <input type="date" name="tanggal_awal" value="<?= $tanggal_awal ?>" class="border p-2 rounded">
    </div>
    <div>
      <label class="block font-semibold">Tanggal Akhir</label>
      <input type="date" name="tanggal_akhir" value="<?= $tanggal_akhir ?>" class="border p-2 rounded">
    </div>
    <div>
      <label class="block font-semibold">Metode Pembayaran</label>
      <select name="metode_pembayaran" class="border p-2 rounded">
        <option value="">Semua</option>
        <option value="tunai" <?= $metode=='tunai'?'selected':'' ?>>Tunai</option>
        <option value="qris" <?= $metode=='qris'?'selected':'' ?>>QRIS</option>
      </select>
    </div>
    <div class="flex items-end">
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </div>
  </form>

  <!-- Tabel Laporan -->
  <div class="bg-white rounded shadow overflow-x-auto">
    <table class="table-auto w-full border">
      <thead class="bg-gray-200">
        <tr>
          <th class="border p-2">Tanggal</th>
          <th class="border p-2">Kasir</th>
          <th class="border p-2">Layanan</th>
          <th class="border p-2">Metode</th>
          <th class="border p-2 text-right">Total</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $grand_total = 0;
        foreach($transaksi as $t): 
          $grand_total += $t->total;
        ?>
        <tr>
          <td class="border p-2"><?= date('d-m-Y H:i', strtotime($t->tanggal)) ?></td>
          <td class="border p-2"><?= $t->kasir ?></td>
          <td class="border p-2"><?= $t->tipe_layanan=='takeaway'?'Takeaway':'Makan di Tempat' ?></td>
          <td class="border p-2"><?= strtoupper($t->metode_pembayaran) ?></td>
          <td class="border p-2 text-right"><?= number_format($t->total,0,',','.') ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr class="bg-gray-100 font-bold">
          <td colspan="4" class="border p-2 text-right">Grand Total</td>
          <td class="border p-2 text-right"><?= number_format($grand_total,0,',','.') ?></td>
        </tr>
      </tfoot>
    </table>
  </div>

  <div class="mt-4">
    <a href="<?= site_url('dashboard'); ?>" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
    <!-- Tombol cetak dengan filter aktif -->
    <a href="<?= site_url('laporan/cetak?tanggal_awal='.$tanggal_awal.'&tanggal_akhir='.$tanggal_akhir.'&metode_pembayaran='.$metode) ?>" target="_blank" class="bg-green-500 text-white px-4 py-2 rounded">Cetak PDF</a>
    <!-- Tombol Export Excel -->
    <a href="<?= site_url('laporan/excel?tanggal_awal='.$tanggal_awal.'&tanggal_akhir='.$tanggal_akhir.'&metode_pembayaran='.$metode) ?>"
      class="bg-yellow-500 text-white px-4 py-2 rounded">Export Excel</a>
  </div>

</body>
</html>
