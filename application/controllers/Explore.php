<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Explore extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('M_explore');
        $this->load->model('Reward_model');
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

        // Tambahkan ini untuk memastikan rewards tersedia saat pertama load
        $rewards = $this->Reward_model->get_rewards_by_brand($brand->id);

        $data = [
            'brand' => $brand,
            'available_promos' => $this->M_explore->get_brand_promos($brand->id, 'Available'),
            'coming_promos' => $this->M_explore->get_brand_promos($brand->id, 'Coming'),
            'rewards' => $rewards, // Kirim rewards ke view
            'all_brands' => $this->M_explore->get_all_brands()
        ];

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