<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('check_and_update_user_level')) {
    function check_and_update_user_level($ci, $user_id) {
        $ci->load->model('M_level');
        
        // Get user's deleted status
        $user_status = $ci->M_level->get_user_deleted_status($user_id);
        
        // Log user status for debugging
        log_message('debug', "User ID: {$user_id} - Deleted status: " . ($user_status->deleted ?? 'N/A') . 
                            " - Time deleted: " . ($user_status->time_deleted ?? 'N/A'));
        
        // Get user's total spending (function now handles soft delete logic)
        $total_spending = $ci->M_level->get_user_total_spending($user_id);
        
        // Log total spending for debugging
        log_message('debug', "User ID: {$user_id} - Total spending calculated: {$total_spending}");
        
        // Get all levels ordered by min_spending
        $levels = $ci->M_level->get_all_levels();
        
        // Find appropriate level based on spending
        $appropriate_level = null;
        foreach ($levels as $level) {
            if ($total_spending >= $level->min_spending) {
                $appropriate_level = $level;
            } else {
                break;
            }
        }
        
        if ($appropriate_level) {
            // Log level update for debugging
            log_message('debug', "User ID: {$user_id} - Updating to level: {$appropriate_level->id} ({$appropriate_level->level_name})");
            
            // Update user's level if needed
            $ci->M_level->update_user_level($user_id, $appropriate_level->id);
            return $appropriate_level;
        }
        
        return false;
    }
}