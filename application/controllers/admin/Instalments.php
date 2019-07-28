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
        //Check access for this area
        check_access($this->session->userdata('role_id'),2);
        
        if($this->session->userdata('day_id')=="") {
            redirect(base_url() . 'admin/day/open');
        }
        $installment_id = $this->uri->segment(4);
        if ($installment_id) {
            $installment = $this->booking_model->getInstallmentDetail($installment_id);

            $data['installment'] = $installment;
//                        echo "<pre>";
//            print_r($data['installment']); exit;
        } else {
            redirect(base_url() . 'admin/booking');
        }
        $data['settings'] = $this->common->fetch_row(false, 'settings', array('setting_id'=>1));
        $data['title'] = "Booking";
        $data['content'] = "admin/instalments/create";
        $this->load->view(ADMIN_BODY, $data);
    }

    public function reveiveadv() {
        //Check access for this area
        check_access($this->session->userdata('role_id'),5);
        
        $data = array();
        if($this->session->userdata('day_id')=="") {
            redirect(base_url() . 'admin/day/open');
        }
        $adv_id = $this->uri->segment(4);
        if ($adv_id) {
            $installment = $this->booking_model->getAdvInstallmentById($adv_id);
            $data['advance'] = $installment;
        } else {
            redirect(base_url() . 'admin/booking');
        }
        $data['settings'] = $this->common->fetch_row(false, 'settings', array('setting_id'=>1));
        $data['title'] = "Booking";
        $data['content'] = "admin/instalments/receive_adv";
        $this->load->view(ADMIN_BODY, $data);
    }

    public function save() {
        //Check access for this area
        check_access($this->session->userdata('role_id'),5);
        $data = array();
        //print_r($this->input->post()); exit;
        if ($this->input->post('submit')) {

            $instalment['user_id'] = $this->session->userdata('user_id');
            $instalment['instalment_number'] = $this->input->post('receiving_number');
            $instalment['property_number'] = $this->input->post('plot_no');
            $instalment['customer_id'] = $this->input->post('customer_id');
            $instalment['instalment_amount'] = (double)str_replace(",","",$this->input->post('amount'));
            $instalment['instalment_description'] = $this->input->post('description');
            $instalment['customer_name'] = $this->input->post('customer_first_name') . ' ' . $this->input->post('customer_last_name');
            $instalment['total_amount'] = (double)str_replace(",","",$this->input->post('total_payment'));
            $instalment['amount_in_words'] = $this->input->post('in_words');
            $instalment['installment_status'] = 'Paid';
            $instalment['date_paid'] = date('Y-m-d');
            $instalment['slip_number'] = $this->input->post('slip_number');
            
            //  print_r($instalment); exit;
            $where = array('instalment_id' => $this->input->post('instalment_id'));
            if ($this->common->update('instalments', $instalment, $where)) {
                $ledger = array();
                $ledger['day_id'] = $this->session->userdata('day_id');
                $ledger['user_id'] = $this->session->userdata('user_id');
                $ledger['customer_id'] = $this->input->post('customer_id');
                $ledger['type'] = 'debit';
                $ledger['customer_type'] = 'customer';
                $ledger['amount'] = (double)str_replace(",","",$this->input->post('amount'));
                $ledger['vocher_number'] = $this->input->post('receiving_number');
                $ledger['vocher_type'] = 'instalment';
                $number_increament = floatval(str_replace('RV-', '', $this->input->post('receiving_number')));
                $number_increament = $number_increament+1;
                $this->common->update('settings', array('slip_number'=>  $number_increament),array('setting_id'=>1));
                $this->common->ledgerentry($ledger);
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
            $instalment['adv_amount'] = (double)str_replace(",","",$this->input->post('amount'));
            $instalment['adv_status'] = 'Paid';
            $instalment['adv_receive_date'] = date('Y-m-d');
            $instalment['instalment_number'] = $this->input->post('receiving_number');
            $instalment['instalment_description'] = $this->input->post('description');
            $instalment['adv_paid_amount'] = (double)str_replace(",","",$this->input->post('amount'));
            $instalment['slip_number'] = $this->input->post('slip_number');
            

            $where = array('adv_id' => $this->input->post('adv_id'));
            if ($this->common->update('adv_instalments', $instalment, $where)) {
                        $ledger = array();
                        $ledger['day_id'] = $this->session->userdata('day_id');
                        $ledger['user_id'] = $this->session->userdata('user_id');
                        $ledger['customer_id'] = $this->input->post('customer_id');
                        $ledger['type'] = 'debit';
                        $ledger['customer_type'] = 'customer';
                        $ledger['amount'] = (double)str_replace(",","",$this->input->post('amount'));
                        $ledger['vocher_number'] = $this->input->post('receiving_number');
                        $ledger['vocher_type'] = 'advance';
                        $number_increament = floatval(str_replace('ADV-', '', $this->input->post('receiving_number')));
                        $number_increament = $number_increament+1;
                        $this->common->update('settings', array('adv_number'=>  $number_increament),array('setting_id'=>1));
                        $this->common->ledgerentry($ledger);
                if($this->input->post('remaining')>0){
                    $instalment = array();
                    $instalment['property_id'] = $this->input->post('property_id');
                    $instalment['sale_id'] = $this->input->post('sale_id');
                    $instalment['adv_amount'] = (double)str_replace(",","",$this->input->post('remaining'));
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
        $returnData = array();
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
    public function reveivepayment() {
        //Check access for this area
        check_access($this->session->userdata('role_id'),6);
        
        $data = array();
        if($this->session->userdata('day_id')=="") {
            redirect(base_url() . 'admin/day/open');
        }
        $venders = $this->common->fetch(false,'venders');
        $data['venders'] = $venders;
        $data['settings'] = $this->common->fetch_row(false, 'settings', array('setting_id'=>1));
      
        $data['title'] = "Booking";
        $data['content'] = "admin/receive_payment";
        $this->load->view(ADMIN_BODY, $data);
    }
    public function savePayments() {
        $payment = array();
        $payment['user_id']         = $this->session->userdata('user_id');
        $payment['day_id']          = $this->session->userdata('day_id');
        $payment['slip_number']     = $this->input->post('slip_number');
        $payment['vender_id']       = $this->input->post('vender_id');
        $payment['r_p_number']      = $this->input->post('r_p_number');
        $payment['amount']          = (double)str_replace(",","",$this->input->post('amount'));
        $payment['description']     = $this->input->post('description');
        $payment['vocher_number']   = $this->input->post('vocher_number');
        $payment['payment_date']    = date('Y-m-d');
        $payments                   = $this->common->save('payments', $payment);
        if($payments){
            $ledger = array();
            $ledger['day_id'] = $this->session->userdata('day_id');
            $ledger['user_id'] = $this->session->userdata('user_id');
            $ledger['customer_id'] = $this->input->post('vender_id');
            $ledger['type'] = 'credit';
            $ledger['customer_type'] = 'vender';
            $ledger['amount'] = (double)str_replace(",","",$this->input->post('amount'));
            $ledger['vocher_number'] = $this->input->post('vocher_number');
            $ledger['vocher_type'] = 'vender';
            $number_increament = floatval(str_replace('VR-', '', $this->input->post('vocher_number')));
            $number_increament = $number_increament+1;
            $this->common->update('settings', array('vocher_number'=>  $number_increament),array('setting_id'=>1));
            $this->common->ledgerentry($ledger);
            redirect(base_url().'admin/day/open');
        }
    }
    
}
