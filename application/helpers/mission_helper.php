<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('check_user_missions')) {
    function check_user_missions($CI, $user_id) {
        if (!$user_id) return null;
        
        $CI->load->model('M_user_mission');
        
        // Check profile completion status first
        $CI->M_user_mission->check_profile_completion($user_id);
        
        // Get all missions with user status
        return $CI->M_user_mission->get_user_missions($user_id);
    }
}