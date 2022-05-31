<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Post_model', 'Post');
	}

	public function index() {
		$data['posts'] = $this->Post->index();
		$this->load->view('posts', $data);
	}

	public function create() {
		$this->load->helper('form');

		$this->load->view('posts_create');
	}

	public function store() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'Title', 'required');
    	$this->form_validation->set_rules('content', 'Content', 'required');

		if ($this->form_validation->run() === TRUE && $this->Post->store()) {
			$this->session->set_flashdata('message', 'Stored with success!');
			redirect('posts');
		} else {
			$this->create();
		}
	}

	public function show($id) {
		$data['post'] = $this->Post->get($id)[0];
		$this->load->view('posts_show', $data);
	}
}
