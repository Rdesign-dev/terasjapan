<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_mission extends CI_Model {
    public function get_available_missions() {
        $query = $this->db->get('missions');
        return [
            'missions' => $query->result(),
            'missions_available' => $query->num_rows() > 0
        ];
    }
}