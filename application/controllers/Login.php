<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Users_model', 'Users');
  }

	public function adminLogin() {
		$data['title'] = 'Admin Login';
		if ($this->input->post()) {
			
		} else {
			$data['error'] = '';
			$data['username'] = '';
		}
		$this->load->view('layout', $data);
	}

}
