<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $name = $this->input->post('name');
        $phone_number = $this->format_phone_number($this->input->post('phone_number'));
        
        // Check if phone number already exists
        if ($this->User_model->check_phone_exists($phone_number)) {
            $this->session->set_flashdata('error', 'This phone number is already registered');
            redirect('login');
            return;
        }

        // Continue with registration if phone doesn't exist
        $referral_code = strtoupper(substr($name, 0, 3) . rand(100, 999));
        
        $user_data = array(
            'name' => $name,
            'phone_number' => $phone_number,
            'poin' => 10,
            'referral_code' => $referral_code
        );

        if ($this->User_model->insert_user($user_data)) {
            // Generate OTP
            $otp = rand(100000, 999999);
            $this->load->model('m_account');
            $this->m_account->simpan_otp($phone_number, $otp);

            $this->session->set_flashdata('success', 'Registration successful! Please verify your phone number.');
            redirect('login?phone=' . $phone_number . '&otp_sent=true');
        } else {
            $this->session->set_flashdata('error', 'Registration failed. Please try again.');
            redirect('login');
        }
    }

    // Add this new function to check phone number
    public function check_phone_number($phone_number) {
        $formatted_phone = $this->format_phone_number($phone_number);
        
        // Check if phone number already exists
        $existing_user = $this->User_model->get_user_by_phone($formatted_phone);
        
        if ($existing_user) {
            $this->form_validation->set_message('check_phone_number', 'This phone number is already registered.');
            return FALSE;
        }
        
        return TRUE;
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
