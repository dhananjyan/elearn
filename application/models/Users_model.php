<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->table = 'users';
    $this->column_order = array(null, 'username', 'accessType', 'createdAt');
    $this->column_search = array('name');
    $this->order = array('id' => 'DESC');
  }

  public function authenticateAdmin($user) {
    $this->db->select('id, username, accessType');
    $this->db->where('username', $user['username']);
    $this->db->where('password', md5($user['password']));
    $this->db->where('accessType', 'admin');
    $this->db->where('status', '1');
    $this->db->from($this->table);
    $query = $this->db->get();
    if($query->num_rows() == 1){
      return $query->row();
    }
    return false;
  }

  public function authenticateStaff($user) {
    $this->db->select(' username,');
    $this->db->where('username', $user['username']);
    $this->db->where('password', md5($user['password']));
    $this->db->where('accessType', 'staff');
    $this->db->where('status', '1');
    $this->db->from($this->table);
    $query = $this->db->get();
    if($query->num_rows() == 1){
      return $query->row();
    }
    return false;
  }

  public function isRegisteredStaff($username) {
    $result = $this->db->select('username')->where('username', $username)->from('staffs')->get();
    if($result->num_rows() == 0){
      return false;
    } else {
      $this->db->select('staffs.username, users.accessType, staffs.categoryId');
      $this->db->where('staffs.username', $username);
      $this->db->where('users.username', $username);
      $this->db->from($this->table)->join('staffs', 'staffs.username = users.username');
      return $this->db->get()->row();
    }
  }

  public function addUser($data) {
    $username = $this->db->select('username')->where('username', $data['username'])->from($this->table)->get();
    if($username->num_rows() > 0){
      return "username";
    } else {
      $data['status'] = '1';
      $data['password'] = md5($data['password']);
      if($this->db->insert ($this->table, $data))
        return  "success";
    }
    return false;
  }

  public function deleteUser($data){
    $this->db->set('status', '0');
    $this->db->where('id', $data['id']);
    if($this->db->update($this->table))
      return "Successfully deleted";
    return false;

  }

  public function staffRegister($data) {
    $data['username'] = $this->session->userdata('username');
    $this->db->insert('staffs', $data);
    return true;
  }

  public function getUser() {
  	$this->db->select('id, username, name, accessType, email, mobileNo');

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
