<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Day extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('day_model');
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
        if($this->session->userdata('day_id')){
            redirect(base_url().'admin/day/daydetails');
        }
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
    public function daydetails() {
        if($this->uri->segment(4)!=""){
            $day_id = $this->uri->segment(4);
        }else if($this->session->userdata('day_id')){
            $day_id = $this->session->userdata('day_id');
        }
        if($day_id==""){
            redirect(base_url().'admin/day/listing');
        }
        $data = array();
        $day = $this->day_model->getDay($day_id);
        $daydetails = $this->day_model->getDayDetails($day_id);
        $data['title'] = "Day Details";
        $data['day_id'] = $day_id;
        $data['day'] = $day;
        $data['daydetails'] = $daydetails;
        $data['content'] = "admin/dayopenclose/daydetails";
        $this->load->view(ADMIN_BODY, $data);
    }
    public function close() {
         $data = array();
        $post_data['day_id'] = $this->session->userdata('day_id');
        $post_data['day_close_amount'] = $this->input->post('closing_cash');
        $post_data['day_closedate'] = date('Y-m-d');
        $post_data['day_status'] = 'closed';
        $where = array('day_id' => $this->session->userdata('day_id'));
        if ($this->common->update('dayopenclose', $post_data, $where)) {
            $day = array( 'day_id' => '','day_status' => 'closed' );
            $this->session->set_userdata($day);
            redirect(base_url().'admin/day/listing');
        }
    }
    public function listing() {
        $data = array();
        $data['title'] = "Day Listings";
        $data['content'] = "admin/dayopenclose/listing";
        $this->load->view(ADMIN_BODY, $data);
    }
    public function get_data() {
        $data = array();
        $jqx_data = $this->common->get_jqx_data($_GET, 'day_id', 'dayopenclose.*', 'dayopenclose');
        $returnData = null;
        if ($jqx_data) {
            $delete = '';
            foreach ($jqx_data['resultData'] as $row) {
              $cashier_name = $this->common->fetch_row('first_name,last_name', 'users', array('user_id'=>$row['user_id'])); 
                $returnData[] = array(
                    'day_id' => $row['day_id'],
                    'cashier_name' => $cashier_name->first_name.' '.$cashier_name->last_name,
                    'day_open_amount' => $row['day_open_amount'],
                    'day_close_amount' => $row['day_close_amount'],
                    'day_opendate' => date('d-m-Y',strtotime($row['day_opendate'])),
                    'day_closedate' => date('d-m-Y',strtotime($row['day_closedate'])),
                    'day_status' => $row['day_status'],
                    
                    'actions' => '<a class="edit" href="'.base_url().'admin/day/daydetails/' . $row['day_id'] .'">View</a>'
                );
            }
            $data[] = array(
                'TotalRows' => $jqx_data['total_rows'],
                'Rows' => $returnData
            );
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($data));
        } else {
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($data));
        }
    }
    

    
}
