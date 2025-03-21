<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(['auth', 'url']);
        $this->load->model('User_model');
        $this->load->model('Reward_model');
        $this->load->model('Feedback_model');
        $this->load->model('M_faq');
        // Load middleware
        require_once APPPATH . 'middleware/AuthMiddleware.php';
        $this->auth_middleware = new AuthMiddleware();
        require_once APPPATH . 'middleware/VoucherOwnerMiddleware.php';
        $this->voucher_middleware = new VoucherOwnerMiddleware();
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
        // Get voucher code from URL query parameter
        $kode_voucher = $this->input->get('voucher_id');
        
        // Verify voucher ownership
        $this->voucher_middleware->verify_ownership();

        if (!$kode_voucher) {
            show_404();
            return;
        }

        $user_id = $this->session->userdata('user_id');
        
        // Debug the input parameters
        log_message('debug', 'Fetching voucher with code: ' . $kode_voucher . ' for user: ' . $user_id);
        
        // Ambil data voucher berdasarkan kode voucher dan user_id
        $voucher = $this->Reward_model->get_voucher_by_code_and_user($kode_voucher, $user_id);
        
        // Debug the voucher object
        log_message('debug', 'Voucher object in controller: ' . print_r($voucher, true));

        if (!$voucher) {
            show_404();
            return;
        }

        $data = array(
            'voucher' => $voucher
        );

        // Debug the data being passed to view
        log_message('debug', 'Data passed to view: ' . print_r($data, true));

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
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $this->load->model('M_user_mission');
        $user_id = $this->session->userdata('user_id');
        
        // Check profile completion status first
        $this->M_user_mission->check_profile_completion($user_id);
        
        // Get all missions with user status
        $mission_data = $this->M_user_mission->get_user_missions($user_id);
        
        $data = [
            'missions' => $mission_data['missions'],
            'missions_available' => $mission_data['missions_available']
        ];

        $this->load->view('profile/mission', $data);
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
        // Check if user is logged in
        $this->auth_middleware->check_login();

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

        $data['faqs'] = $this->M_faq->get_active_faqs();
        
        $this->load->view('profile/faq', $data);
    }

    public function feedback() {
        $this->load->view('profile/feedback');
    }

    public function myvoucher() {
        // Check if user is logged in
        $this->auth_middleware->check_login();

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
            // Soft delete user account
            if ($this->User_model->delete_user($user_id)) {
                $this->session->sess_destroy();
                redirect('login');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete account');
                redirect('profile/setting/delete-account');
            }
        }
    }

    public function update() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $user_id = $this->session->userdata('user_id');
        
        // Validate input
        $this->form_validation->set_rules('birthdate', 'Birth Date', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Handle validation errors
            $this->session->set_flashdata('error', validation_errors());
            redirect('profile/edit');
        }

        // Update user data
        $data = [
            'birthdate' => $this->input->post('birthdate'),
            'gender' => $this->input->post('gender'),
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city')
        ];

        if ($this->M_user->update_profile($user_id, $data)) {
            // Check mission completion
            $this->load->model('M_user_mission');
            $this->M_user_mission->check_profile_completion($user_id);
            
            $this->session->set_flashdata('success', 'Profile updated successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to update profile');
        }

        redirect('profile');
    }
}
