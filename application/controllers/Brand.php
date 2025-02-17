<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('M_brands');
    }

    public function detail() {
        $brand_name = $this->input->get('brand_name');
        $brand = $this->M_brands->get_brand_by_name($brand_name);
        
        if (!$brand) {
            show_404();
        }

        $data['brand'] = $brand;
        $this->load->view('home/detail', $data);
    }
}