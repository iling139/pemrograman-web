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

        // Ambil ringkasan transaksi hari ini (opsional)
        $data['total_transaksi'] = $this->M_Transaksi->count_today();

        $this->load->view('dashboard/index', $data);
    }
}
?>
