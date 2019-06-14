<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Instalments extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('booking_model');
    }

    public function index() {
        $data = array();

        $data['title'] = "Instalments";
        $data['content'] = "admin/instalments/instalments";
        $this->load->view(ADMIN_BODY, $data);
    }

    public function create() {
        $data = array();

        $installment_id = $this->uri->segment(4);
        if ($installment_id) {
            $installment = $this->booking_model->getInstallmentDetail($installment_id);

            $data['installment'] = $installment;
//                        echo "<pre>";
//            print_r($data['installment']); exit;
        } else {
            redirect(base_url() . 'admin/booking');
        }

        $data['title'] = "Booking";
        $data['content'] = "admin/instalments/create";
        $this->load->view(ADMIN_BODY, $data);
    }

    public function reveiveadv() {
        $data = array();

        $adv_id = $this->uri->segment(4);
        if ($adv_id) {
            $installment = $this->booking_model->getAdvInstallmentById($adv_id);
//            echo '<pre>';
//            print_r($installment); exit;

            $data['advance'] = $installment;
//                        echo "<pre>";
//            print_r($data['installment']); exit;
        } else {
            redirect(base_url() . 'admin/booking');
        }

        $data['title'] = "Booking";
        $data['content'] = "admin/instalments/receive_adv";
        $this->load->view(ADMIN_BODY, $data);
    }

    public function save() {
        $data = array();
        //print_r($this->input->post()); exit;
        if ($this->input->post('submit')) {

            $instalment['user_id'] = $this->session->userdata('user_id');
            $instalment['instalment_number'] = $this->input->post('revcieving_number');
            $instalment['property_number'] = $this->input->post('plot_no');
            $instalment['customer_id'] = $this->input->post('customer_id');
            $instalment['instalment_amount'] = $this->input->post('amount');
            $instalment['instalment_description'] = $this->input->post('description');
            $instalment['customer_name'] = $this->input->post('customer_first_name') . ' ' . $this->input->post('customer_last_name');
            $instalment['total_amount'] = $this->input->post('total_payment');
            $instalment['amount_in_words'] = $this->input->post('in_words');
            $instalment['installment_status'] = 'Paid';
            $instalment['date_paid'] = date('Y-m-d');
            //  print_r($instalment); exit;
            $where = array('instalment_id' => $this->input->post('instalment_id'));
            if ($this->common->update('instalments', $instalment, $where)) {
                redirect(base_url() . 'admin/booking/details/' . $this->input->post('sale_id'));
            }
        }
    }

    public function saveAdvance() {
        $data = array();

        if ($this->input->post('submit')) {

            $instalment['adv_receive_by'] = $this->session->userdata('user_id');
            $instalment['property_id'] = $this->input->post('property_id');
            $instalment['sale_id'] = $this->input->post('sale_id');
            $instalment['adv_amount'] = $this->input->post('amount');
            $instalment['adv_status'] = 'Paid';
            $instalment['adv_receive_date'] = date('Y-m-d');
            $instalment['instalment_number'] = $this->input->post('revcieving_number');
            $instalment['instalment_description'] = $this->input->post('description');
            $instalment['adv_paid_amount'] = $this->input->post('amount');

            $where = array('adv_id' => $this->input->post('adv_id'));
            if ($this->common->update('adv_instalments', $instalment, $where)) {
                if($this->input->post('remaining')>0){
                    $instalment = array();
                    $instalment['property_id'] = $this->input->post('property_id');
                    $instalment['sale_id'] = $this->input->post('sale_id');
                    $instalment['adv_amount'] = $this->input->post('remaining');
                    $instalment['adv_status'] = 'Pending';
                    $instalment['adv_paid_amount'] = 0;
                    if($this->input->post('remaining_date')){
                        $instalment['adv_date'] = $this->input->post('remaining_date');
                    }else{
                        $instalment['adv_date'] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 10 days'));
                    }
                    if($this->common->save('adv_instalments', $instalment)){
                         redirect(base_url() . 'admin/booking/details/' . $this->input->post('sale_id'));
                    }
                }
                else{
                    redirect(base_url() . 'admin/booking/details/' . $this->input->post('sale_id'));
                }
                
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
        $jqx_data = $this->common->get_jqx_data($_GET, 'instalment_number', 'instalments.*', 'instalments');
        $returnData = null;
        if ($jqx_data) {
            $delete = '';
            foreach ($jqx_data['resultData'] as $row) {

                $returnData[] = array(
                    'instalment_number' => $row['instalment_number'],
                    'property_number' => $row['property_number'],
                    'customer_name' => $row['customer_name'],
                    'instalment_date' => date('d-m-Y', strtotime($row['instalment_date'])),
                    'amount_type' => $row['amount_type'],
                    'total_amount' => $row['total_amount'],
                    'actions' => '<a data-toggle="modal" class="edit" title="Edit User" href="#edit-modal-form" onClick="return getRecord(' . $row['instalment_number'] . ');"><i class="fa fa-eye"></i></a> '
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
