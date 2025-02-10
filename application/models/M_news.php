<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_news extends CI_Model {
    public function get_all_news() {
        $query = $this->db->get('news&event'); // Assuming 'news&event' is the table name
        return $query->result();
    }
}