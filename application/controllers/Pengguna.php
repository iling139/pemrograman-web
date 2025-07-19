<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

    public function __construct() {
        parent::__construct();
        cek_login();
        cek_admin(); // hanya admin yang boleh akses
        $this->load->model('M_Pengguna');
    }

    public function index() {
        $data['pengguna'] = $this->M_Pengguna->get_all();
        $this->load->view('pengguna/index', $data);
    }

    public function tambah() {
        if($this->input->post()) {
            $data = [
                'username'      => $this->input->post('username'),
                'password'      => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'nama_lengkap'  => $this->input->post('nama_lengkap'),
                'role'          => $this->input->post('role')
            ];
            $this->M_Pengguna->insert($data);
            redirect('pengguna');
        } else {
            $this->load->view('pengguna/tambah');
        }
    }

    public function edit($id) {
        if($this->input->post()) {
            $data = [
                'username'      => $this->input->post('username'),
                'nama_lengkap'  => $this->input->post('nama_lengkap'),
                'role'          => $this->input->post('role')
            ];
            // update password jika diisi
            if($this->input->post('password')) {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            }
            $this->M_Pengguna->update($id, $data);
            redirect('pengguna');
        } else {
            $data['pengguna'] = $this->M_Pengguna->get_by_id($id);
            $this->load->view('pengguna/edit', $data);
        }
    }

    public function hapus($id) {
        $this->M_Pengguna->delete($id);
        redirect('pengguna');
    }
}
