<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {
        $this->login();
    }

    public function register() {
        // Form Validation Rules
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/register');
        } else {
            // Encrypt password
            $data = array(
                'username' => $this->input->post('username'),
                'email'    => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
            );
            $this->User_model->register_user($data);
            $this->session->set_flashdata('success', 'Registered successfully. Please login.');
            redirect('auth/login');
        }
    }

    public function login() {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->User_model->login_user($email, $password);

            if ($user) {
                $session_data = array(
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);
                redirect('expenses/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password');
                redirect('auth/login');
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata(array('user_id', 'username', 'logged_in'));
        redirect('auth/login');
    }
}