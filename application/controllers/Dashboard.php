<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        cek_login(); // semua user harus login
        $this->load->model('M_Transaksi');
    }

    public function index() {
        $data['role'] = $this->session->userdata('role');
        $data['nama'] = $this->session->userdata('nama');
        $data['total_transaksi'] = $this->M_Transaksi->count_today();
    
        // Ambil data penghasilan harian
        $penghasilan = $this->M_Transaksi->get_penghasilan_harian();
        $data['penghasilan_harian'] = $penghasilan['jumlah'];
        $data['labels_harian'] = $penghasilan['hari'];
        $this->load->model('M_Transaksi');
        $data['menu_terlaris'] = $this->M_Transaksi->get_menu_terlaris();

    
        $this->load->view('dashboard/index', $data);
    }
    
}
?>
