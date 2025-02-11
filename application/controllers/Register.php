<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'required');
        $this->form_validation->set_rules('referral_code', 'Kode Referral', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $name = $this->input->post('name');
            $nomor_telepon = $this->input->post('nomor_telepon');
            $referral_code = $this->input->post('referral_code');

            // Default points
            $points = 0;

            // Check if referral code is valid
            if (!empty($referral_code)) {
                $referrer = $this->User_model->get_user_by_referral_code($referral_code);
                if ($referrer) {
                    // Add points for valid referral
                    $points += 10; // Example: Add 10 points for valid referral
                }
            }

            // Save user data
            $user_data = array(
                'name' => $name,
                'nomor_telepon' => $nomor_telepon,
                'poin' => $points,
                'referral_code' => $this->generate_referral_code($name)
            );

            $this->User_model->insert_user($user_data);
            $new_user_id = $this->db->insert_id();

            // Save referral redeem history
            if (!empty($referral_code) && isset($referrer)) {
                $redeem_data = array(
                    'user_id' => $new_user_id,
                    'referred_user_id' => $referrer->id,
                    'referral_code' => $referral_code,
                    'redeem_date' => date('Y-m-d H:i:s')
                );
                $this->User_model->insert_referral_redeem($redeem_data);
            }

            $this->session->set_flashdata('success', 'Registration successful!');
            redirect('login');
        }
    }

    private function generate_referral_code($name) {
        $name_parts = explode(' ', $name);
        $referral_code = '';

        if (count($name_parts) > 2) {
            foreach ($name_parts as $part) {
                $referral_code .= strtoupper($part[0]);
            }
        } elseif (count($name_parts) == 2) {
            $referral_code .= strtoupper(substr($name_parts[0], 0, 2));
            $referral_code .= strtoupper($name_parts[1][0]);
        } else {
            $referral_code .= strtoupper(substr($name_parts[0], 0, 3));
        }

        $referral_code .= rand(100, 999);

        // Ensure the referral code is unique
        while ($this->User_model->is_referral_code_exists($referral_code)) {
            $referral_code = substr($referral_code, 0, -3) . rand(100, 999);
        }

        return $referral_code;
    }
}
