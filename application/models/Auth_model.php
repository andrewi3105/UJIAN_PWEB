<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function login($username, $password) {
        $this->db->where('username', $username);
        $user = $this->db->get('users')->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return FALSE;
    }

    public function register($data) {
        return $this->db->insert('users', $data);
    }
}
