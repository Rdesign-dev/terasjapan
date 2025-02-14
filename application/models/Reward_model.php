<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reward_model extends CI_Model {

    public function get_reward_by_id($reward_id) {
        $this->db->where('id', $reward_id);
        $query = $this->db->get('rewards');
        return $query->row();
    }

    public function get_branches_by_reward_id($reward_id) {
        $this->db->select('branch.branch_name');
        $this->db->from('reward_branch');
        $this->db->join('branch', 'reward_branch.branch_id = branch.id');
        $this->db->where('reward_branch.reward_id', $reward_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_vouchers_by_user_id($user_id) {
        $this->db->select('rewards.title, rewards.image_name, rewards.points_required, rewards.category, redeem_voucher.redeem_date, redeem_voucher.status, redeem_voucher.kode_voucher, redeem_voucher.expires_at');
        $this->db->from('redeem_voucher');
        $this->db->join('rewards', 'rewards.id = redeem_voucher.reward_id');
        $this->db->where('redeem_voucher.user_id', $user_id);
        $query = $this->db->get();
        
        // Debugging
        log_message('debug', 'Query: ' . $this->db->last_query());
        log_message('debug', 'Vouchers: ' . print_r($query->result(), true));
        
        return $query->result();
    }

    public function redeem_reward($user_id, $reward_id) {
        $this->db->trans_start(); // Mulai transaksi

        // Ambil data user & reward
        $user = $this->db->get_where('users', ['id' => $user_id])->row();
        $reward = $this->get_reward_by_id((int)$reward_id);

        // Validasi user dan reward
        if (!$user || !$reward) {
            return ['status' => 'error', 'message' => 'Invalid user or reward'];
        }

        // Cek apakah user memiliki cukup poin
        if ($user->poin < $reward->points_required) {
            return ['status' => 'error', 'message' => 'Insufficient points'];
        }

        // Kurangi poin user
        $new_points = $user->poin - $reward->points_required;
        $this->db->where('id', $user_id);
        $this->db->update('users', ['poin' => $new_points]);

        // Generate kode voucher unik
        $promo_code = strtoupper(substr($reward->title, 0, 4)); // 4 karakter pertama dari nama promo
        $date_code = date('dm'); // tanggal dan bulan redeem
        $user_code = strtoupper(substr($user->name, 0, 3)); // 3 huruf pertama dari nama user

        // Hitung berapa kali user sudah redeem promo ini
        $this->db->where('user_id', $user_id);
        $this->db->where('reward_id', $reward_id);
        $count = $this->db->count_all_results('redeem_voucher') + 1; // tambahkan 1 untuk voucher yang baru di-redeem

        $voucher_code = sprintf('%s-%s-%s-%03d', $promo_code, $date_code, $user_code, $count);

        // Generate QR code using goqr.me API
        $qr_image_name = 'vcreward-' . $count . '.png';
        $qr_image_path = 'assets/image/qrcode/' . $qr_image_name;
        $qr_url = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($voucher_code);
        
        // Debugging: Log QR URL
        log_message('debug', 'QR URL: ' . $qr_url);

        // Get QR image content
        $qr_image = file_get_contents($qr_url);
        if ($qr_image === FALSE) {
            return ['status' => 'error', 'message' => 'Failed to generate QR code'];
        }

        // Save QR image to file
        if (file_put_contents(FCPATH . $qr_image_path, $qr_image) === FALSE) {
            return ['status' => 'error', 'message' => 'Failed to save QR code image'];
        }

        // Simpan data ke `redeem_voucher`
        $data = [
            'user_id' => $user_id,
            'reward_id' => $reward_id,
            'points_used' => $reward->points_required,
            'redeem_date' => date('Y-m-d H:i:s'),
            'status' => 'Available', // Status default
            'qr_code_url' => $qr_image_name, // memenaggil berdasaekan nama
            'kode_voucher' => $voucher_code,
            "expires_at" => date('Y-m-d H:i:s', strtotime('+'.$reward->total_days.' days')) // Voucher expired in 7 days
        ];
        $this->db->insert('redeem_voucher', $data);

        $this->db->trans_complete(); // Selesaikan transaksi

        // Cek apakah transaksi berhasil
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

    // Metode untuk memeriksa dan memperbarui status voucher yang sudah expired
    public function update_expired_vouchers() {
        date_default_timezone_set('Asia/Jakarta');
        $this->db->where('expires_at <', date('Y-m-d H:i:s'));
        // $this->db->where('status !=', 'expired');
        $this->db->update('redeem_voucher', ['status' => 'Expired']);
    }
}
