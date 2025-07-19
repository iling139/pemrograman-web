<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_Auth');
        $this->load->library('session');
    }

    public function index() {
        $this->load->view('auth/login'); // Tampilkan form login
    }

    public function login() {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->M_Auth->check_user($username);

        if ($user && password_verify($password, $user->password)) {
            // Simpan session
            $this->session->set_userdata([
                'user_id' => $user->id,
                'nama'    => $user->nama_lengkap,
                'role'    => $user->role,
                'logged_in' => TRUE
            ]);

            redirect('dashboard');
        
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah!');
            redirect('auth');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
?>
