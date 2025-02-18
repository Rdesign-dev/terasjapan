<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user_mission extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('M_mission');
    }

    public function get_profile_completion_mission($user_id) {
        // Get the profile completion mission (ID 1)
        $mission = $this->db->get_where('missions', ['id' => 1])->row();
        
        // Get user's mission status
        $user_mission = $this->db->get_where('user_missions', [
            'user_id' => $user_id,
            'mission_id' => 1
        ])->row();

        if ($mission) {
            $mission->status = $user_mission ? $user_mission->status : 'Pending';
            $mission->completed_at = $user_mission ? $user_mission->completed_at : null;
        }

        return $mission;
    }

    public function check_profile_completion($user_id) {
        // Get user profile data
        $this->db->select('birthdate, gender, address, city');
        $this->db->where('id', $user_id);
        $user = $this->db->get('users')->row();
        
        // Check if all required fields are filled
        $is_complete = !empty($user->birthdate) && 
                      !empty($user->gender) && 
                      !empty($user->address) && 
                      !empty($user->city);

        // Get the profile completion mission
        $profile_mission = $this->db->get_where('user_missions', [
            'user_id' => $user_id,
            'mission_id' => 1  // Assuming profile completion mission ID is 1
        ])->row();

        if ($is_complete && $profile_mission && $profile_mission->status !== 'Completed') {
            // Update mission status
            $this->db->where([
                'user_id' => $user_id,
                'mission_id' => 1
            ])->update('user_missions', [
                'status' => 'Completed',
                'completed_at' => date('Y-m-d H:i:s')
            ]);

            // Add poin to user (changed from points to poin)
            $mission = $this->db->get_where('missions', ['id' => 1])->row();
            if ($mission) {
                $this->db->set('poin', 'poin + ' . $mission->point_reward, false)
                         ->where('id', $user_id)
                         ->update('users');
            }
        } elseif (!$is_complete && $profile_mission && $profile_mission->status === 'Completed') {
            // If profile becomes incomplete again, revert to pending
            $this->db->where([
                'user_id' => $user_id,
                'mission_id' => 1
            ])->update('user_missions', [
                'status' => 'Pending',
                'completed_at' => null
            ]);
        }

        return $is_complete;
    }

    public function complete_mission($user_id, $mission_id) {
        // Check if mission exists
        $mission = $this->db->get_where('missions', ['id' => $mission_id])->row();
        if (!$mission) return false;

        // Check if already exists
        $existing = $this->db->get_where('user_missions', [
            'user_id' => $user_id,
            'mission_id' => $mission_id
        ])->row();

        if ($existing) {
            // Update existing record
            $this->db->where([
                'user_id' => $user_id,
                'mission_id' => $mission_id
            ])->update('user_missions', [
                'status' => 'Completed',
                'completed_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            // Create new record
            $this->db->insert('user_missions', [
                'user_id' => $user_id,
                'mission_id' => $mission_id,
                'status' => 'Completed',
                'completed_at' => date('Y-m-d H:i:s')
            ]);
        }

        // Add poin to user (changed from points to poin)
        $this->db->set('poin', 'poin + ' . $mission->point_reward, false)
                 ->where('id', $user_id)
                 ->update('users');

        return true;
    }

    public function initialize_user_missions($user_id) {
        // Get all available missions
        $missions = $this->db->get('missions')->result();
        
        // Initialize each mission for the user
        foreach ($missions as $mission) {
            $this->db->insert('user_missions', [
                'user_id' => $user_id,
                'mission_id' => $mission->id,
                'status' => 'Pending',
                'completed_at' => null
            ]);
        }
    }

    public function sync_user_missions($user_id) {
        // Get all missions
        $all_missions = $this->db->get('missions')->result();
        
        // Get user's existing missions
        $user_missions = $this->db->where('user_id', $user_id)
                                ->get('user_missions')
                                ->result();
        
        $existing_mission_ids = array_map(function($um) {
            return $um->mission_id;
        }, $user_missions);
        
        // Add missing missions
        foreach ($all_missions as $mission) {
            if (!in_array($mission->id, $existing_mission_ids)) {
                $this->db->insert('user_missions', [
                    'user_id' => $user_id,
                    'mission_id' => $mission->id,
                    'status' => 'Pending',
                    'completed_at' => null
                ]);
            }
        }
    }

    public function get_user_missions($user_id) {
        // Sync missions first
        $this->sync_user_missions($user_id);
        
        // Get all missions with user status
        $this->db->select('m.*, COALESCE(um.status, "Pending") as status, um.completed_at');
        $this->db->from('missions m');
        $this->db->join('user_missions um', 'um.mission_id = m.id AND um.user_id = ' . $user_id, 'left');
        $query = $this->db->get();
        
        return [
            'missions' => $query->result(),
            'missions_available' => $query->num_rows() > 0
        ];
    }
}