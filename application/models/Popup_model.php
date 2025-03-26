<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Popup_model extends CI_Model {
    
    protected $table = 'popup';
    
    public function get_active_popup() {
        // Get all active popups
        $this->db->where('status', 'Active');
        $active_popups = $this->db->get($this->table)->result();
        
        // If no active popups, return null
        if (empty($active_popups)) {
            return null;
        }
        
        // If only one popup, return it
        if (count($active_popups) === 1) {
            return $active_popups[0];
        }
        
        // If multiple popups, return a random one
        $random_index = array_rand($active_popups);
        return $active_popups[$random_index];
    }

    public function insert_popup($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update_popup($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete_popup($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function get_popup_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->table)->row();
    }

    public function get_all_popups() {
        return $this->db->get($this->table)->result();
    }
}