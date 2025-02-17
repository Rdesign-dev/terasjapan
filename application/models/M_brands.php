<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_brands extends CI_Model {
    
    public function get_all_brands() {
        $this->db->select('id, name, image');
        $this->db->from('brands');
        $this->db->order_by('id', 'ASC');
        return $this->db->get()->result();
    }

    public function get_brand_by_name($brand_name) {
        $this->db->select('*');
        $this->db->from('brands');
        $this->db->where("LOWER(REPLACE(name, ' ', '')) =", strtolower($brand_name));
        return $this->db->get()->row();
    }
}