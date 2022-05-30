<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->model('Post_model', 'Post');
		$data['posts'] = $this->Post->index();
		$this->load->view('home', $data);
	}
}
