  <!DOCTYPE html>
  <html>
  <head>
    <title>Struk Transaksi</title>
    <style>
      body { font-family: monospace; font-size: 14px; }
      .line { border-top: 1px dashed #000; margin: 5px 0; }
      .right { text-align: right; }
    </style>
  </head>
  <body>

    <center>
      <h3>KANTIN DIGITAL</h3>
      <p><strong>No. Antrian: <?= $transaksi->nomor_antrian ?></strong></p>
    </center>

    <p>
      Kasir    : <?= $transaksi->kasir ?><br>
      Tanggal  : <?= date('d-m-Y H:i', strtotime($transaksi->tanggal)) ?><br>
      Layanan  : <?= $transaksi->tipe_layanan=='takeaway'?'Takeaway':'Makan di Tempat' ?><br>
      Bayar    : <?= !empty($transaksi->metode_pembayaran) ? strtoupper($transaksi->metode_pembayaran) : '-' ?>
    </p>

    <div class="line"></div>
    <table width="100%">
      <?php foreach($detail as $d): ?>
      <tr>
        <td><?= $d->nama_menu ?> x<?= $d->qty ?></td>
        <td class="right"><?= number_format($d->subtotal,0,',','.') ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
    <div class="line"></div>

    <p class="right"><b>TOTAL : <?= number_format($transaksi->total,0,',','.') ?></b></p>

    <center>
      <p>Terima kasih telah berbelanja</p>
    </center>

    <div class="line"></div>
    <p style="text-align:center;">-- Kantin Digital --</p>

    <script>
  window.onload = function() {
    window.print();
    window.onafterprint = function() {
      window.location.href = "<?= site_url('transaksi'); ?>";
    };
  };
</script>


  </body>
  </html>
