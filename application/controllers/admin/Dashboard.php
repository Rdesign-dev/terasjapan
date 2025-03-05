<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        
        // TODO: Uncomment this section when implementing admin authentication
        /*
        // Check if admin is logged in
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        */
    }
    
    public function index() {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/dashboard/index');
        $this->load->view('admin/template/footer');
    }

}
