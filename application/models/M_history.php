<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_history extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_vouchers_by_user($user_id) {
        $this->db->select('redeem_voucher.*, rewards.title as reward_title, rewards.image_name, rewards.points_required, rewards.category, rewards.valid_until, rewards.total_days');
        $this->db->from('redeem_voucher');
        $this->db->join('rewards', 'rewards.id = redeem_voucher.reward_id');
        $this->db->where('redeem_voucher.user_id', $user_id);
        $this->db->order_by('redeem_voucher.redeem_date', 'DESC'); // Order by redeem_date descending
        $query = $this->db->get();
        return $query->result();
    }

    public function get_transactions_by_user($user_id, $time_deleted = null) {
        $this->db->select('transactions.*, branch.branch_name');
        $this->db->from('transactions');
        $this->db->join('branch', 'branch.id = transactions.branch_id', 'left');
        $this->db->where('transactions.user_id', $user_id);

        // If time_deleted is not null, filter transactions after the time_deleted
        if ($time_deleted) {
            $this->db->where('transactions.created_at >', $time_deleted);
        }

        $this->db->order_by('transactions.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_transaction_by_id($transaction_id) {
        // Get transaction details with branch, voucher, and payment info
        $this->db->select('
            transactions.*, 
            branch.branch_name, 
            accounts.name as cashier_name, 
            redeem_voucher.kode_voucher,
            redeem_voucher.status as voucher_status
        ');
        $this->db->from('transactions');
        $this->db->join('branch', 'branch.id = transactions.branch_id', 'left');
        $this->db->join('accounts', 'accounts.id = transactions.account_cashier_id', 'left');
        $this->db->join('redeem_voucher', 'redeem_voucher.redeem_id = transactions.voucher_id', 'left');
        $this->db->where('transactions.transaction_id', $transaction_id);
        $transaction = $this->db->get()->row();

        if ($transaction) {
            // Get payment methods for this transaction
            $this->db->select('payment_method, amount');
            $this->db->from('transaction_payments');
            $this->db->where('transaction_id', $transaction_id);
            $transaction->payments = $this->db->get()->result();
        }

        return $transaction;
    }

    public function get_branch_by_id($branch_id) {
        $this->db->select('branch_name');
        $this->db->from('branch'); // Gunakan tabel branch
        $this->db->where('id', $branch_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_cashier_by_id($cashier_id) {
        $this->db->select('name');
        $this->db->from('accounts');
        $this->db->where('id', $cashier_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_user_time_deleted($user_id) {
        $this->db->select('time_deleted');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        return $query->row();
    }
}