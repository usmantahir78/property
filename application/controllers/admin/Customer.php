<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array();

        $data['title'] = "Customers List";
        $data['content'] = "admin/customers";
        $this->load->view(ADMIN_BODY, $data);
    }

    public function create() {
        $data = array();

        //Fetch Roles
        $where = array('role_status' => 'Active');
        $data['roles'] = $this->common->fetch_where('role_id,role_name', 'roles', $where);

        $data['title'] = "Booking";
        $data['content'] = "admin/instalments/create";
        $this->load->view(ADMIN_BODY, $data);
    }

    public function save() {
        $data = array();
        if ($this->input->post('submit')) {
            
            $instalment['user_id'] = $this->session->userdata('user_id');
            $instalment['instalment_number'] = $this->input->post('revcieving_number');
            $instalment['instalment_date'] = $this->input->post('receive_date');
            $instalment['property_number'] = $this->input->post('plot_no');
            $instalment['customer_id'] = 1;
            $instalment['amount_type'] = $this->input->post('in_account_of');
            $instalment['instalment_amount'] = $this->input->post('amount');
            $instalment['instalment_description'] = $this->input->post('description');
            $instalment['customer_name'] = $this->input->post('customer_first_name').' '.$this->input->post('customer_last_name');
            $instalment['total_amount'] = $this->input->post('total_payment');
            $instalment['amount_in_words'] = $this->input->post('in_words');
            $instalment_id = $this->common->save('instalments', $instalment);
            if ($instalment_id) {
                redirect(base_url().'admin/instalments/index/'.$instalment_id);
            }
        }
    }

    public function delete() {
        $data = array();
        $where = array('user_id' => $this->input->post('id'));
        if ($this->common->delete('users', $where)) {
            echo 'deleted';
        } else {
            echo 'not_found';
        }
    }

    public function update() {
        $data = array();
        $post_data['first_name'] = $this->input->post('first_name');
        $post_data['last_name'] = $this->input->post('last_name');
        $post_data['user_email'] = $this->input->post('user_email');
        $post_data['role_id'] = $this->input->post('role_id');
        $post_data['status'] = $this->input->post('status');
        $where = array('user_id' => $this->input->post('id'));
        if ($this->common->update('users', $post_data, $where)) {
            echo 'saved';
        } else {
            echo 'not_saved';
        }
    }

    public function get_data() {
        $data = array();
        $jqx_data = $this->common->get_jqx_data($_GET, 'customers_id', 'customers.*', 'customers');
        $returnData = null;
        if ($jqx_data) {
            $delete = '';
            foreach ($jqx_data['resultData'] as $row) {
              
                $returnData[] = array(
                    'customer_id' => $row['customer_id'],
                    'customer_first_name' => $row['customer_first_name'],
                    'customer_last_name' => $row['customer_last_name'],
                    'customer_identity' => $row['customer_identity'],
                    'customer_phone' => $row['customer_phone'],
                    'customer_status' => $row['customer_status'],
                    
                    'actions' => '<i class="fa fa-eye"></i>'
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

    public function getRecord() {
        $data = array();
        $where = array('user_id' => $this->input->post('id'));
        $user = $this->common->fetch_row('first_name,last_name,user_email,role_id,status', 'users', $where);
        if ($user) {
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($user));
        } else {
            echo 'not_found';
        }
    }

}
