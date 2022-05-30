<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Post_model', 'Post');
	}

	public function index() {
		$data['posts'] = $this->Post->index();
		$this->load->view('posts', $data);
	}

	public function create() {
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'Title', 'required');
    	$this->form_validation->set_rules('content', 'Content', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->load->view('posts_create');
		} else {
			if($this->Post->store()) {
				$view_data = array(
					'message' => 'Success'
				);
				redirect('posts', $view_data);
			} else {
				echo "Not saved";
			}
		}
	}

	public function get($id) {
		$data['post'] = $this->Post->get($id)[0];
		$this->load->view('posts_get', $data);
	}
}
