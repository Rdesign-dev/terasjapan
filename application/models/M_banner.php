<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_banner extends CI_Model {
    
    private $table = 'banner';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_active_banners() {
        $this->db->where('status', 'Active');
        $query = $this->db->get($this->table);
        return $query->result();
    }
}