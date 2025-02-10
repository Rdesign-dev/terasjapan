<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class ChangeEmail extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('M_email'); // Load model M_email
    }

    // 1. Mengirim OTP ke email baru
    public function request_change_email() {
        $new_email = $this->input->post('new_email');
        $user_id = $this->session->userdata('user_id');
        
        // Generate OTP
        $otp = rand(100000, 999999);
        
        // Simpan email sementara dan OTP
        if ($this->M_email->save_email_otp($user_id, $new_email, $otp)) {
            // Kirim email
            if ($this->send_otp_email($new_email, $otp)) {
                echo json_encode(['status' => 'success', 'message' => 'OTP sent to email']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to send OTP']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save OTP']);
        }
    }

    // 2. Verifikasi OTP dan update email utama
    public function verify_otp() {
        $user_id = $this->session->userdata('user_id');
        $otp_input = $this->input->post('otp');
        
        if ($this->M_email->verify_email_otp($user_id, $otp_input)) {
            echo json_encode(['status' => 'success', 'message' => 'Email updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid or expired OTP']);
        }
    }

    // Fungsi Kirim Email OTP
    private function send_otp_email($to_email, $otp) {
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'surya.eko.pra@gmail.com';
            $mail->Password = 'zfso zzfo sbxq bisb';
            $mail->Port = 587;
            
            $mail->setFrom('cs@terasjapan.com');
            $mail->addAddress($to_email);
            $mail->isHTML(true);
            $mail->Subject = 'Verifikasi OTP Email Baru';
            $mail->Body = '<p>Kode OTP Anda: <b>' . $otp . '</b></p>';
            
            return $mail->send();
        } catch (Exception $e) {
            return false;
        }
    }
}
