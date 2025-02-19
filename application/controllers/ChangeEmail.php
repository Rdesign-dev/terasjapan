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
                echo json_encode(['status' => 'error', 'message' => 'Sorry, please check your email correctly.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Please try again later.']);
        }
    }

    // 2. Verifikasi OTP dan update email utama
    public function verify_otp() {
        $user_id = $this->session->userdata('user_id');
        $otp_input = $this->input->post('otp');
        
        if ($this->M_email->verify_email_otp($user_id, $otp_input)) {
            echo json_encode([
                'status' => 'success', 
                'message' => 'Change email successful',
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Please check your OTP code again.']);
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
$mail->Body = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Email - Japanese Theme</title>
    <style>
        /* Reset default styles */
        body, p, h1, h2, h3, ul, li {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* General body styling */
        body {
            font-family: "Arial", sans-serif;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }

        /* Email container */
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Header section */
        .header {
            background: linear-gradient(to right, #ff7f50, #ff4500);
            color: white;
            text-align: center;
            padding: 20px;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 14px;
        }

        /* Sakura decoration */
        .sakura {
            width: 100%;
            height: auto;
        }

        /* Main content */
        .content {
            padding: 20px;
            text-align: center;
        }

        .content h2 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #333;
        }

        .otp-code {
            background-color: #ff9900;
            color:rgb(255, 255, 255);
            font-size: 28px;
            font-weight: bold;
            padding: 15px;
            border-radius: 8px;
            display: inline-block;
            margin: 20px 0;
        }

        .content p {
            font-size: 14px;
            color: #555;
        }

        /* Footer section */
        .footer {
            background-color: #f4f4f4;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }

        .footer a {
            color: #ff4500;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>Konnichiwa!</h1>
            <p>Your One-Time Password (OTP) is here.</p>
        </div>

        <!-- Sakura Decoration -->

        <!-- Main Content -->
        <div class="content">
            <h2>Please use the following OTP to verify your account:</h2>
            <div class="otp-code">' . $otp . '</div>
            <p>This OTP will expire in <strong>5 minutes</strong>. Please do not share it with anyone.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>If you did not request this OTP, please ignore this email or <a href="#">contact support</a>.</p>
            <p>&copy; 2025 Teras japan. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
';
            
            return $mail->send();
        } catch (Exception $e) {
            return false;
        }
    }
}