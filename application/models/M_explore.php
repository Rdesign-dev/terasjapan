<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_explore extends CI_Model {
    
    public function get_brand_by_id($brand_id) {
        return $this->db->get_where('brands', ['id' => $brand_id])->row();
    }

    public function get_default_brand() {
        return $this->db->get_where('brands', ['name' => 'Teras Japan'])->row();
    }

    public function get_all_brands() {
        return $this->db->get('brands')->result();
    }

    public function get_brand_promos($brand_id, $status) {
        return $this->db->select('id, promo_name, promo_desc, promo_image, status')
                        ->where([
                            'id_brand' => $brand_id,
                            'status' => $status
                        ])->get('brand_promo')->result();
    }
}