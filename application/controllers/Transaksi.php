<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        cek_login(); // admin & kasir boleh akses
        $this->load->model('M_Menu');
        $this->load->model('M_Transaksi');
    }

    public function index() {
        // Ambil semua menu untuk ditampilkan
        $data['menu'] = $this->M_Menu->get_all();
        $this->load->view('transaksi/form', $data);
    }

    public function simpan() {
        $user_id = $this->session->userdata('user_id');
        $items   = $this->input->post('items'); // array menu_id => qty
        $tipe_layanan = $this->input->post('tipe_layanan');
        $metode_pembayaran = $this->input->post('metode_pembayaran');
    
        $total = 0;
        $detail = [];
    
        // Hitung total & siapkan detail
        foreach($items as $menu_id => $qty) {
            if($qty > 0) {
                $menu = $this->M_Menu->get_by_id($menu_id);
                $subtotal = $menu->harga * $qty;
                $total += $subtotal;
                $detail[] = [
                    'menu_id' => $menu_id,
                    'qty'     => $qty,
                    'subtotal'=> $subtotal
                ];
            }
        }
    
        if($total > 0) {
            // Buat nomor antrian acak 3 digit (misal: 153)
            $nomor_antrian = rand(100, 999);
    
            $transaksi_id = $this->M_Transaksi->insert_transaksi([
                'user_id'           => $user_id,
                'total'             => $total,
                'tipe_layanan'      => $tipe_layanan,
                'metode_pembayaran' => $metode_pembayaran,
                'nomor_antrian'     => $nomor_antrian
            ], $detail);
    
            $this->session->set_flashdata('success', 'Transaksi berhasil disimpan!');
            redirect('transaksi/struk/'.$transaksi_id);
        } else {
            $this->session->set_flashdata('error', 'Tidak ada item yang dipilih.');
            redirect('transaksi');
        }
    }
    
    public function struk($id) {
        $this->load->model('M_Transaksi');
    
        // Ambil transaksi + detail
        $data['transaksi'] = $this->M_Transaksi->get_transaksi($id);
        $data['detail']    = $this->M_Transaksi->get_detail($id);
    
        if (!$data['transaksi']) {
            show_404();
        }
    
        // Tampilkan struk view
        $this->load->view('transaksi/struk', $data);
    }
    

}
?>
