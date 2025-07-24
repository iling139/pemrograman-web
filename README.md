Program ini adalah aplikasi berbasis web untuk sistem kasir kantin, bernama **website kasir kantin**. Berikut penjelasan fungsionalitas utama berdasarkan kode dan dokumentasi di repo:

### Deskripsi Umum
- **Login Multi-Role:** Ada dua tipe akun, yaitu admin (username: admin, password: admin123) dan kasir (username: kasir, password: kasir123).
- **Fitur utama:** 
  - Manajemen transaksi penjualan makanan/minuman di kantin.
  - Pengelolaan data menu, stok, dan harga.
  - Manajemen pengguna (admin dan kasir).
  - Laporan transaksi dengan filter tanggal dan metode pembayaran.
  - Ekspor laporan (PDF & Excel).

### Modul Transaksi
- Kasir dapat memilih layanan (makan di tempat / bungkus) dan metode pembayaran (tunai / QRIS).
- Kasir memilih menu dan jumlah yang dipesan. Sistem akan memeriksa stok sebelum transaksi disimpan.
- Setelah transaksi berhasil, akan dibuat nomor antrian acak.
- Data transaksi tersimpan beserta detail menu, jumlah, harga, dan subtotal.

### Modul Laporan Transaksi
- **Admin** dapat melihat dan memfilter laporan transaksi berdasarkan tanggal & metode pembayaran.
- Laporan dapat diekspor ke PDF (menggunakan DomPDF) atau Excel.
- Di tampilan, laporan menampilkan tanggal, menu yang dipesan, layanan, metode pembayaran, dan total transaksi.
- Ada fitur perhitungan grand total di akhir tabel laporan.

### Modul Menu & Pengguna
- **Menu:** Admin dapat menambah, mengedit, menghapus data menu beserta gambar, harga, dan stok.
- **Pengguna:** Admin dapat mengelola data pengguna (nama, username, password, role, dll).

### Teknologi & Framework
- Menggunakan **PHP dengan CodeIgniter** (terlihat dari struktur controller dan model).
- Tampilan memakai TailwindCSS.
- Output laporan PDF memakai library Dompdf.
- Sistem file upload untuk gambar menu.

### Hosting & Demo
- Dihosting di: [http://kasir-kantin.my.id/pemrograman-web/](http://kasir-kantin.my.id/pemrograman-web/)

---

**Singkatnya:**  
Aplikasi ini memudahkan proses penjualan di kantin, memungkinkan monitoring stok, transaksi, serta pelaporan yang rapi dan mudah diekspor. Cocok untuk kebutuhan kasir di lingkungan sekolah, kantor, atau kantin umum dengan workflow sederhana namun lengkap.
