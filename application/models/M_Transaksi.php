<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Transaksi extends CI_Model {

    public function insert_transaksi($data, $detail) {
        $this->db->insert('transaksi', $data);
        $transaksi_id = $this->db->insert_id();
    
        foreach ($detail as &$d) {
            // Ambil data menu (nama dan harga saat itu)
            $menu = $this->db->get_where('menu', ['id' => $d['menu_id']])->row();
        
            $d['transaksi_id'] = $transaksi_id;
            $d['nama_menu'] = $menu->nama_menu;
            $d['harga_satuan'] = $menu->harga;
        
            // Kurangi stok
            $this->db->set('stok', 'stok - '.$d['qty'], false);
            $this->db->where('id', $d['menu_id']);
            $this->db->update('menu');
        }
        
        
        $this->db->insert_batch('transaksi_detail', $detail);
    
        return $transaksi_id;
    }
    

    public function count_today() {
        $today = date('Y-m-d');
        return $this->db->where('DATE(tanggal)', $today)->count_all_results('transaksi');
    }
    public function get_penghasilan_harian() {
        $query = $this->db->query("
            SELECT DAYNAME(tanggal) AS hari, SUM(total) AS jumlah
            FROM transaksi
            WHERE WEEK(tanggal) = WEEK(CURDATE())
            GROUP BY DAYNAME(tanggal)
            ORDER BY FIELD(DAYNAME(tanggal), 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')
        ");
    
        $hasil = ['hari' => [], 'jumlah' => []];
        foreach ($query->result() as $row) {
            // Opsional: ubah hari ke Bahasa Indonesia
            switch ($row->hari) {
                case 'Monday': $hari = 'Senin'; break;
                case 'Tuesday': $hari = 'Selasa'; break;
                case 'Wednesday': $hari = 'Rabu'; break;
                case 'Thursday': $hari = 'Kamis'; break;
                case 'Friday': $hari = 'Jumat'; break;
                case 'Saturday': $hari = 'Sabtu'; break;
                case 'Sunday': $hari = 'Minggu'; break;
                default: $hari = $row->hari;
            }
    
            $hasil['hari'][] = $hari;
            $hasil['jumlah'][] = (int)$row->jumlah;
        }
    
        return $hasil;
    }
    
    public function get_transaksi($id) {
        $this->db->select('t.*, u.nama_lengkap as kasir');
        $this->db->from('transaksi t');
        $this->db->join('users u', 'u.id = t.user_id');
        $this->db->where('t.id', $id);
        return $this->db->get()->row();
    }
    
    public function get_detail($transaksi_id) {
        $this->db->select('d.*, m.nama_menu');
        $this->db->from('transaksi_detail d');
        $this->db->join('menu m', 'm.id = d.menu_id');
        $this->db->where('d.transaksi_id', $transaksi_id);
        return $this->db->get()->result();
    }
    
    
    public function get_menu_terlaris() {
        $this->db->select('nama_menu, SUM(qty) as total');
        $this->db->from('transaksi_detail');
        $this->db->group_by('nama_menu');
        $this->db->order_by('total', 'DESC');
        return $this->db->get()->result();
    }
    
    
}
?>
