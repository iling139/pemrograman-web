<table border="1" cellspacing="0" cellpadding="5">
  <thead>
    <tr>
      <th colspan="5" style="text-align:center; font-size:16px;">
        Laporan Transaksi Kantin
      </th>
    </tr>
    <?php if($tanggal_awal && $tanggal_akhir): ?>
    <tr>
      <th colspan="5" style="text-align:center;">
        Periode: <?= $tanggal_awal ?> s/d <?= $tanggal_akhir ?>
      </th>
    </tr>
    <?php endif; ?>
    <?php if($metode): ?>
    <tr>
      <th colspan="5" style="text-align:center;">
        Metode Pembayaran: <?= strtoupper($metode) ?>
      </th>
    </tr>
    <?php endif; ?>
    <tr>
      <th>Tanggal</th>
      <th>Kasir</th>
      <th>Layanan</th>
      <th>Metode</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $grand_total = 0;
    foreach($transaksi as $t): 
      $grand_total += $t->total;
    ?>
    <tr>
      <td><?= date('d-m-Y H:i', strtotime($t->tanggal)) ?></td>
      <td><?= $t->kasir ?></td>
      <td><?= $t->tipe_layanan=='takeaway'?'Takeaway':'Makan di Tempat' ?></td>
      <td><?= strtoupper($t->metode_pembayaran) ?></td>
      <td><?= number_format($t->total,0,',','.') ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="4" style="text-align:right;">Grand Total</th>
      <th><?= number_format($grand_total,0,',','.') ?></th>
    </tr>
  </tfoot>
</table>
