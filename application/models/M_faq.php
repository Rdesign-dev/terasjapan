<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_faq extends CI_Model {
    
    private $table = 'faq';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Get all active FAQs
     * 
     * @return array Array of active FAQ items
     */
    public function get_active_faqs() {
        $this->db->where('status', 'Active');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    /**
     * Get all FAQs regardless of status
     * 
     * @return array Array of all FAQ items
     */
    public function get_all_faqs() {
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    /**
     * Get a specific FAQ by ID
     * 
     * @param int $id FAQ ID
     * @return object FAQ item
     */
    public function get_faq_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row();
    }
    
    /**
     * Add a new FAQ
     * 
     * @param array $data FAQ data
     * @return bool Success status
     */
    public function add_faq($data) {
        return $this->db->insert($this->table, $data);
    }
    
    /**
     * Update an existing FAQ
     * 
     * @param int $id FAQ ID
     * @param array $data Updated FAQ data
     * @return bool Success status
     */
    public function update_faq($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    
    /**
     * Delete a FAQ
     * 
     * @param int $id FAQ ID
     * @return bool Success status
     */
    public function delete_faq($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}