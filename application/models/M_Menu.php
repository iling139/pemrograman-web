<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Menu extends CI_Model {

    public function get_all() {
        return $this->db->get('menu')->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('menu', ['id' => $id])->row();
    }

    public function insert($data) {
        return $this->db->insert('menu', $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('menu', $data);
    }    

    public function delete($id) {
        return $this->db->where('id', $id)->delete('menu');
    }
    public function is_used_in_transaksi($id_menu)
{
    $this->db->where('menu_id', $id_menu);
    $query = $this->db->get('transaksi_detail');
    return $query->num_rows() > 0;
}

}
?>
