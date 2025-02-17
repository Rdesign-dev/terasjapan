<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Explore extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('M_explore');
    }

    public function index() {
        $brand_id = $this->input->get('brand') ?? null;
        
        if ($brand_id) {
            $brand = $this->M_explore->get_brand_by_id($brand_id);
        } else {
            $brand = $this->M_explore->get_default_brand();
        }

        if (!$brand) {
            show_404();
        }

        $data = [
            'brand' => $brand,
            'promos' => $this->M_explore->get_brand_promos($brand->id),
            'all_brands' => $this->M_explore->get_all_brands()
        ];

        $this->load->view('explore/explore', $data);
    }

    public function get_brand_data() {
        $brand_id = $this->input->get('brand');
        $brand = $this->M_explore->get_brand_by_id($brand_id);
        
        if (!$brand) {
            $this->output->set_status_header(404);
            echo json_encode(['error' => 'Brand not found']);
            return;
        }

        $promos = $this->M_explore->get_brand_promos($brand_id);
        
        $response = [
            'id' => $brand->id,
            'name' => $brand->name,
            'desc' => $brand->desc,
            'logo' => base_url('assets/image/logo/' . $brand->image),
            'banner' => base_url('assets/image/banner/' . $brand->banner),
            'instagram' => $brand->instagram,
            'tiktok' => $brand->tiktok,
            'wa' => $brand->wa,
            'web' => $brand->web,
            'promos' => array_map(function($promo) {
                return [
                    'name' => $promo->promo_name,
                    'desc' => $promo->promo_desc,
                    'image' => base_url('assets/image/promo/' . $promo->promo_image)
                ];
            }, $promos)
        ];

        echo json_encode($response);
    }
}