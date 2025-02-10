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
            redirect('auth/login'); // Redirect ke halaman login jika user tidak login
        }

        $data = [
            'name' => $this->input->post('name'),
            'birthdate' => $this->input->post('birthdate'),
            'gender' => $this->input->post('gender'),
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city')
        ];

        // Handle file upload
        if ($_FILES['profile_picture']['name']) {
            $config['upload_path'] = './assets/image/Profpic/';
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
                if ($old_picture && $old_picture != 'profile.jpg' && file_exists('./assets/image/Profpic/' . $old_picture)) {
                    unlink('./assets/image/Profpic/' . $old_picture);
                }
                
                // Update profile picture in database
                $data['profile_pic'] = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('profile/setting/editprofile');
                return;
            }
        }

        if($this->User_model->update_user($user_id, $data)) {
            $this->session->set_flashdata('successEdit', 'Profile updated successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to update profile');
        }
        
        redirect('profile'); // Redirects to profile page
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
        if ($old_picture && $old_picture != 'profile.jpg' && file_exists('./assets/image/Profpic/' . $old_picture)) {
            unlink('./assets/image/Profpic/' . $old_picture);
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