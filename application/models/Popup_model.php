<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Popup_model extends CI_Model {
    
    protected $table = 'popup';
    
    public function get_active_popup() {
        $this->db->where('status', 'Active');
        $this->db->limit(1); // Hanya ambil 1 popup aktif
        return $this->db->get($this->table)->row();
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