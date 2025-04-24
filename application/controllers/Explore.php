<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Explore extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('M_explore');
        $this->load->model('Reward_model');
    }

    public function index() {
        $default_brand = $this->M_explore->get_default_brand();
        $data['brand'] = $default_brand;
        $data['all_brands'] = $this->M_explore->get_all_brands();
        
        // Menggunakan fungsi get_brand_promos yang sudah dimodifikasi
        $data['available_promos'] = $this->M_explore->get_brand_promos($default_brand->id, 'Available');
        $data['coming_promos'] = $this->M_explore->get_brand_promos($default_brand->id, 'Coming');
        
        // Tambahkan data rewards untuk tampilan awal
        $data['rewards'] = $this->Reward_model->get_rewards_by_brand($default_brand->id);
        
        $this->load->view('explore/explore', $data);
    }

    public function get_brand_data() {
        $brand_id = $this->input->get('brand');
        $brand = $this->M_explore->get_brand_by_id($brand_id);

        if (!$brand) {
            return $this->output->set_status_header(404)->set_output(json_encode(['error' => 'Brand not found']));
        }

        $response = [
            'name' => $brand->name,
            'image' => $brand->image, // Just send the filename
            'banner' => $brand->banner, // Just send the filename
            'instagram' => $brand->instagram,
            'tiktok' => $brand->tiktok,
            'wa' => $brand->wa,
            'web' => $brand->web,
            'available_promos' => $this->M_explore->get_brand_promos($brand_id, 'Available'),
            'coming_promos' => $this->M_explore->get_brand_promos($brand_id, 'Coming'),
            'available_rewards' => $this->Reward_model->get_rewards_by_brand($brand_id)
        ];

        echo json_encode($response);
    }
}