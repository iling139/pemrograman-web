<!DOCTYPE html>
<html>
<head>
  <title>Buat Transaksi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

  <h1 class="text-2xl font-bold mb-4">Transaksi Baru</h1>

  <?php if($this->session->flashdata('success')): ?>
    <div class="bg-green-100 text-green-700 p-2 rounded mb-3"><?= $this->session->flashdata('success') ?></div>
  <?php endif; ?>
  <?php if($this->session->flashdata('error')): ?>
    <div class="bg-red-100 text-red-700 p-2 rounded mb-3"><?= $this->session->flashdata('error') ?></div>
  <?php endif; ?>

  <form method="POST" action="<?= site_url('transaksi/simpan'); ?>">

    <!-- Tipe Layanan -->
    <div class="mb-4">
      <label class="block font-semibold">Tipe Layanan</label>
      <select name="tipe_layanan" class="w-full border p-2 rounded">
        <option value="makan_ditempat">Makan di Tempat</option>
        <option value="takeaway">Takeaway</option>
      </select>
    </div>

    <!-- Metode Pembayaran -->
    <div class="mb-4">
      <label class="block font-semibold">Metode Pembayaran</label>
      <select name="metode_pembayaran" class="w-full border p-2 rounded">
        <option value="tunai">Tunai</option>
        <option value="qris">QRIS</option>
      </select>
    </div>

    <!-- Pilih Menu -->
    <h2 class="text-lg font-bold mb-2">Pilih Menu</h2>
    <table class="table-auto w-full border mb-4">
      <thead>
        <tr class="bg-gray-200">
          <th class="border p-2">Menu</th>
          <th class="border p-2">Harga</th>
          <th class="border p-2">Qty</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($menu as $m): ?>
        <tr>
          <td class="border p-2"><?= $m->nama_menu ?></td>
          <td class="border p-2"><?= number_format($m->harga, 0) ?></td>
          <td class="border p-2">
            <input type="number" name="items[<?= $m->id ?>]" value="0" min="0" class="w-16 border rounded p-1">
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="flex justify-between">
      <a href="<?= site_url('dashboard'); ?>" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
      <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Simpan Transaksi</button>
    </div>

  </form>

</body>
</html>
