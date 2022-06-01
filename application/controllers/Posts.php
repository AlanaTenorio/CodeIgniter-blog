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
		$data['post'] = $this->Post->get($id);
		$this->load->view('posts_show', $data);
	}

	public function edit($id) {
		$data['post'] = $this->Post->get($id);
		$this->load->helper('form');
		$this->load->view('posts_edit', $data);
	}

	public function update() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'Title', 'required');
    	$this->form_validation->set_rules('content', 'Content', 'required');

		if ($this->form_validation->run() === TRUE && $this->Post->update()) {
			$this->session->set_flashdata('message', 'Updated with success!');
			redirect('posts/show/'.$this->input->post('post_id'));
		} else {
			$this->edit();
		}
	}

	public function remove($id) {
		$data['post'] = $this->Post->get($id);
		$this->load->helper('form');
		$this->load->view('posts_remove', $data);
	}

	public function delete() {
		if ($this->Post->delete()) {
			$this->session->set_flashdata('message', 'Removed with success!');
			redirect('posts');
		} else {
			$this->remove($this->input->post('post_id'));
		}
	}
}
