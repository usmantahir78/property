<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    function __construct() {
        parent::__construct();
    }

    public function index() {
        //Check access for this area
        check_access($this->session->userdata('role_id'),1);
        $data = array();
        $data['title'] = "Dashboard";
        $data['content'] = "admin/dashboard";
        $this->load->view(ADMIN_BODY,$data);
    }

}
