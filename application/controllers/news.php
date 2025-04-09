<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('M_news');
        $this->load->helper('asset');
    }

    public function index() {
        redirect('home');
    }

    public function detail($id = null) {
        if (!$id) {
            redirect('home');
        }

        // Get news detail
        $data['news'] = $this->M_news->get_news_by_id($id);
        
        if (!$data['news']) {
            show_404();
        }

        // Load view
        $this->load->view('home/news', $data);
    }
}