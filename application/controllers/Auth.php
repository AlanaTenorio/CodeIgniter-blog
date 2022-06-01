<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('User_model', 'User');
	}

	public function register() {
		$this->load->helper('form');

		$this->load->view('auth_register');
	}

	public function store() {
		$this->load->library('form_validation');

		if ($this->User->store()) {
			redirect('dashboard');
		} else {
			$this->register();
		}
	}

	public function login() {
		$this->load->helper('form');

		$this->load->view('auth_login');
	}

	public function store_session() {
		$this->load->library('form_validation');

		$user = $this->User->get($this->input->post('email'));

		if ($user['password'] == $this->input->post('password')) {
			$this->session->set_userdata(['user' => $user]);
			redirect('dashboard');
		} else {
			$this->login();
		}
	}

	public function destroy_session() {
		$this->session->unset_userdata('user');
		redirect('dashboard');
	}
}
