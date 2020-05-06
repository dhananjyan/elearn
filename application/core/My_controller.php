<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_controller extends CI_Controller {

    function __construct() {
      parent::__construct();
    }

}


class User_Controller extends MY_controller {

    function __construct() {
      parent::__construct();
    }


}

class Staffs_Controller extends MY_controller {

    function __construct() {
      parent::__construct();
      if($this->session->userdata('loggedIn') != true || $this->session->userdata('accessType') != 'staff')
        show_404();
    }

    function view($data) {
      $this->load->view('partials/header1',$data);
      $this->load->view('staffs/'.$data['main_content']);
      $this->load->view('partials/footer1');
    }

}

class Admin_Controller extends MY_controller {

    function __construct() {
      parent::__construct();
      if($this->session->userdata('loggedIn') != true || $this->session->userdata('accessType') != 'admin')
        show_404();
    }

    function view($data) {
      $this->load->view('partials/header',$data);
      $this->load->view('admin/'.$data['main_content']);
      $this->load->view('partials/footer');
    }

}

class Student_Controller extends MY_controller {

    function __construct() {
      parent::__construct();
    }

}