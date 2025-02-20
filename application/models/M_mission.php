<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_mission extends CI_Model {
    public function get_available_missions() {
        $query = $this->db->get('missions');
        return $query->result();
    }

    public function get_user_missions($user_id) {
        $this->db->select('user_missions.*, missions.title, missions.point_reward');
        $this->db->from('user_missions');
        $this->db->join('missions', 'user_missions.mission_id = missions.id');
        $this->db->where('user_missions.user_id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }
}