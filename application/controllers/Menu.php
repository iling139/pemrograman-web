<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        cek_login();
        cek_admin(); // hanya admin yang bisa akses
        $this->load->model('M_Menu');
    }

    public function index() {
        $data['menu'] = $this->M_Menu->get_all();
        $this->load->view('menu/index', $data);
    }

    public function add(){
        if ($this->input->post()) {
            // Proses upload gambar
            $config['upload_path'] = './uploads/menu/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048; // 2MB

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $upload_data = $this->upload->data();
                $gambar = $upload_data['file_name'];
            } else {
                $gambar = ''; // bisa juga NULL
            }

            // Simpan data ke database
            $data = [
                'nama_menu' => $this->input->post('nama_menu'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'gambar' => $gambar // <- perbaikan di sini
            ];

            $this->db->insert('menu', $data);
            redirect('menu');
        } else {
            $this->load->view('menu/add');
        }
    }

    public function edit($id) {
        if ($this->input->post()) {
            $nama_menu = $this->input->post('nama_menu');
            $harga = $this->input->post('harga');
            $stok = $this->input->post('stok');
    
            $data = [
                'nama_menu' => $nama_menu,
                'harga'     => $harga,
                'stok'      => $stok
            ];
    
            // Cek apakah ada file gambar yang diupload
            if (!empty($_FILES['gambar']['name'])) {
                $config['upload_path'] = './uploads/menu/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048;
    
                $this->load->library('upload', $config);
    
                if ($this->upload->do_upload('gambar')) {
                    $upload_data = $this->upload->data();
                    $data['gambar'] = $upload_data['file_name'];
    
                    // Hapus gambar lama jika ada
                    $old = $this->M_Menu->get_by_id($id);
                    if ($old && $old->gambar && file_exists('./uploads/menu/' . $old->gambar)) {
                        unlink('./uploads/menu/' . $old->gambar);
                    }
    
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('menu');
                    return;
                }
            }
    
            $this->M_Menu->update($id, $data);
            $this->session->set_flashdata('success', 'Data berhasil diperbarui.');
            redirect('menu');
        } else {
            $data['menu'] = $this->M_Menu->get_by_id($id);
            if (!$data['menu']) show_404(); 
            $this->load->view('menu/edit', $data);
        }
    }
    

    public function delete($id)
{
    if ($this->M_Menu->is_used_in_transaksi($id)) {
        $this->session->set_flashdata('error', 'Menu ini sedang digunakan dalam transaksi dan tidak bisa dihapus.');
    } else {
        $this->M_Menu->delete($id);
        $this->session->set_flashdata('success', 'Menu berhasil dihapus.');
    }
    redirect('menu');
}

}

?>
