<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Checkin_model');
        $this->load->helper('asset');
        
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
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

    public function do_checkin() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $user_id = $this->session->userdata('user_id');
        
        // Check if already checked in today
        if ($this->Checkin_model->is_checked_in_today($user_id)) {
            $response = [
                'status' => 'error',
                'message' => 'You have already checked in today'
            ];
            echo json_encode($response);
            return;
        }

        // Process check-in
        $result = $this->Checkin_model->process_checkin($user_id);
        
        if ($result['status'] === 'success') {
            $response = [
                'status' => 'success',
                'points_earned' => $result['points_earned'],
                'current_streak' => $result['current_streak'],
                'message' => 'Check-in successful!'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => $result['message']
            ];
        }

        echo json_encode($response);
    }

    public function get_checkin_status() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $user_id = $this->session->userdata('user_id');
        $data = [
            'is_checked_in' => $this->Checkin_model->is_checked_in_today($user_id),
            'current_streak' => $this->Checkin_model->get_current_streak($user_id),
            'checkin_history' => $this->Checkin_model->get_user_checkin_data($user_id)
        ];

        echo json_encode($data);
    }
}