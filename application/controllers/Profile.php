<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(['auth', 'url']);
        $this->load->model('User_model');
        $this->load->model('Reward_model');
        $this->load->model('Feedback_model'); // Tambahkan ini
    }

    public function index() {
        // Ambil data pengguna dari session
        $user_id = $this->session->userdata('user_id');
        
        // Ambil data pengguna dari database jika user_id ada
        $user = null;
        $referral_code = null;
        if ($user_id) {
            $user = $this->User_model->get_user_by_id($user_id);
            $referral_code = $this->User_model->get_referral_code($user_id);
        }

        // Kirim data pengguna ke view
        $data = array(
            'user' => $user,
            'referral_code' => $referral_code
        );

        $this->load->view('profile/index', $data);
    }

    public function redeem() {
        $voucher_id = $this->input->get('voucher_id');
        // Ambil data voucher berdasarkan kode voucher
        $voucher = $this->Reward_model->get_voucher_by_code($voucher_id);

        if (!$voucher) {
            show_404();
        }

        $data = array(
            'voucher' => $voucher
        );

        $this->load->view('profile/redeem', $data);
    }
    
    public function logout() {
        // Check if user is logged in
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            $this->session->set_flashdata('error', 'Access denied, please login');
            return;
        } else {
            // Hapus session dan redirect ke login
            $this->session->sess_destroy();
            redirect('home/index');
        }
    }
    
    public function contactus() {
        // Menampilkan halaman Contact Us
        $this->load->view('profile/contactus');
    }

    public function mission() {
        $this->load->view('profile/mission');
    }

    public function history() {
        $this->load->view('profile/history');
    }

    public function terms_conditions() {
        $this->load->view('profile/terms&conditions');
    }

    public function about() {
        $this->load->view('profile/about');
    }

    public function Benefit() {
        $levels = $this->User_model->get_all_levels();
        $benefits = [];

        foreach ($levels as $level) {
            $benefits[$level->id] = $this->User_model->get_benefits_by_level($level->id);
        }

        $data = [
            'levels' => $levels,
            'benefits' => $benefits
        ];

        $this->load->view('profile/Benefit', $data);
    }

    public function setting() {
        $this->load->view('profile/setting');
    }

    public function referral() {
        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->get_user_by_id($user_id);

        if ($user) {
            $data['referral_code'] = $user->referral_code;
            $data['referral_redeem_data'] = $this->User_model->get_referral_redeem_data_by_code($user->referral_code);
        } else {
            $data['referral_code'] = 'No referral code available';
            $data['referral_redeem_data'] = [];
        }

        $this->load->view('profile/referral', $data);
    }

    public function faq() {
        $this->load->view('profile/faq');
    }

    public function feedback() {
        $this->load->view('profile/feedback');
    }

    public function myvoucher() {
         // Ambil data pengguna dari session
         $user_id = $this->session->userdata('user_id');

         // Perbarui status voucher yang sudah expired
        $data = $this->Reward_model->update_expired_vouchers();
        
         // Ambil data voucher dari database jika user_id ada
         $vouchers = null;
         if ($user_id) {
             $vouchers = $this->Reward_model->get_vouchers_by_user_id($user_id);
         }
 
         // Debugging
         log_message('debug', 'User ID: ' . $user_id);
         log_message('debug', 'Vouchers: ' . print_r($vouchers, true));
 
         // Kirim data voucher ke view
         $data = array(
             'vouchers' => $vouchers
         );

        $this->load->view('profile/myvoucher', $data);
    }

    public function privacypolicy() {
        $this->load->view('profile/privacypolicy');
    }

    public function submit_feedback() {
        $feedback_text = $this->input->post('feedback_text');
        $category = $this->input->post('category');
        $rating = $this->input->post('rating');
        $user_id = $this->session->userdata('user_id');
        $ip_address = $_SERVER['REMOTE_ADDR'];

        // Simpan feedback ke database
        $data = [
            'user_id' => $user_id ? $user_id : null,
            'ip_address' => $user_id ? null : $ip_address,
            'feedback_text' => $feedback_text,
            'category' => $category,
            'rating' => $rating,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->Feedback_model->save_feedback($data);

        // Redirect kembali ke halaman profil dengan pesan sukses
        $this->session->set_flashdata('success', 'Thank you for your feedback!');
        redirect('profile');
    }

    

    public function deleteAccount() {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('auth/login');
        }
        if ($this->input->post('confirm_delete')) {
            // Hapus data terkait di tabel redeem_voucher
            $this->User_model->delete_user_related_data($user_id);

            // Hapus data pengguna
            if ($this->User_model->delete_user($user_id)) {
                $this->session->sess_destroy();
                redirect('login');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete account');
                redirect('profile/setting/delete-account');
            }
        }
    }
}
