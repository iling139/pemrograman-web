<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Auth extends CI_Model {

    public function check_user($username) {
        return $this->db->get_where('users', ['username' => $username])->row();
    }

}
?>
