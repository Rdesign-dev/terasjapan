<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_alamat extends CI_Model {
    public function get_all_brands() {
        $query = $this->db->get('brands');
        return $query->result();
    }

    public function get_addresses_by_brand($brand_id) {
        $subquery = $this->db->select('address_id')
                             ->from('address_brand')
                             ->where('brand_id', $brand_id)
                             ->get_compiled_select(); 
        $this->db->select('addresses.*, 
                           GROUP_CONCAT(DISTINCT brands.image ORDER BY brands.id SEPARATOR ",") AS brand_images', FALSE);
        $this->db->from('addresses');
        $this->db->join('address_brand', 'addresses.id = address_brand.address_id');
        $this->db->join('brands', 'address_brand.brand_id = brands.id');
        $this->db->where("addresses.id IN ($subquery)", NULL, FALSE);
        $this->db->group_by('addresses.id');
        $this->db->order_by('addresses.city', 'ASC'); // Urutkan berdasarkan abjad nama kota
    
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_addresses() {
        $this->db->select('addresses.*, 
                           GROUP_CONCAT(DISTINCT brands.image ORDER BY brands.id SEPARATOR ",") AS brand_images', FALSE);
        $this->db->from('addresses');
        $this->db->join('address_brand', 'addresses.id = address_brand.address_id');
        $this->db->join('brands', 'address_brand.brand_id = brands.id');
        $this->db->group_by('addresses.id');
        $this->db->order_by('addresses.city', 'ASC'); // Urutkan berdasarkan abjad nama kota
    
        $query = $this->db->get();
        return $query->result();
    }
}