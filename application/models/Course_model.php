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

  public function getAllCategories() {
    $this->db->select('name, id');
    $this->db->where('status', '1')->from($this->table);
    return $this->db->get()->result();
  }

  public function addCourse($data) {
    $name = $this->db->select('name')->where('name', $data['name'])->from($this->table)->get();
    if($name->num_rows() > 0){
      return "course";
    } else {
      if($this->db->insert ($this->table, $data))
        return  "success";
    }
    return false;
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
