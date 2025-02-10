<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_reward extends CI_Model {
    public function get_all_rewards() {
        $query = $this->db->get('rewards'); // Assuming 'rewards' is the table name
        return $query->result();
    }
}