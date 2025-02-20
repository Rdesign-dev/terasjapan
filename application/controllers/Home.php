<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url'); // Ensure URL helper is loaded
        $this->load->model('User_model'); // Load the user model
        $this->load->model('Reward_model');
        $this->load->model('m_promo'); // Load the promo model
        $this->load->model('m_reward'); // Load the reward model
        $this->load->model('m_news'); // Load the news model
        $this->load->model('M_brands');
        $this->load->model('M_mission');
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->get_user_by_id($user_id);

        if ($user) {
            $data['name'] = $user->name;
            $data['poin'] = isset($user->poin) ? $user->poin : 0;
            $data['balance'] = $user->balance; // Update this line to use 'balance' instead of 'saldo'
        } else {
            $data['name'] = 'Guest';
            $data['poin'] = 0;
            $data['balance'] = 0; // Update this line to use 'balance' instead of 'saldo'
        }

        // Get all promos from the database
        $data['promos'] = $this->m_promo->get_all_promos();

        // Get all rewards from the database
        $data['rewards'] = $this->m_reward->get_all_rewards();

        // Get all news from the database
        $data['news'] = $this->m_news->get_all_news();
        
        $data['brands'] = $this->M_brands->get_all_brands();

        // Get missions and user missions
        $data['missions'] = $this->M_mission->get_available_missions();
        $data['user_missions'] = $this->M_mission->get_user_missions($user_id);

        $this->load->view('home/index', $data);
    }

    public function alamat() { // Ensure this method name matches the link
        $this->load->view('home/alamat');
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