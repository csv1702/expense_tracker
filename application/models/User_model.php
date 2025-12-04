<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function register_user($data) {
        return $this->db->insert('users', $data);
    }

    public function login_user($email, $password) {
        $this->db->where('email', $email);
        $result = $this->db->get('users');

        if ($result->num_rows() == 1) {
            $user = $result->row();
            // Verify hashed password
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }
}