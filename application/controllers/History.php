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
        $data['transactions'] = $this->M_history->get_transactions_by_user($user_id); // Get transactions
        $this->load->view('history/history', $data); // Pass data to view
    }

    public function transaction($transaction_id) {
        $transaction = $this->M_history->get_transaction_by_id($transaction_id);
        if ($transaction) {
            $data['transaction'] = $transaction;
            $branch = $this->M_history->get_branch_by_id($transaction->branch_id);
            $data['branch'] = $branch;
            $cashier = $this->M_history->get_cashier_by_id($transaction->account_cashier_id);
            $data['cashier'] = $cashier;
            $this->load->view('history/balance', $data);
        } else {
            show_404();
        }
    }
}

