<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        cek_login();
        cek_admin(); // hanya admin bisa lihat laporan
        $this->load->model('M_Laporan');
    }

    public function index() {
        // Ambil filter dari GET (tanggal awal, akhir, metode)
        $tanggal_awal  = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        $metode        = $this->input->get('metode_pembayaran');

        // Ambil data laporan
        $data['transaksi'] = $this->M_Laporan->get_laporan($tanggal_awal, $tanggal_akhir, $metode);
        $data['tanggal_awal']  = $tanggal_awal;
        $data['tanggal_akhir'] = $tanggal_akhir;
        $data['metode']        = $metode;

        $this->load->view('laporan/index', $data);
    }
    public function cetak() {
        // Ambil filter sama seperti index
        $tanggal_awal  = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        $metode        = $this->input->get('metode_pembayaran');
    
        $data['transaksi'] = $this->M_Laporan->get_laporan($tanggal_awal, $tanggal_akhir, $metode);
        $data['tanggal_awal']  = $tanggal_awal;
        $data['tanggal_akhir'] = $tanggal_akhir;
        $data['metode']        = $metode;
    
        // Load view HTML laporan
        $html = $this->load->view('laporan/pdf', $data, TRUE);
    
        // Panggil Dompdf
        $this->load->library('dompdf_gen');
        $this->dompdf_gen->dompdf->loadHtml($html);
        $this->dompdf_gen->dompdf->setPaper('A4', 'portrait');
        $this->dompdf_gen->dompdf->render();
        $this->dompdf_gen->dompdf->stream("laporan_transaksi.pdf", array("Attachment" => false));
    }
    public function excel() {
        // Ambil filter yang sama dengan index
        $tanggal_awal  = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        $metode        = $this->input->get('metode_pembayaran');
    
        $data['transaksi'] = $this->M_Laporan->get_laporan($tanggal_awal, $tanggal_akhir, $metode);
        $data['tanggal_awal']  = $tanggal_awal;
        $data['tanggal_akhir'] = $tanggal_akhir;
        $data['metode']        = $metode;
    
        // Header supaya browser langsung download sebagai Excel
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=laporan_transaksi.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
    
        // Load view yang hanya tabel (HTML), Excel akan membaca ini
        $this->load->view('laporan/excel', $data);
    }
    
}
?>
