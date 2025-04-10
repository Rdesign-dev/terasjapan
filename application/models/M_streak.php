<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_streak extends CI_Model {
    
    public function getDailyRewards($user_id) {
        $rewards = $this->db->get('daily_login_rewards')->result_array();
        $status = $this->getUserStreak($user_id);
        
        $days_data = array();
        foreach($rewards as $reward) {
            $status_text = '';
            if($reward['day_number'] < $status['current_streak']) {
                $status_text = 'checked';
            } else if($reward['day_number'] == $status['current_streak']) {
                $status_text = $status['is_claimed_today'] ? 'checked' : 'active';
            }
            
            $days_data[] = array(
                'day' => $reward['day_number'],
                'points' => $reward['points'],
                'status' => $status_text
            );
        }
        
        return $days_data;
    }
    
    public function getUserStreak($user_id) {
        $status = $this->db->where('user_id', $user_id)
                          ->get('login_status')
                          ->row_array();
        return $status ? $status : array('current_streak' => 0, 'is_claimed_today' => 0);
    }
    
    public function getTotalBonus() {
        return $this->db->select_sum('points')
                       ->get('daily_login_rewards')
                       ->row()
                       ->points;
    }
    
    public function claimReward($user_id) {
        $status = $this->getUserStreak($user_id);
        
        if($status['is_claimed_today']) {
            return array('success' => false, 'message' => 'Already claimed today');
        }
        
        $reward = $this->db->where('day_number', $status['current_streak'])
                          ->get('daily_login_rewards')
                          ->row();
        
        if(!$reward) {
            return array('success' => false, 'message' => 'No reward available');
        }
        
        $this->db->trans_start();
        
        // Update login_status
        $this->db->where('user_id', $user_id)
                 ->update('login_status', array('is_claimed_today' => 1));
        
        // Update user points
        $this->db->set('poin', 'poin + ' . $reward->points, false)
                 ->where('id', $user_id)
                 ->update('users');
        
        $this->db->trans_complete();
        
        if($this->db->trans_status() === false) {
            return array('success' => false, 'message' => 'Failed to claim reward');
        }
        
        return array(
            'success' => true, 
            'points' => $reward->points,
            'message' => 'Successfully claimed reward'
        );
    }
}