<!DOCTYPE html>
<html>
<head>
  <title>Transaksi Baru</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 p-6">

  <div class="max-w-6xl mx-auto bg-white shadow-lg p-8 rounded-lg">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
        <i data-lucide="shopping-cart"></i> Transaksi Baru
      </h1>
      <a href="<?= site_url('dashboard'); ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow inline-flex items-center gap-2">
        <i data-lucide="arrow-left"></i> Kembali
      </a>
    </div>

    <?php if($this->session->flashdata('success')): ?>
      <div class="bg-green-100 text-green-700 border border-green-300 p-3 rounded mb-4 shadow-sm flex items-center gap-2">
        <i data-lucide="check-circle"></i> <?= $this->session->flashdata('success') ?>
      </div>
    <?php endif; ?>
    <?php if($this->session->flashdata('error')): ?>
      <div class="bg-red-100 text-red-700 border border-red-300 p-3 rounded mb-4 shadow-sm flex items-center gap-2">
        <i data-lucide="alert-triangle"></i> <?= $this->session->flashdata('error') ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="<?= site_url('transaksi/simpan'); ?>" id="formTransaksi" class="space-y-6">
      
      <!-- Pilihan Layanan & Pembayaran -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Layanan</label>
          <select name="tipe_layanan" class="w-full rounded-md border-gray-300 shadow-sm text-sm p-2">
            <option value="makan_ditempat">Makan di Tempat</option>
            <option value="takeaway">Bungkus</option>
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
          <select name="metode_pembayaran" class="w-full rounded-md border-gray-300 shadow-sm text-sm p-2">
            <option value="tunai">Tunai</option>
            <option value="qris">QRIS</option>
          </select>
        </div>
      </div>

      <!-- Menu Pilihan -->
      <div>
        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
          <i data-lucide="utensils"></i> Pilih Menu
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
          <?php foreach($menu as $m): ?>
          <div class="bg-gray-50 rounded-lg shadow p-4 flex flex-col items-center text-center transition hover:shadow-md">
            <img src="<?= base_url('uploads/menu/' . $m->gambar) ?>" alt="<?= $m->nama_menu ?>" class="w-24 h-24 object-cover rounded mb-3 border">
            <div class="font-semibold text-lg text-gray-800"><?= $m->nama_menu ?></div>
            <div class="text-green-600 font-bold mb-2">Rp <?= number_format($m->harga, 0, ',', '.') ?></div>

            <?php if($m->stok > 0): ?>
              <div class="text-xs text-gray-500 mb-2 bg-green-100 text-green-700 px-2 py-0.5 rounded-full flex items-center gap-1">
                <i data-lucide="box"></i> Stok: <?= $m->stok ?>
              </div>
              <div class="flex items-center space-x-2">
                <button type="button" class="bg-gray-300 hover:bg-gray-400 px-2 rounded text-sm minus" data-id="<?= $m->id ?>">
                  <i data-lucide="minus"></i>
                </button>
                <input type="number" name="items[<?= $m->id ?>]" id="qty_<?= $m->id ?>" value="0" min="0" max="<?= $m->stok ?>" class="w-14 text-center border p-1 rounded qty" data-harga="<?= $m->harga ?>" data-id="<?= $m->id ?>">
                <button type="button" class="bg-gray-300 hover:bg-gray-400 px-2 rounded text-sm plus" data-id="<?= $m->id ?>">
                  <i data-lucide="plus"></i>
                </button>
              </div>
            <?php else: ?>
              <div class="text-sm font-semibold mt-2 bg-red-100 text-red-600 px-2 py-1 rounded-full flex items-center gap-1">
                <i data-lucide="x-circle"></i> Stok Habis
              </div>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Total -->
      <div class="text-right text-lg font-semibold text-gray-700 border-t pt-4">
        Total Tagihan: <span class="text-green-600 font-bold" id="totalTagihan">Rp 0</span>
      </div>

      <!-- Tombol -->
      <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow inline-flex items-center gap-2">
          <i data-lucide="save"></i> Simpan Transaksi
        </button>
      </div>
    </form>
  </div>

  <script>
    lucide.createIcons();

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
        const max = parseInt(input.getAttribute('max'));
        const current = parseInt(input.value || 0);
        if (current < max) {
          input.value = current + 1;
          hitungTotal();
        }
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
