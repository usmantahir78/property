<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Day extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('booking_model');
    }

    public function index() {
        $data = array();

        $data['title'] = "Booking";
        $data['content'] = "admin/booking/booking";
        $this->load->view(ADMIN_BODY, $data);
    }

    public function open() {
        $data = array();
        $data['title'] = "Day Open";
        $data['content'] = "admin/dayopenclose/open";
        echo $this->session->userdata('day_id');
        $this->load->view(ADMIN_BODY, $data);
    }
    public function openday() {
        $day = array();
        $day['user_id']             = $this->session->userdata('user_id');
        $day['day_status']          = 'open';
        $day['day_open_amount']     = $this->input->post('day_open_amount');
        $day_id                     = $this->common->save('dayopenclose', $day);
        if($day_id){
            $day = array( 'day_id' => $day_id,'day_status' => 'open' );
            $this->session->set_userdata($day);
            redirect(base_url().'admin/day/open');
        }
    }


    
}
