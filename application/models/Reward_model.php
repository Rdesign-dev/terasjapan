<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reward_model extends CI_Model {

    public function get_reward_by_id($reward_id) {
        log_message('debug', 'Getting reward with ID: ' . $reward_id);
        
        $this->db->select('rewards.*, brands.name as brand_name');
        $this->db->from('rewards');
        $this->db->join('brands', 'brands.id = rewards.brand_id', 'left');
        $this->db->where('rewards.id', $reward_id);
        $this->db->where('rewards.qty >', 0);
        $this->db->where('rewards.valid_until >', date('Y-m-d H:i:s'));
        
        $query = $this->db->get();
        
        log_message('debug', 'Reward query: ' . $this->db->last_query());
        
        return $query->row();
    }

    public function get_vouchers_by_user_id($user_id) {
        $this->db->select('rewards.title, rewards.image_name, rewards.points_required, rewards.category, 
                           redeem_voucher.redeem_date, redeem_voucher.status, redeem_voucher.kode_voucher, 
                           redeem_voucher.expires_at, redeem_voucher.qr_code_url,
                           brands.id as brand_id, brands.name as brand_name, brands.desc as brand_desc,
                           brands.image as brand_image, brands.banner as brand_banner,
                           brands.instagram, brands.tiktok, brands.wa, brands.web');
        $this->db->from('redeem_voucher');
        $this->db->join('rewards', 'rewards.id = redeem_voucher.reward_id');
        $this->db->join('brands', 'brands.id = redeem_voucher.brand_id', 'left');
        $this->db->where('redeem_voucher.user_id', $user_id);
        $query = $this->db->get();
        
        log_message('debug', 'Voucher query: ' . $this->db->last_query());
        
        return $query->result();
    }

    public function redeem_reward($user_id, $reward_id) {
        $this->db->trans_start();

        // Get user & reward data
        $user = $this->db->get_where('users', ['id' => $user_id])->row();
        $reward = $this->get_reward_by_id((int)$reward_id);

        // Validation checks
        if (!$user || !$reward) {
            return ['status' => 'error', 'message' => 'Invalid user or reward'];
        }

        if ($reward->qty <= 0) {
            return ['status' => 'error', 'message' => 'Reward is out of stock'];
        }

        if ($user->poin < $reward->points_required) {
            return ['status' => 'error', 'message' => 'Insufficient points'];
        }

        // Update reward quantity
        $this->db->where('id', $reward_id);
        $this->db->set('qty', 'qty-1', FALSE);
        $this->db->update('rewards');

        // Update user points
        $new_points = $user->poin - $reward->points_required;
        $this->db->where('id', $user_id);
        $this->db->update('users', ['poin' => $new_points]);

        // Generate voucher code
        $promo_code = strtoupper(substr($reward->title, 0, 4));
        $date_code = date('dm');
        $user_code = strtoupper(substr($user->name, 0, 3));

        // Check existing redemptions
        $this->db->where('user_id', $user_id);
        $this->db->where('reward_id', $reward_id);
        $count = $this->db->count_all_results('redeem_voucher') + 1;

        $voucher_code = sprintf('%s-%s-%s-%03d', $promo_code, $date_code, $user_code, $count);

        // Generate QR code
        $qr_image_name = 'vcreward-' . $user_code . '-' . $date_code . '-' . uniqid() . '.png';
        $qr_image_path = 'assets/image/qrcode/' . $qr_image_name;
        $qr_url = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($voucher_code);

        $qr_image = file_get_contents($qr_url);
        if ($qr_image === FALSE) {
            return ['status' => 'error', 'message' => 'Failed to generate QR code'];
        }

        if (file_put_contents(FCPATH . $qr_image_path, $qr_image) === FALSE) {
            return ['status' => 'error', 'message' => 'Failed to save QR code image'];
        }

        // Save redemption data
        $data = [
            'user_id' => $user_id,
            'reward_id' => $reward_id,
            'brand_id' => $reward->brand_id, // Add brand_id
            'points_used' => $reward->points_required,
            'redeem_date' => date('Y-m-d H:i:s'),
            'status' => 'Available',
            'qr_code_url' => $qr_image_name,
            'kode_voucher' => $voucher_code,
            'expires_at' => date('Y-m-d H:i:s', strtotime('+'.$reward->total_days.' days'))
        ];
        
        $this->db->insert('redeem_voucher', $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return ['status' => 'error', 'message' => 'Transaction failed'];
        }

        return ['status' => 'success', 'message' => 'Reward redeemed successfully', 'voucher_code' => $voucher_code];
    }

    public function get_voucher_by_code($kode_voucher) {
        $this->db->select('rewards.title, rewards.image_name, rewards.points_required, rewards.category, redeem_voucher.redeem_date, redeem_voucher.status, redeem_voucher.kode_voucher, redeem_voucher.expires_at, redeem_voucher.qr_code_url');
        $this->db->from('redeem_voucher');
        $this->db->join('rewards', 'rewards.id = redeem_voucher.reward_id');
        $this->db->where('redeem_voucher.kode_voucher', $kode_voucher);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_voucher_by_code_and_user($kode_voucher, $user_id) {
        $this->db->select('rewards.title, rewards.image_name, rewards.points_required, rewards.category, 
                           redeem_voucher.redeem_date, redeem_voucher.status, redeem_voucher.kode_voucher, 
                           redeem_voucher.expires_at, redeem_voucher.qr_code_url,
                           brands.id as brand_id, brands.name as brand_name');
        $this->db->from('redeem_voucher');
        $this->db->join('rewards', 'rewards.id = redeem_voucher.reward_id');
        $this->db->join('brands', 'brands.id = redeem_voucher.brand_id', 'left');
        $this->db->where('redeem_voucher.kode_voucher', $kode_voucher);
        $this->db->where('redeem_voucher.user_id', $user_id);
        
        $query = $this->db->get();
        
        // Debug the query and result
        log_message('debug', 'SQL Query: ' . $this->db->last_query());
        $result = $query->row();
        log_message('debug', 'Query result in model: ' . print_r($result, true));
        
        return $result;
    }

    // Metode untuk memeriksa dan memperbarui status voucher yang sudah expired
    public function update_expired_vouchers() {
        date_default_timezone_set('Asia/Jakarta');
        $this->db->where('expires_at <', date('Y-m-d H:i:s'));
        // $this->db->where('status !=', 'expired');
        $this->db->update('redeem_voucher', ['status' => 'Expired']);
    }
}
