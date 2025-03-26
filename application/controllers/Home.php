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
        $this->load->model('m_promo');
        $this->load->model('m_reward');
        $this->load->model('m_news');
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

        $data['promos'] = $this->m_promo->get_all_promos();
        $data['rewards'] = $this->m_reward->get_all_rewards();
        $data['news'] = $this->m_news->get_all_news();
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
}

class Reward extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Reward_model');
    }

    public function redeem() {
        // Implementasi redeem reward
    }
}
