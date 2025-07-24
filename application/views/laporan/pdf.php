<!DOCTYPE html>
<html>
<head>
  <style>
    body { font-family: sans-serif; font-size: 12px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    th { background: #ddd; }
  </style>
</head>
<body>
  <h2 style="text-align:center;">Laporan Transaksi Kantin</h2>
  <?php if($tanggal_awal && $tanggal_akhir): ?>
    <p>Periode: <?= $tanggal_awal ?> s/d <?= $tanggal_akhir ?></p>
  <?php endif; ?>
  <?php if($metode): ?>
    <p>Metode Pembayaran: <?= strtoupper($metode) ?></p>
  <?php endif; ?>

  <table>
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Kasir</th>
        <th>Layanan</th>
        <th>Metode</th>
        <th style="text-align:right;">Total</th>
      </tr>
    </thead>
    <tbody>
    <?php $grand_total=0; foreach($transaksi as $t): $grand_total += $t->total; ?>
<tr>
  <td><?= date('d-m-Y H:i', strtotime($t->tanggal)) ?></td>
  <td><?= $t->kasir ?></td>
  <td><?= $t->tipe_layanan=='takeaway'?'Takeaway':'Makan di Tempat' ?></td>
  <td><?= strtoupper($t->metode_pembayaran) ?></td>
  <td style="text-align:right;"><?= number_format($t->total,0,',','.') ?></td>
</tr>
<?php if (!empty($t->menu)): foreach($t->menu as $m): ?>
<tr>
  <td colspan="5" style="padding-left:30px;">- <?= $m->nama_menu ?> x<?= $m->qty ?> (Rp <?= number_format($m->subtotal, 0, ',', '.') ?>)</td>
</tr>
<?php endforeach; endif; ?>
<?php endforeach; ?>

    </tbody>
    <tfoot>
      <tr>
        <th colspan="4" style="text-align:right;">Grand Total</th>
        <th style="text-align:right;"><?= number_format($grand_total,0,',','.') ?></th>
      </tr>
    </tfoot>
  </table>

  <p style="margin-top:30px;">Dicetak pada: <?= date('d-m-Y H:i') ?></p>
</body>
</html>
