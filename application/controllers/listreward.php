<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listreward extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('brand_model');
        $this->load->model('reward_model');
    }

    public function index() {
        // Get all brands with their rewards
        $data['all_brands'] = $this->get_brands_with_rewards();
        
        // Load view
        $this->load->view('home/listreward', $data);
    }

    private function get_brands_with_rewards() {
        // Get all active brands
        $brands = $this->brand_model->get_active_brands();
        
        // For each brand, get their rewards
        foreach ($brands as $brand) {
            $brand->rewards = $this->reward_model->get_rewards_by_brand($brand->id);
        }
        
        return $brands;
    }
}