<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        $this->load->model('M_streak');
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        
        $data['days_data'] = $this->M_streak->getDailyRewards($user_id);
        $data['streak_info'] = $this->M_streak->getUserStreak($user_id);
        $data['total_bonus'] = $this->M_streak->getTotalBonus();
        
        $this->load->view('profile/checkin', $data);
    }

    public function claim() {
        $user_id = $this->session->userdata('user_id');
        $result = $this->M_streak->claimReward($user_id);
        
        echo json_encode($result);
    }
}