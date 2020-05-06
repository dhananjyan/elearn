<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin_controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Category_model', 'Categories');
  }

	public function getCategories() {
        $list = $this->Categories->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $category) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $category->name;
            $row[] = $category->createdAt;
            $row[] = "<a  id='edit' class='btn btn-info btn-circle btn-sm text-white' onclick='return editCategory($category->id)'><i class='fas fa-edit'></i></a> | <a class='btn btn-danger btn-circle btn-sm text-white'  onclick='return deleteCategory($category->id)'><i class='fas fa-trash'></i>";
            $data[] = $row;
        }
 
 
        $json_data = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Categories->count_all(),
                        "recordsFiltered" => $this->Categories->count_filtered(),
                        "data" => $data,
                );


        echo json_encode($json_data);
	}

	public function addCategory() {
		if($this->input->post()) {
			$category = $this->security->xss_clean($this->input->post());
			$result = $this->Categories->addCategory($category);
			if($result  == 'success') {
				$error = "Category added successfully";
			} else if ($result == 'category') {
				$error = "Category name already exist";
			} else {
				$error = "Error in creating category";
			}
			$data['error'] = $error;
			$data['token'] = $this->security->get_csrf_hash();
			echo json_encode($data);

		}
	}

	public function getCategory() {
		if ($this->input->post()) {
			$data = $this->Categories->getCategory($this->input->post('id'));
			$data['token'] = $this->security->get_csrf_hash();
			echo json_encode($data);
		}
	}

	public function deleteCategory() {
		if($this->input->post()) {
			$data['result'] = $this->Categories->deleteCategory($this->security->xss_clean($this->input->post()));
			if(! $data['result']) {
				$data['result'] = "Error in deleting user";
			} 
			$data['token'] = $this->security->get_csrf_hash();
			echo json_encode($data);
		}
	}

	public function updateCategory() {
		if($this->input->post()) {
			$category = $this->security->xss_clean($this->input->post());
			$result = $this->Categories->updateCategory($category);
			if($result  == 'success') {
				$error = "Category Updated successfully";
			} else {
				$error = "Error in Updating category";
			}
			$data['error'] = $error;
			$data['token'] = $this->security->get_csrf_hash();
			echo json_encode($data);
		}
	}


}
