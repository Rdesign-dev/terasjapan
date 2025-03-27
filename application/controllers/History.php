<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_history'); // Load model
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function index() {
        $user_id = $this->session->userdata('user_id'); // Get user ID from session

        // Get the time_deleted value for the user
        $user_time_deleted = $this->M_history->get_user_time_deleted($user_id);
        $time_deleted = $user_time_deleted ? $user_time_deleted->time_deleted : null;

        // Load models
        $this->load->model('Reward_model');
        
        // Get data with debug logging
        $vouchers = $this->Reward_model->get_vouchers_by_user_id($user_id, $time_deleted);
        $transactions = $this->M_history->get_transactions_by_user($user_id, $time_deleted);
        
        // Debug logging
        log_message('debug', 'Vouchers data: ' . print_r($vouchers, true));
        
        $data = [
            'vouchers' => $vouchers,
            'transactions' => $transactions
        ];

        $this->load->view('history/history', $data); // Pass data to view
    }

    public function transaction($transaction_id) {
        $data['transaction'] = $this->M_history->get_transaction_by_id($transaction_id);
        
        if (!$data['transaction'] || $data['transaction']->transaction_type !== 'Balance Top-up') {
            show_404();
            return;
        }

        $this->load->view('history/transaction', $data);
    }

    public function balance($transaction_id) {
        $data['transaction'] = $this->M_history->get_transaction_by_id($transaction_id);
        
        if (!$data['transaction'] || $data['transaction']->transaction_type !== 'Teras Japan Payment') {
            show_404();
            return;
        }

        $this->load->view('history/balance', $data);
    }
}

