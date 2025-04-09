<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_level extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function get_all_levels() {
        return $this->db->order_by('min_spending', 'ASC')->get('user_levels')->result();
    }

    public function get_user_total_spending($user_id) {
        // First get user's deleted status and time_deleted
        $user = $this->db->select('deleted, time_deleted')
                        ->where('id', $user_id)
                        ->get('users')
                        ->row();

        $this->db->select_sum('amount');
        $this->db->where('user_id', $user_id);
        $this->db->where('transaction_type', 'Teras Japan Payment');
        
        // If user was soft deleted before, only count transactions after time_deleted
        if ($user && $user->deleted == 1 && $user->time_deleted) {
            $this->db->where('created_at >', $user->time_deleted);
        }
        
        $query = $this->db->get('transactions');
        return $query->row()->amount ?? 0;
    }

    public function update_user_level($user_id, $level_id) {
        return $this->db->where('id', $user_id)->update('users', ['level_id' => $level_id]);
    }

    public function get_user_deleted_status($user_id) {
        return $this->db->select('deleted, time_deleted')
                        ->where('id', $user_id)
                        ->get('users')
                        ->row();
    }
}