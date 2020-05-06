<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends Staffs_controller {



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
