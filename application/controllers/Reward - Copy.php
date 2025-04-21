<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reward extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Reward_model');
        $this->load->library('session');
    }

    public function get_reward($id) {
        log_message('debug', 'Received reward ID: ' . $id);

        if (!ctype_digit($id)) {
            $this->output->set_status_header(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid reward ID']);
            return;
        }

        try {
            log_message('debug', 'Attempting to fetch reward data');
            $reward = $this->Reward_model->get_reward_by_id($id);
            log_message('debug', 'Reward data: ' . print_r($reward, true));
            
            if (!$reward) {
                $this->output->set_status_header(404);
                echo json_encode(['status' => 'error', 'message' => 'Reward not found']);
                return;
            }
            
            // Tambahkan status success dalam response
            $response = [
                'status' => 'success',
                'data' => $reward
            ];
            
            $this->output->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode($response));
                        
        } catch (Exception $e) {
            log_message('error', 'Error fetching reward: ' . $e->getMessage());
            $this->output->set_status_header(500);
            echo json_encode(['status' => 'error', 'message' => 'Error fetching reward data']);
        }
    }

    public function redeem() {
        // Disable error output
        ini_set('display_errors', 0);
        
        // Ensure clean output
        if (ob_get_level()) ob_end_clean();
        
        header('Content-Type: application/json');
        
        try {
            // Cek apakah user sudah login
            $user_id = $this->session->userdata('user_id');
            if (!$user_id) {
                $this->output->set_status_header(401);
                echo json_encode(['status' => 'error', 'message' => 'Please login to redeem rewards']);
                return;
            }

            $data = json_decode(file_get_contents('php://input'), true);
            $reward_id = $data['reward_id'] ?? null;
            
            if (!$reward_id || !is_numeric($reward_id)) {
                $this->output->set_status_header(400);
                echo json_encode(['status' => 'error', 'message' => 'Invalid reward ID']);
                return;
            }

            $result = $this->Reward_model->redeem_reward($user_id, $reward_id);

            if ($result['status'] == 'error') {
                $this->output->set_status_header(400);
                echo json_encode($result);
                return;
            }

            echo json_encode($result);
        } catch (Exception $e) {
            log_message('error', 'Redeem error: ' . $e->getMessage());
            $this->output->set_status_header(500);
            echo json_encode(['status' => 'error', 'message' => 'An error occurred while processing your request']);
        }
    }
}
