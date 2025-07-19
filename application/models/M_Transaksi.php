<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Transaksi extends CI_Model {

    public function insert_transaksi($data, $detail) {
        $this->db->trans_start();

        // Simpan transaksi utama
        $this->db->insert('transaksi', $data);
        $transaksi_id = $this->db->insert_id();

        // Simpan detail transaksi
        foreach($detail as &$d) {
            $d['transaksi_id'] = $transaksi_id;
        }
        $this->db->insert_batch('transaksi_detail', $detail);

        $this->db->trans_complete();

        return $transaksi_id;
    }

    public function count_today() {
        $today = date('Y-m-d');
        return $this->db->where('DATE(tanggal)', $today)->count_all_results('transaksi');
    }
    public function get_transaksi($id) {
        $this->db->select('t.*, u.nama_lengkap as kasir');
        $this->db->from('transaksi t');
        $this->db->join('users u', 'u.id = t.user_id');
        $this->db->where('t.id', $id);
        return $this->db->get()->row();
    }
    
    public function get_detail($transaksi_id) {
        $this->db->select('d.*, m.nama_menu, m.harga');
        $this->db->from('transaksi_detail d');
        $this->db->join('menu m', 'm.id = d.menu_id');
        $this->db->where('d.transaksi_id', $transaksi_id);
        return $this->db->get()->result();
    }
    
}
?>
