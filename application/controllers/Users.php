<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Users_model', 'Users');
  }

	public function adminLogin() {
		$data['title'] = 'Admin Login';
		$data['main_content'] = 'admin/login';
		if ($this->input->post()) {
			$user = $this->security->xss_clean($this->input->post());
			if ($user['username'] != '' && $user['username'] != null ){
				if ($user['password'] != '' && $user['password'] != null ) {
					$result = $this->Users->authenticateAdmin($user);
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
		$this->load->view('loginLayout', $data);
	}

	public function staffLogin() {
		$data['title'] = 'Staff Login';
		$data['main_content'] = 'staffs/login';
		if ($this->input->post()) {
			$user = $this->security->xss_clean($this->input->post());
			if ($user['username'] != '' && $user['username'] != null ){
				if ($user['password'] != '' && $user['password'] != null ) {
					$result = $this->Users->authenticateStaff($user);
					if($result) {
						$res = $this->Users->isRegisteredStaff($result->username);
						if($res) {
							$this->session->set_userdata('category', $res->categoryId);
							$this->setSession($res);
						} else {
							$this->session->set_userdata('username', $result->username);
							redirect('users/staffRegister');
						}
						
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
		$this->load->view('loginLayout', $data);
	}

	private function setSession($data) {
		$userdata = array(
			'username' => $data->username,
			'accessType' => $data->accessType,
			'loggedIn' => true
		);
		$this->session->set_userdata($userdata);
		if($userdata['accessType'] == 'staff')
			redirect('staffs');
		redirect('admin');
	}

	public function staffRegister() {
		if($this->session->has_userdata('username')) {
			if($this->input->post()) {
				$staff = $this->security->xss_clean($this->input->post());
				if($this->Users->staffRegister($staff)){
					$this->session->set_userdata('loggedIn', true);
					$this->session->set_userdata('accessType', 'staff');
					$this->session->set_userdata('category', $staff['categoryId']);
					redirect('staffs');
				} else {
					echo "error";
					exit();
				}
			}
			$this->load->model('Category_model');
			$data['categories'] = $this->Category_model->getAllCategories();
			$data['title'] = 'Staff Login';
			$data['main_content'] = 'staffs/register';
			$this->load->view('loginLayout', $data);
		}
	}

	public function getUsers() {
        $list = $this->Users->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $user->username;
            $row[] = $user->accessType;
            $row[] = $user->createdAt;
            $row[] = "<a class='btn btn-danger btn-circle btn-sm text-white'  onclick='return deleteUser($user->id)'><i class='fas fa-trash'></i>";
            $data[] = $row;
        }
 
 
        $json_data = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Users->count_all(),
                        "recordsFiltered" => $this->Users->count_filtered(),
                        "data" => $data,
                );


        echo json_encode($json_data);
	}

	public function addUser() {
		if($this->input->post()) {
			$user = $this->security->xss_clean($this->input->post());
			if($user['accessType'] == 'admin') {
				$result = $this->Users->addUser($user);
			} else if ($user['accessType'] == 'staff') {
				$result = $this->Users->addUser($user);
			}
			if($result  == 'success') {
				$error = "User added successfully";
			} else if ($result == 'username') {
				$error = "Username already taken";
			} else {
				$error = "Error in creating user";
			}
			$data['error'] = $error;
			$data['token'] = $this->security->get_csrf_hash();
			echo json_encode($data);

		}
	}

	public function getUser() {
		if ($this->input->post()) {
			$data = $this->Users->getUser($this->input->post('id'));
			echo json_encode($data);
		}
	}

	public function deleteUser() {
		if($this->input->post()) {
			$data['result'] = $this->Users->deleteUser($this->security->xss_clean($this->input->post()));
			if(! $data['result']) {
				$data['result'] = "Error in deleting user";
			} 
			$data['token'] = $this->security->get_csrf_hash();
			echo json_encode($data);
		}
	}

	public function logout() {
		if($this->session->userdata('accessType') == 'admin') {
			$this->session->sess_destroy();
			redirect('users/adminLogin');
		} else {
			$this->session->sess_destroy();
			redirect('users/staffLogin');
		}
	}

}
