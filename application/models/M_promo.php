<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_promo extends CI_Model {
    public function get_all_promos() {
        $this->db->select('brand_promo.*, brands.name as brand_name');
        $this->db->from('brand_promo');
        $this->db->join('brands', 'brands.id = brand_promo.id_brand', 'left');
        $this->db->where('brand_promo.status', 'Available');
        $this->db->where('brand_promo.available_from <=', date('Y-m-d H:i:s'));
        $this->db->where('brand_promo.valid_until >=', date('Y-m-d H:i:s'));
        $this->db->where('brand_promo.priority', 'Active'); // Tambahan ini untuk filter enum priority
        return $this->db->get()->result();
    }

    public function get_promo_by_id($id) {
        $this->db->select('brand_promo.*, brands.name as brand_name');
        $this->db->from('brand_promo');
        $this->db->join('brands', 'brands.id = brand_promo.id_brand', 'left');
        $this->db->where('brand_promo.id', $id);
        return $this->db->get()->row();
    }
}