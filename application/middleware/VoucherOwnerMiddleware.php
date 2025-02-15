<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VoucherOwnerMiddleware {
    
    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->model('Reward_model');
        $this->CI->load->library('session');
    }

    public function verify_ownership() {
        // Get current user ID from session
        $user_id = $this->CI->session->userdata('user_id');
        if (!$user_id) {
            redirect('auth/login');
        }

        // Get voucher code from URL
        $kode_voucher = $this->CI->input->get('voucher_id');
        if (!$kode_voucher) {
            redirect('profile/myvoucher');
        }

        // Get voucher data and check ownership berdasarkan kode_voucher dan user_id
        $voucher = $this->CI->Reward_model->get_voucher_by_code_and_user($kode_voucher, $user_id);
        if (!$voucher) {
            // Redirect jika voucher tidak ditemukan atau bukan milik user
            redirect('profile/myvoucher');
        }

        return true;
    }
}