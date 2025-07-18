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

    public function add() {
        if($this->input->post()) {
            $this->M_Menu->insert([
                'nama_menu' => $this->input->post('nama_menu'),
                'harga'     => $this->input->post('harga'),
                'stok'      => $this->input->post('stok'),
            ]);
            redirect('menu');
        } else {
            $this->load->view('menu/add');
        }
    }

    public function edit($id) {
        if($this->input->post()) {
            $this->M_Menu->update($id, [
                'nama_menu' => $this->input->post('nama_menu'),
                'harga'     => $this->input->post('harga'),
                'stok'      => $this->input->post('stok'),
            ]);
            redirect('menu');
        } else {
            $data['menu'] = $this->M_Menu->get_by_id($id);
            if (!$data['menu']) show_404(); 
            $this->load->view('menu/edit', $data);
        }
    }    
    

    public function delete($id) {
        $this->M_Menu->delete($id);
        redirect('menu');
    }
}
?>
