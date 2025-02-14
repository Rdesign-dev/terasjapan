<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reward extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Reward_model');
        $this->load->library('session');
    }

    public function get_reward($id) {
        // Debugging
        log_message('debug', 'Received reward ID: ' . $id);

        // Validasi ID reward harus angka
        if (!ctype_digit($id)) {
            $this->output->set_status_header(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid reward ID']);
            return;
        }

        $reward = $this->Reward_model->get_reward_by_id($id);
        $branches = $this->Reward_model->get_branches_by_reward_id($id);
        $reward->branches = $branches;

        if (!$reward) {
            $this->output->set_status_header(404);
            echo json_encode(['status' => 'error', 'message' => 'Reward not found']);
            return;
        }

        $this->output->set_content_type('application/json')->set_status_header(200);
        echo json_encode($reward);
    }

    public function redeem() {
        $this->output->set_content_type('application/json');

        // Cek apakah user sudah login
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            $this->output->set_status_header(401);
            echo json_encode(['status' => 'error', 'message' => 'Please login to redeem rewards']);
            return;
        }

        // $reward_id = $this->input->post('reward_id');
        $data = json_decode(file_get_contents('php://input'), true);
        $reward_id = $data['reward_id'] ?? null;
        
        // Validasi reward_id
        if (!$reward_id || !is_numeric($reward_id)) {
            $this->output->set_status_header(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid reward ID']);
            return;
        }

        // Proses penukaran poin ke reward
        $result = $this->Reward_model->redeem_reward($user_id, $reward_id);

        if ($result['status'] == 'error') {
            $this->output->set_status_header(400);
        } else {
            $this->output->set_status_header(200);
        }

        echo json_encode($result);
    }
}
