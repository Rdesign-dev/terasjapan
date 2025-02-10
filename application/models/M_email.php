<?php
class M_email extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Simpan email sementara dan OTP
    public function save_email_otp($user_id, $new_email, $otp) {
        $data = [
            'new_mail' => $new_email,
            'otp_email' => $otp,
            'otp_created_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }

    // Verifikasi OTP dan update email utama
    public function verify_email_otp($user_id, $otp) {
        $this->db->where('id', $user_id);
        $this->db->where('otp_email', $otp);
        // $this->db->where('TIMESTAMPDIFF(MINUTE, otp_created_at, NOW()) <=', 5);
        $user = $this->db->get('users')->row();
        
        if ($user) {
            $update_data = [
                'email' => $user->new_mail,
                'new_mail' => NULL,
                'otp_email' => NULL,
                'otp_created_at' => NULL
            ];
            
            $this->db->where('id', $user_id);
            return $this->db->update('users', $update_data);
        }
        return false;
    }
}
