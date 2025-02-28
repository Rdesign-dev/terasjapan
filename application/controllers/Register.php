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
        $this->form_validation->set_rules('phone_number', 'Nomor Telepon', 'required');
        $this->form_validation->set_rules('referral_code', 'Kode Referral', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $name = $this->input->post('name');
            $phone_number = $this->format_phone_number($this->input->post('phone_number'));
            $referral_code = $this->input->post('referral_code');

            // Default points
            $referrer_points = 0;
            $referred_points = 10; // Fixed points for new user

            // Check if referral code is valid
            if (!empty($referral_code)) {
                $referrer = $this->User_model->get_user_by_referral_code($referral_code);
                if ($referrer) {
                    // Calculate points for referrer based on referral code
                    $referrer_points = $this->calculate_points();

                    // Add points to referrer
                    $this->User_model->update_user_points($referrer->id, $referrer_points);
                }
            }

            // Save user data
            $user_data = array(
                'name' => $name,
                'phone_number' => $phone_number,
                'poin' => $referred_points,
                'referral_code' => $this->generate_referral_code($name)
            );

            $this->User_model->insert_user($user_data);
            $new_user_id = $this->db->insert_id();

            // Save referral redeem history
            if (!empty($referral_code) && isset($referrer)) {
                $redeem_data = array(
                    'user_id' => $referrer->id,
                    'referred_user_id' => $new_user_id,
                    'referral_code' => $referral_code,
                    'redeem_date' => date('Y-m-d H:i:s'),
                    'referrer_points' => $referrer_points,
                    'referred_points' => $referred_points
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

    private function calculate_points() {
        $random = rand(1, 100);
        if ($random <= 85) {
            return 5;
        } elseif ($random <= 90) {
            return 10;
        } elseif ($random <= 93.5) {
            return 15;
        } else {
            return 20;
        }
    }

    private function format_phone_number($phone_number) {
        // Hapus semua karakter non-digit
        $phone_number = preg_replace('/[^0-9]/', '', $phone_number);
        
        // Jika dimulai dengan +62 atau 62, ubah ke format 0
        if (substr($phone_number, 0, 2) === '62') {
            $phone_number = '0' . substr($phone_number, 2);
        }
        
        return $phone_number;
    }
}
