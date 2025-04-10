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

    public function simpan_otp($phone_number, $otp) {
        date_default_timezone_set('Asia/Jakarta');
        $data = array(
                    'otp' => $otp,
                    'waktu' => date('Y-m-d H:i:s') // Simpan waktu saat ini dalam format yang valid
                );
                // Simpan atau update OTP di database
                $this->db->where('phone_number', $phone_number);
                $this->db->update('users', $data);
        
                // Kirim OTP ke WhatsApp menggunakan API Fontee
                $this->kirim_otp_ke_whatsapp($phone_number, $otp);
    }

    // Fungsi untuk memeriksa OTP
    public function cek_otp($phone_number) {
        $this->db->where('phone_number', $phone_number);
        $query = $this->db->get('users');
        $otp_data = $query->row_array();

        return $otp_data;
    }

    // public function reset_otp($phone_number) {
    //     $this->db->where('phone_number', $phone_number);
    //     $this->db->update('users', ['otp' => NULL, 'waktu' => NULL]);
    // }

    // Fungsi untuk mengambil data pengguna berdasarkan nomor telepon
    public function get_user_by_phone($phone_number) {
        return $this->db->where('phone_number', $phone_number)
                        ->where('deleted', 0)
                        ->get('users')
                        ->row();
    }

    // Fungsi untuk memasukkan data pengguna baru
    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    // Fungsi untuk mengirim OTP ke WhatsApp menggunakan API Fontee
    private function kirim_otp_ke_whatsapp($phone_number, $otp) {
        $token = $this->config->item('fonnte_token');
        $message = "$otp sebagai kode verifikasi untuk login ke aplikasi kami. Jangan berikan kode ini kepada siapapun.";

        $data = [
            'target' => $phone_number,
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

    public function record_login($user_id, $name) {
        // Insert into login_users table
        $data = array(
            'id' => $user_id,
            'name' => $name
        );
        $this->db->insert('login_users', $data);

        // Get current date
        $today = date('Y-m-d');
        
        // Get maximum day number from daily_login_rewards
        $max_day = $this->db->select_max('day_number')
                            ->get('daily_login_rewards')
                            ->row()
                            ->day_number;
        
        // Check if user exists in login_status
        $existing_status = $this->db->where('user_id', $user_id)
                                   ->get('login_status')
                                   ->row();
        
        if ($existing_status) {
            // User exists, check if last_login_date is NULL
            if ($existing_status->last_login_date === NULL) {
                // If last_login_date is NULL, treat as first login
                $data = array(
                    'last_login_date' => $today,
                    'current_streak' => 1
                );
            } else {
                // Normal flow for existing last_login_date
                $last_login = new DateTime($existing_status->last_login_date);
                $today_date = new DateTime($today);
                $interval = $last_login->diff($today_date);
                $days_difference = $interval->days;

                if ($days_difference == 0) {
                    // Already logged in today, no streak update needed
                    return true;
                } else if ($days_difference == 1) {
                    // Logged in yesterday, increase streak (but not beyond max_day)
                    $new_streak = min($existing_status->current_streak + 1, $max_day);
                    $data = array(
                        'last_login_date' => $today,
                        'current_streak' => $new_streak
                    );
                } else {
                    // Missed a day or more, reset streak
                    $data = array(
                        'last_login_date' => $today,
                        'current_streak' => 1
                    );
                }
            }
            
            return $this->db->where('user_id', $user_id)
                           ->update('login_status', $data);
        } else {
            // First time login, create new record
            $data = array(
                'user_id' => $user_id,
                'last_login_date' => $today,
                'current_streak' => 1
            );
            
            return $this->db->insert('login_status', $data);
        }
    }

    public function check_deleted_account($phone_number) {
        return $this->db->where('phone_number', $phone_number)
                        ->where('deleted', 1)
                        ->get('users')
                        ->row();
    }
}
