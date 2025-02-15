<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_history'); // Load model
    }

    public function index() {
        $user_id = $this->session->userdata('user_id'); // Get user ID from session
        $data['vouchers'] = $this->M_history->get_vouchers_by_user($user_id); // Get vouchers
        $this->load->view('history/history', $data); // Pass data to view
    }
}