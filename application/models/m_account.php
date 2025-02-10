<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_account extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    // Generate a unique referral code
    private function generate_referral_code($name) {
        do {
            // Split the name into words
            $name_parts = explode(' ', $name);
            $name_part = '';

            if (count($name_parts) >= 3) {
                $name_part = strtoupper($name_parts[0][0] . $name_parts[1][0] . $name_parts[2][0]);
            } elseif (count($name_parts) == 2) {
                $name_part = strtoupper(substr($name_parts[0], 0, 2) . $name_parts[1][0]);
            } else {
                $name_part = strtoupper(substr($name_parts[0], 0, 3));
            }

            // Generate 3 random digits
            $random_numbers = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $referral_code = $name_part . $random_numbers;
        } while ($this->referral_code_exists($referral_code));

        return $referral_code;
    }

    // Check if a referral code already exists in the database
    private function referral_code_exists($code) {
        return $this->db->where('referral_code', $code)->count_all_results('users') > 0;
    }

    // Register user
    public function daftar($data) {
        $referral_code = $this->generate_referral_code($data['name']);
        $data['referral_code'] = $referral_code;
        $data['saldo'] = 0.00;
        $data['photo'] = NULL;

        $insert = $this->db->insert('users', $data);

        if (!$insert) {
            log_message('error', 'Failed to register user: ' . $this->db->last_query());
        }

        return $insert;
    }

    // Fungsi untuk menyimpan OTP
    // public function simpan_otp($nomor_telepon, $otp) {
    //     $data = array(
    //         'nomor_telepon' => $nomor_telepon,
    //         'otp' => $otp,
    //         'waktu' => date('Y-m-d H:i:s') // Simpan waktu saat ini dalam format yang valid
    //     );
    //     // Simpan atau update OTP di database
    //     $this->db->replace('users', $data);

    //     // Kirim OTP ke WhatsApp menggunakan API Fontee
    //     $this->kirim_otp_ke_whatsapp($nomor_telepon, $otp);
    // }

    public function simpan_otp($nomor_telepon, $otp) {
        date_default_timezone_set('Asia/Jakarta');
        $data = array(
                    'otp' => $otp,
                    'waktu' => date('Y-m-d H:i:s') // Simpan waktu saat ini dalam format yang valid
                );
                // Simpan atau update OTP di database
                $this->db->where('nomor_telepon', $nomor_telepon);
                $this->db->update('users', $data);
        
                // Kirim OTP ke WhatsApp menggunakan API Fontee
                $this->kirim_otp_ke_whatsapp($nomor_telepon, $otp);
    }

    // Fungsi untuk memeriksa OTP
    public function cek_otp($nomor_telepon) {
        $this->db->where('nomor_telepon', $nomor_telepon);
        $query = $this->db->get('users');
        $otp_data = $query->row_array();

        return $otp_data;
    }

    // public function reset_otp($nomor_telepon) {
    //     $this->db->where('nomor_telepon', $nomor_telepon);
    //     $this->db->update('users', ['otp' => NULL, 'waktu' => NULL]);
    // }

    // Fungsi untuk mengambil data pengguna berdasarkan nomor telepon
    public function get_user_by_phone($nomor_telepon) {
        return $this->db->where('nomor_telepon', $nomor_telepon)->get('users')->row();
    }

    // Fungsi untuk memasukkan data pengguna baru
    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    // Fungsi untuk mengirim OTP ke WhatsApp menggunakan API Fontee
    private function kirim_otp_ke_whatsapp($nomor_telepon, $otp) {
        $token = $this->config->item('fonnte_token');
        $message = "$otp sebagai kode verifikasi untuk login ke aplikasi kami. Jangan berikan kode ini kepada siapapun.";

        $data = [
            'target' => $nomor_telepon,
            'message' => $message,
            'countryCode' => '62', // Kode negara Indonesia
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.fonnte.com/send");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: $token"
        ]);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            log_message('error', 'Error sending OTP to WhatsApp: ' . curl_error($ch));
        }
        curl_close($ch);
    }

    public function check_username($username) {
        return $this->db->where('username', $username)->get('users')->num_rows();
    }

    public function check_email($email) {
        return $this->db->where('email', $email)->get('users')->num_rows();
    }

    public function get_user_by_id($user_id) {
        return $this->db->where('id', $user_id)
                        ->get('users')
                        ->row();
    }
}
