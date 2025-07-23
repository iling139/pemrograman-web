<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Laporan extends CI_Model {

    public function get_laporan($tgl_awal = null, $tgl_akhir = null, $metode = null) {
        $this->db->select('t.*, u.nama_lengkap as kasir');
        $this->db->from('transaksi t');
        $this->db->join('users u', 'u.id = t.user_id');
    
        // Filter tanggal
        if(!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('DATE(t.tanggal) >=', $tgl_awal);
            $this->db->where('DATE(t.tanggal) <=', $tgl_akhir);
        }
    
        // Filter metode pembayaran
        if(!empty($metode)) {
            $this->db->where('t.metode_pembayaran', $metode);
        }
    
        $this->db->order_by('t.tanggal', 'DESC');
        $transaksi = $this->db->get()->result();
    
        // Ambil menu dari detail_transaksi untuk setiap transaksi
        foreach ($transaksi as &$t) {
            $this->db->select('dt.*, m.nama_menu');
            $this->db->from('transaksi_detail dt');
            $this->db->join('menu m', 'm.id = dt.menu_id');
            $this->db->where('dt.transaksi_id', $t->id);
            $t->menu = $this->db->get()->result();
        }
    
        return $transaksi;
    }
    
}
?>
