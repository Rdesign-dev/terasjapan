<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('asset');
        $this->load->model('User_model');
        $this->load->model('Reward_model');
        $this->load->model('M_promo');
        $this->load->model('m_reward');
        $this->load->model('M_news');
        $this->load->model('M_brands');
        $this->load->model('M_mission');
        $this->load->model('M_alamat'); // Pastikan Anda memuat model M_alamat
        $this->load->model('M_banner');
        $this->load->model('Popup_model');
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->get_user_by_id($user_id);

        if ($user) {
            $data['name'] = $user->name;
            $data['poin'] = isset($user->poin) ? $user->poin : 0;
            $data['balance'] = $user->balance;
        } else {
            $data['name'] = 'Guest';
            $data['poin'] = 0;
            $data['balance'] = 0;
        }

        // Get promos
        $data['promos'] = $this->M_promo->get_all_promos();

        $data['rewards'] = $this->m_reward->get_all_rewards();
        $data['news'] = $this->M_news->get_active_news(); // Menggunakan get_active_news() sebagai gantinya
        $data['brands'] = $this->M_brands->get_all_brands();
        $data['missions'] = $this->M_mission->get_available_missions();
        $data['user_missions'] = $this->M_mission->get_user_missions($user_id);
        $data['banners'] = $this->M_banner->get_active_banners();

        // Get random active popup
        $data['popup'] = $this->Popup_model->get_active_popup();
        $this->load->view('home/index', $data);
    }

    public function alamat() {
        $data['brands'] = $this->M_alamat->get_all_brands();
        $this->load->view('home/alamat', $data);
    }

    public function get_all_addresses() {
        $addresses = $this->M_alamat->get_all_addresses();
        echo json_encode($addresses);
    }

    public function get_addresses_by_brand($brand_id) {
        $addresses = $this->M_alamat->get_addresses_by_brand($brand_id);
        echo json_encode($addresses);
    }

    public function listreward()
    {
        // Load required models 
        $this->load->model('M_brands');
        $this->load->model('Reward_model');
        $this->load->model('User_model');

        // Get user data
        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->get_user_by_id($user_id);
        
        if ($user) {
            $data['name'] = $user->name;
            $data['poin'] = isset($user->poin) ? $user->poin : 0;
        } else {
            $data['name'] = 'Guest';
            $data['poin'] = 0;
        }

        // Get all brands
        $data['all_brands'] = $this->M_brands->get_all_brands();

        // For each brand, get their available rewards
        foreach ($data['all_brands'] as $brand) {
            $brand->rewards = $this->Reward_model->get_rewards_by_brand($brand->id);
        }

        // Load view
        $this->load->view('home/listreward', $data);
    }

    public function news($id = null) {
        // Validasi ID
        if (!$id || !is_numeric($id)) {
            $data['news'] = null;
            $this->load->view('home/news', $data);
            return;
        }

        // Get news detail
        $data['news'] = $this->M_news->get_news_by_id($id);
        
        // Load view
        $this->load->view('home/news', $data);
    }
}
