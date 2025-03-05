<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_news extends CI_Model {
    public function get_all_news() {
        return $this->db->where('status', 'Active')
                        ->get('news_event')
                        ->result();
    }
}