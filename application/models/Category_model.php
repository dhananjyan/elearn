<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->table = 'category';
    $this->column_order = array(null, 'name', 'createdAt');
    $this->column_search = array('name');
    $this->order = array('id' => 'DESC');
  }

  public function getAllCategories() {
    $this->db->select('name, id');
    $this->db->where('status', '1')->from($this->table);
    return $this->db->get()->result();
  }

  public function addCategory($data) {
    $username = $this->db->select('name')->where('name', $data['name'])->from($this->table)->get();
    if($username->num_rows() > 0){
      return "category";
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

  private function _get_datatables_query() {
  	$this->db->where('status','1');
    $this->db->from($this->table);
	  $i = 0;
    foreach ($this->column_search as $item) {
      if($_POST['search']['value']) {
        if($i===0) {
          $this->db->group_start();
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }
			  if(count($this->column_search) - 1 == $i) 
          $this->db->group_end();
      }
      $i++;
    }
    if(isset($_POST['order'])) {
      $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if(isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }
 
  function get_datatables() {
    $this->_get_datatables_query();
    if($_POST['length'] != -1)
    $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }
 
  function count_filtered() {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }
 
  public function count_all() {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }



}
