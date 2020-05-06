<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staffs extends Staffs_controller {

	public function index() {
		$data['main_content'] = 'home';
		$data['title'] = 'Staff';
		$data['css'] = array();
		$data['js'] = array();
		$this->view($data);
	}

	public function courses() {
		$data['main_content'] = 'courses';
		$data['title'] = 'Staff';
		$data['css'] = array(
			// 'http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css'
		);
		$data['js'] = array(
			// '//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js',
			base_url().'public/javascripts/course.js',
			'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js'
		);
		$this->view($data);
	}

	public function addCourse() {
		if($this->input->post()) {
			$user = $this->security->xss_clean($this->input->post());
			$this->load->model('Course_model', 'Course');
			$result = $this->Course->addCourse($user);
			if($result  == 'success') {
				$error = "Course added successfully";
			} else if ($result == 'course') {
				$error = "Course name already exists";
			} else {
				$error = "Error in creating course";
			}
			$data['error'] = $error;
			$data['token'] = $this->security->get_csrf_hash();
			echo json_encode($data);

		}
	}
}