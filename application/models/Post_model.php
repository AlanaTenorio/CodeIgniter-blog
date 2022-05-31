<?php
class Post_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function index() {
        $query = $this->db->get('posts');
        return $query->result_array();
    }

    public function store() {
        $post = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
        );
        return $this->db->insert('posts', $post);
    }

    public function get($id) {
        $this->db->where('id', $id);
        return $this->db->get('posts')->row_array();
    }
}