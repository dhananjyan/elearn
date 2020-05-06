<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends Student_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Student_model', 'Student');
  }

	public function login() {
		$data['main_content'] = 'login';
		$data['title'] = 'Home';
		if ($this->input->post()) {
			$user = $this->security->xss_clean($this->input->post());
			if ($user['username'] != '' && $user['username'] != null ){
				if ($user['password'] != '' && $user['password'] != null ) {
					$result = $this->Student->authenticateStudent($user);
					if($result) {
						$this->setSession($result);
					} else {
						$data['error'] = 'Username or Password is incorrect';
						$data['username'] = $user['username'];
					}
				} else {
					$data['error'] = 'Password field is required';
					$data['username'] = $user['username'];
				}
			} else {
				$data['error'] = 'Username field is required';
				$data['username'] = $user['username'];
			}
		} else {
			$data['error'] = '';
			$data['username'] = '';
		}
		$this->load->view('student', $data);
	}

	public function register() {
		$data['main_content'] = 'Register';
		$data['error'] = '';
		$data['title'] = 'Home';
		$data['js'] = 'register';
		$this->load->model('Category_model');
		$data['categories'] = $this->Category_model->getAllCategories();
		if($this->input->post()) {
			$result = $this->Student->register($this->security->xss_clean($this->input->post()));
			if($result== 'exist'){
				$data['error'] = 'Already Registered';
			}else if($result == true){
				redirect('students/login');
			} else {
				$data['error'] = 'Error in Register the user';
			}
		}
		$this->load->view('student', $data);
	}

	private function setSession($data) {
		$userdata = array(
			'name' => $data->name,
			'rollNo' => $data->rollNo,
			'loggedIn' => true,
			'category' => $data->categoryId
		);
		$this->session->set_userdata($userdata);
		redirect('students/home');
	}

	public function home() {
		$data['main_content'] = 'home';
		$data['title'] = 'Home';
		$data['js'] = 'home';
		$this->load->view('student', $data);
	}

	public function joinClass() {
		if($this->input->post()) {
			$code = $this->security->xss_clean($this->input->post('code'));
			$result = $this->Student->joinCourse($code);
			if($result  == 'success') {
				$error = "Course Joined successfully";
			} else if ($result == 'exist') {
				$error = "Course joined already";
			} else if($result == 'notvalid'){
				$error = "Enter valid code";
			} else {
				$error = "Error in Joining course";
			}
			$data['error'] = $error;
			$data['token'] = $this->security->get_csrf_hash();
			echo json_encode($data);

		}
	}

	public function getCourse() {
		$result = $this->Student->getCourse();
		$data['courses'] = $result;
		$data['token'] =$this->security->get_csrf_hash();
		echo json_encode($data);
	}

}
