<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_news extends CI_Model {
    
    public function get_active_news() {
        $this->db->where('status', 'Active');
        $this->db->order_by('id', 'DESC');
        return $this->db->get('news_event')->result();
    }

    public function get_news_by_id($id) {
        $this->db->where('id', $id);
        $this->db->where('status', 'Active');
        return $this->db->get('news_event')->row();
    }
}