<?php
// Login.php (Controller)
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['form_validation', 'session']);
        $this->load->helper(['url', 'form']); // Pastikan helper URL dimuat di sini
        $this->load->model('m_account');
    }

    public function index() {
        $this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $nomor_telepon = $this->input->post('nomor_telepon');
            $this->_send_otp($nomor_telepon);
        }
    }

    private function _send_otp($nomor_telepon) {
        // Periksa apakah nomor telepon tersedia di database
        $user = $this->m_account->get_user_by_phone($nomor_telepon);
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan!');
            $this->load->view('auth/login');
            return;
        }

        $otp = rand(100000, 999999);
        $this->m_account->simpan_otp($nomor_telepon, $otp);
        $this->session->set_flashdata('success', 'OTP telah dikirim ke nomor telepon Anda.');
        $this->load->view('auth/login', ['nomor_telepon' => $nomor_telepon, 'otp_sent' => true]);
    }

    public function verify() {
        $this->form_validation->set_rules('otp', 'OTP', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login', ['nomor_telepon' => $this->input->post('nomor_telepon'), 'otp_sent' => true]);
        } else {
            $nomor_telepon = $this->input->post('nomor_telepon');
            $otp = $this->input->post('otp');
            $this->_verifikasi_otp($nomor_telepon, $otp);
        }
    }

    private function _verifikasi_otp($nomor_telepon, $otp) {
        $otp_data = $this->m_account->cek_otp($nomor_telepon);
        if ($otp_data) {
            // Pastikan nilai waktu adalah numerik
            $otp_waktu = strtotime($otp_data['waktu']); // Konversi waktu ke timestamp
            if ($otp == $otp_data['otp'] && (time() - $otp_waktu <= 300)) {
                // Ambil data pengguna
                $user = $this->m_account->get_user_by_phone($nomor_telepon);
                
                // Set session data
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'nomor_telepon' => $user->nomor_telepon,
                    'logged_in' => TRUE
                ]);

                $this->session->set_flashdata('success', 'OTP benar, login berhasil!');
                // $this->m_account->reset_otp($nomor_telepon);
                redirect('home');
            } else {
                $this->session->set_flashdata('error', 'OTP salah atau expired!');
                $this->load->view('auth/login', ['nomor_telepon' => $nomor_telepon, 'otp_sent' => true]);
            }
        } else {
            $this->session->set_flashdata('error', 'Nomor tidak terdaftar!');
            $this->load->view('auth/login', ['nomor_telepon' => $nomor_telepon, 'otp_sent' => true]);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
