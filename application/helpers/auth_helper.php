<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function cek_login() {
    $CI =& get_instance();

    // Jika di halaman login, jangan cek
    $controller = $CI->router->fetch_class();
    if ($controller == 'auth') return;

    if(!$CI->session->userdata('logged_in')) {
        redirect('auth');
    }
}

function cek_admin() {
    $CI =& get_instance();

    // Pastikan sudah login dulu
    if(!$CI->session->userdata('logged_in')) {
        redirect('auth');
    }

    // Cek role, kalau bukan admin tolak
    if($CI->session->userdata('role') != 'admin') {
        show_error('Akses ditolak! Halaman ini hanya untuk Admin.');
    }
}
