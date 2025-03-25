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
        $data['vouchers'] = $this->M_history->get_vouchers_by_user($user_id); // Get vouchers
        $data['transactions'] = $this->M_history->get_transactions_by_user($user_id); // Get transactions
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

