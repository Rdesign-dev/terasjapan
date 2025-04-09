<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model {
    
    public function get_active_news() {
        $this->db->where('status', 'Active');
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('news')->result();
    }

    public function get_news_by_id($id) {
        $this->db->where('id', $id);
        $this->db->where('status', 'Active');
        return $this->db->get('news')->row();
    }

    // Optional: Method untuk mendapatkan berita terbaru dengan limit
    public function get_latest_news($limit = 4) {
        $this->db->where('status', 'Active');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get('news')->result();
    }
}