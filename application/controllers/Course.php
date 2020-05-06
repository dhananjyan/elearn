<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends Staffs_controller {

  public function __construct() {
    parent::__construct();
	$this->load->model('Course_model', 'Course');
  }


	public function addCourse() {
		if($this->input->post()) {
			$user = $this->security->xss_clean($this->input->post());
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

	public function deleteCourse() {
		if($this->input->post()) {
			$data['result'] = $this->Course->deleteCourse($this->security->xss_clean($this->input->post('id')));
			if(! $data['result']) {
				$data['result'] = "Error in deleting user";
			} 
			$data['token'] = $this->security->get_csrf_hash();
			echo json_encode($data);
		}
	}

	public function getCourses() {
		$result = $this->Course->getCourses();
		$data['courses'] = $result;
		$data['token'] =$this->security->get_csrf_hash();
		echo json_encode($data);
	}
}
