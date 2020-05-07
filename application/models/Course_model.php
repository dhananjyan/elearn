<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->table = 'course';
    $this->column_order = array(null, 'name', 'description');
    $this->column_search = array('name');
    $this->order = array('id' => 'DESC');
  }

  public function getCourses() {
    // $this->db->select('course.name, course.id, course.description,coursetoStaff.id, staffs.name');
    // $this->db->where('course.categoryId', $this->session->userdata('category'));
    // $this->db->where('staffs.categoryId', $this->session->userdata('category'));
    // $this->db->where('coursetostaff.courseId', 'course.id');
    // $this->db->where('coursetostaff.staffId', 'staffs.id');
    // $this->db->where('course.status', '1')->from($this->table)->join('coursetostaff', 'coursetostaff.courseId = course.id');
    // $this->db->join('staffs','staffs.id = coursetostaff.staffId');
    // var_dump($this->db->get()->result());
    // echo $this->db->last_query();
    // exit();

    $this->db->select('name, id, description');
    $this->db->where('status', '1');
    $this->db->where('categoryId', $this->session->userdata('category'));
    $this->db->where('staff', $this->session->userdata('username'));
    $this->db->from($this->table);
    return $this->db->get()->result();
  }

  public function getSharedPost($id) {
    $data = $this->db->select('id,title,share,createdAt')->where('courseId', $id)->from('share')->order_by('createdAt', 'desc')->get()->result();
    return $data;
  }

  public function postShare($post) {
      if($this->db->insert ('share', $post))
        return  "Posted";
    return false;
  }

  public function deleteCourse($id){
    $this->db->set('status', '0');
    $this->db->where('id', $id);
    if($this->db->update($this->table))
      return "Successfully deleted";
    return false;

  }

  public function getComments($id){
    return $this->db->select('id,comment,username,createdAt')->where('shareId', $id)->from('comment')->order_by('createdAt', 'desc')->get()->result();
  }

  public function postComment($data) {
    if($this->db->insert('comment', $data)){
      return "Success";
    }
    return "Error";
  }

  public function getCourse($id) {
    $data['course'] = $this->db->select('name, description, id')->from('course')->where('id', $id)->get()->row();
    $data['students'] = $this->db->select('studentId')->where('courseId', $data['course']->id)->where('status', '1')->from('studenttocourse')->get()->num_rows();
    return $data;
  }

  public function addCourse($data) {
    $name = $this->db->select('name')->where('name', $data['name'])->from($this->table)->get();
    if($name->num_rows() > 0){
      return "course";
    } else {
      $data['staff'] = $this->session->userdata('username');
      if($this->db->insert ($this->table, $data))
        $this->assignCourseToStaff($data['name']);
        return  "success";
    }
    return false;
  }

  private function assignCourseToStaff($courseName) {
    $courseId = $this->db->select('id')->where('name', $courseName)->from($this->table)->get()->row();
    $staffId = $this->db->select('id')->where('username', $this->session->userdata('username'))->from('staffs')->get()->row();
    $data = array(
      'courseId' => $courseId->id,
      'staffId' => $staffId->id
    );
    $this->db->insert('coursetostaff', $data);
    return true;
  }

  public function deleteCategory($data){
    $this->db->set('status', '0');
    $this->db->where('id', $data['id']);
    if($this->db->update($this->table))
      return "Successfully deleted";
    return false;

  }

  public function getCategory($id) {
  	$this->db->select('id, name');
  	$this->db->where('id',$id);
  	$this->db->where('status', 1)->from($this->table);
  	return $this->db->get()->result();
  }

  public function updateCategory($data) {
  	$this->db->set('name', $data['ename']);
  	$this->db->where('id', $data['id']);
  	$this->db->update($this->table);
  	return true;
  }





}
