<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simple_login {
    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function login($username, $password) {
        // Get user by username
        $user = $this->CI->db->get_where('users', ['username' => $username])->row();

        if ($user && password_verify($password, $user->password)) {
            // Set session data
            $session_data = [
                'user_id' => $user->id,
                'username' => $user->username,
                'name' => $user->name,
                'logged_in' => TRUE
            ];
            
            $this->CI->session->set_userdata($session_data);
            redirect('profile/index');
        } else {
            $this->CI->session->set_flashdata('error', 'Invalid username or password');
            redirect('login');
        }
    }

    public function check_login() {
        if (!$this->CI->session->userdata('logged_in')) {
            $this->CI->session->set_flashdata('error', 'Please login first');
            redirect('login');
        }
    }

    public function logout() {
        $this->CI->session->sess_destroy();
        redirect('login');
    }

    public function get_user_data() {
        if ($this->CI->session->userdata('logged_in')) {
            return $this->CI->db->where('id', $this->CI->session->userdata('user_id'))
                               ->get('users')
                               ->row();
        }
        return null;
    }
}