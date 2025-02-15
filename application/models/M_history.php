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
}