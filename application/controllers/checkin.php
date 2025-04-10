<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Checkin_model');
        
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        
        $data['checkin_data'] = $this->Checkin_model->get_user_checkin_data($user_id);
        $data['current_streak'] = $this->Checkin_model->get_current_streak($user_id);
        $data['today_checked'] = $this->Checkin_model->is_checked_in_today($user_id);
        
        $this->load->view('profile/checkin', $data);
    }
}