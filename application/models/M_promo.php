<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_promo extends CI_Model {
    public function get_all_promos() {
        $query = $this->db->get('promo'); // Assuming 'promo' is the table name
        return $query->result();
    }
}