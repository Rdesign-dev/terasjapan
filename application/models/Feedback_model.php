<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function save_feedback($data) {
        return $this->db->insert('feedback', $data);
    }
}