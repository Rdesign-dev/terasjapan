<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session'); // Memastikan session sudah dimuat
        $this->load->model('User_model'); // Memuat model User_model
        $this->load->helper('url');
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('auth/login');
        }
        
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        $this->load->view('profile/setting', $data);
    }

    // Metode untuk menampilkan halaman edit profile
    public function editProfile() {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('auth/login'); // Redirect ke halaman login jika user tidak login
        }

        // Ambil data user dari database
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        $this->load->view('profile/setting/editprofile', $data); // Updated path
    }

    // Metode untuk mengupdate profile
    public function updateProfile() {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('auth/login');
        }

        // Basic profile data
        $data = [
            'name' => $this->input->post('name'),
            'birthdate' => $this->input->post('birthdate'),
            'gender' => $this->input->post('gender'),
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city')
        ];

        // Handle profile picture upload
        if (!empty($_FILES['profile_picture']['name'])) {
            $upload_path = FCPATH . '../ImageTerasJapan/ProfPic/';
            
            // Create directory if it doesn't exist
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 5000; // 5MB
            
            // Get user data for filename
            $user = $this->User_model->get_user_by_id($user_id);
            $new_name = $user->name . '_' . $user_id . '_' . time();
            $config['file_name'] = $new_name;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('profile_picture')) {
                $upload_data = $this->upload->data();
                
                // Delete old picture if exists
                $old_picture = $this->User_model->get_old_picture($user_id);
                if ($old_picture && $old_picture != 'profile.jpg') {
                    $old_file = $upload_path . $old_picture;
                    if (file_exists($old_file)) {
                        unlink($old_file);
                    }
                }
                
                $data['profile_pic'] = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('profile/setting/editprofile');
                return;
            }
        }

        if ($this->User_model->update_user($user_id, $data)) {
            $this->session->set_flashdata('successEdit', 'Profile updated successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to update profile');
        }
        
        redirect('profile');
    }

    // Metode untuk mengubah email (opsional)
    public function changeEmail() {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('auth/login');
        }

        $data['user'] = $this->User_model->get_user_by_id($user_id);
        $this->load->view('profile/setting/changeemail', $data);
    }

    // Metode untuk menghapus akun (opsional)
    public function deleteAccount() {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('auth/login');
        }

        if ($this->input->post('confirm_delete')) {
            if ($this->User_model->delete_user($user_id)) {
                $this->session->sess_destroy();
                redirect('login');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete account');
                redirect('profile/setting/delete-account');
            }
        }

        $data['user'] = $this->User_model->get_user_by_id($user_id);
        $this->load->view('profile/setting/deleteacc', $data);
    }

    // Metode untuk menghapus foto profil
    public function deleteProfilePicture() {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('auth/login');
        }

        // Get current profile picture
        $old_picture = $this->User_model->get_old_picture($user_id);
        
        // Delete physical file if exists and not default
        if ($old_picture && $old_picture != 'profile.jpg') {
            $file_path = FCPATH . '../ImageTerasJapan/ProfPic/' . $old_picture;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        
        // Reset to default in database
        $data['profile_pic'] = 'profile.jpg';
        if ($this->User_model->update_user($user_id, $data)) {
            $this->session->set_flashdata('success', 'Profile picture removed');
        } else {
            $this->session->set_flashdata('error', 'Failed to remove profile picture');
        }
        
        redirect('profile/setting/editprofile');
    }
}