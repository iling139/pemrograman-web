<!DOCTYPE html>
<html>
<head>
  <title>Transaksi Baru</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

  <div class="max-w-6xl mx-auto bg-white shadow p-6 rounded">
    <h1 class="text-2xl font-bold mb-6 text-center">Transaksi Baru</h1>

    <?php if($this->session->flashdata('success')): ?>
      <div class="bg-green-100 text-green-700 p-2 rounded mb-3"><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>
    <?php if($this->session->flashdata('error')): ?>
      <div class="bg-red-100 text-red-700 p-2 rounded mb-3"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= site_url('transaksi/simpan'); ?>" id="formTransaksi">
      <div class="flex flex-wrap gap-4 mb-4">
        <!-- Tipe Layanan -->
        <div class="flex-1 min-w-[150px]">
          <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Layanan</label>
          <select name="tipe_layanan" class="w-full rounded-md border-gray-300 shadow-sm text-sm p-2">
            <option value="dine_in">Makan di Tempat</option>
            <option value="take_away">Bungkus</option>
          </select>
        </div>

        <!-- Metode Pembayaran -->
        <div class="flex-1 min-w-[150px]">
          <label class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
          <select name="metode_pembayaran" class="w-full rounded-md border-gray-300 shadow-sm text-sm p-2">
            <option value="cash">Tunai</option>
            <option value="qris">QRIS</option>
          </select>
        </div>
      </div>


      <!-- Daftar Menu dalam bentuk Card -->
      <h2 class="text-xl font-bold mb-4">Pilih Menu</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-6">
        <?php foreach($menu as $m): ?>
        <div class="bg-gray-50 rounded shadow p-4 flex flex-col items-center text-center">
          <img src="<?= base_url('uploads/menu/' . $m->gambar) ?>" alt="<?= $m->nama_menu ?>" class="w-24 h-24 object-cover rounded mb-2">
          <div class="font-semibold text-lg mb-1"><?= $m->nama_menu ?></div>
          <div class="text-green-600 font-bold mb-2">Rp <?= number_format($m->harga, 0, ',', '.') ?></div>

          <div class="flex items-center space-x-2">
            <button type="button" class="bg-gray-300 px-2 rounded text-sm minus" data-id="<?= $m->id ?>">-</button>
            <input type="number" name="items[<?= $m->id ?>]" id="qty_<?= $m->id ?>" value="0" min="0" class="w-12 text-center border p-1 qty" data-harga="<?= $m->harga ?>" data-id="<?= $m->id ?>">
            <button type="button" class="bg-gray-300 px-2 rounded text-sm plus" data-id="<?= $m->id ?>">+</button>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Total -->
      <div class="text-right mb-6">
        <span class="font-semibold text-lg">Total Tagihan: </span>
        <span class="text-lg font-bold text-green-600" id="totalTagihan">Rp 0</span>
      </div>

      <!-- Tombol -->
      <div class="flex justify-between">
        <a href="<?= site_url('dashboard'); ?>" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Simpan Transaksi</button>
      </div>
    </form>
  </div>

  <script>
    const qtyInputs = document.querySelectorAll('.qty');
    const totalEl = document.getElementById('totalTagihan');

    function hitungTotal() {
      let total = 0;
      qtyInputs.forEach(input => {
        const harga = parseInt(input.dataset.harga);
        const qty = parseInt(input.value) || 0;
        total += harga * qty;
      });
      totalEl.textContent = "Rp " + total.toLocaleString('id-ID');
    }

    qtyInputs.forEach(input => {
      input.addEventListener('input', hitungTotal);
    });

    document.querySelectorAll('.plus').forEach(btn => {
      btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const input = document.getElementById('qty_' + id);
        input.value = parseInt(input.value || 0) + 1;
        hitungTotal();
      });
    });

    document.querySelectorAll('.minus').forEach(btn => {
      btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const input = document.getElementById('qty_' + id);
        input.value = Math.max(0, parseInt(input.value || 0) - 1);
        hitungTotal();
      });
    });

    hitungTotal();
  </script>
</body>
</html>
