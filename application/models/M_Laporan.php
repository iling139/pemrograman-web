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
        return $this->db->get()->result();
    }
}
?>
