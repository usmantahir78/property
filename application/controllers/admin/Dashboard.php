<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array();
        $data['title'] = "Dashboard";
        $data['content'] = "admin/dashboard";
        $this->load->view(ADMIN_BODY,$data);
    }

}
