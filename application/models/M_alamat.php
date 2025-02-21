<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_alamat extends CI_Model {
    public function get_all_brands() {
        $query = $this->db->get('brands');
        return $query->result();
    }

    public function get_addresses_by_brand($brand_id) {
        $this->db->select('addresses.*, GROUP_CONCAT(DISTINCT brands.image) as brand_images');
        $this->db->from('addresses');
        $this->db->join('address_brand', 'addresses.id = address_brand.address_id');
        $this->db->join('brands', 'address_brand.brand_id = brands.id');
        $this->db->where('address_brand.brand_id', $brand_id);
        $this->db->group_by('addresses.id');
        $query = $this->db->get();
        return $query->result();
    }
}