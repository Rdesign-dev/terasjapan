<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['form_validation', 'session']);
        $this->load->helper(['url', 'form']);
        $this->load->model('m_account');
    }

    public function index() {
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $phone_number = $this->format_phone_number($this->input->post('phone_number'));
            $this->_send_otp($phone_number);
        }
    }

    private function _send_otp($phone_number) {
        // Periksa apakah nomor telepon tersedia di database
        $user = $this->m_account->get_user_by_phone($phone_number);
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan!');
            $this->load->view('auth/login');
            return;
        }

        $otp = rand(100000, 999999);
        $this->m_account->simpan_otp($phone_number, $otp);
        $this->session->set_flashdata('success', 'OTP telah dikirim ke nomor telepon Anda.');
        $this->load->view('auth/login', ['phone_number' => $phone_number, 'otp_sent' => true]);
    }

    public function verify() {
        $this->form_validation->set_rules('otp', 'OTP', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login', ['phone_number' => $this->input->post('phone_number'), 'otp_sent' => true]);
        } else {
            $phone_number = $this->format_phone_number($this->input->post('phone_number'));
            $otp = $this->input->post('otp');
            $this->_verifikasi_otp($phone_number, $otp);
        }
    }

    private function _verifikasi_otp($phone_number, $otp) {
        $otp_data = $this->m_account->cek_otp($phone_number);
        if ($otp_data) {
            $otp_waktu = strtotime($otp_data['waktu']);
            if ($otp == $otp_data['otp'] && (time() - $otp_waktu <= 300)) {
                $user = $this->m_account->get_user_by_phone($phone_number);
                
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'phone_number' => $user->phone_number,
                    'logged_in' => TRUE
                ]);

                $this->session->set_flashdata('success', 'OTP benar, login berhasil!');
                redirect('home');
            } else {
                $this->session->set_flashdata('error', 'OTP salah atau expired!');
                $this->load->view('auth/login', ['phone_number' => $phone_number, 'otp_sent' => true]);
            }
        } else {
            $this->session->set_flashdata('error', 'Nomor tidak terdaftar!');
            $this->load->view('auth/login', ['phone_number' => $phone_number, 'otp_sent' => true]);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
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
