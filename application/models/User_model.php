<?php
class User_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function store() {
        $user = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );

        return $this->db->insert('users', $user);
    }

    public function get($email) {
        $this->db->where('email', $email);
        return $this->db->get('users')->row_array();
    }
}