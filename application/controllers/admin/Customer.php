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

    public function save() {
        $data = array();
        $post_data['customer_first_name'] = $this->input->post('customer_first_name');
        $post_data['customer_last_name'] = $this->input->post('customer_last_name');
        $post_data['cutomer_email'] = $this->input->post('cutomer_email');
        $post_data['customer_phone'] = $this->input->post('customer_phone');
        $post_data['customer_identity'] = $this->input->post('customer_identity');
        $post_data['customer_address'] = $this->input->post('customer_address');
        $post_data['customer_status'] = $this->input->post('customer_status');
        $post_data['user_id'] = $this->session->userdata('user_id');

        if ($this->common->save('customers', $post_data)) {
            echo 'saved';
        } else {
            echo 'not_saved';
        }
    }

    public function update() {
        $data = array();
        $post_data['customer_first_name'] = $this->input->post('customer_first_name');
        $post_data['customer_last_name'] = $this->input->post('customer_last_name');
        $post_data['cutomer_email'] = $this->input->post('cutomer_email');
        $post_data['customer_phone'] = $this->input->post('customer_phone');
        $post_data['customer_identity'] = $this->input->post('customer_identity');
        $post_data['customer_address'] = $this->input->post('customer_address');
        $post_data['customer_status'] = $this->input->post('customer_status');
        $where = array('customer_id' => $this->input->post('id'));
        if ($this->common->update('customers', $post_data, $where)) {
            echo 'saved';
        } else {
            echo 'not_saved';
        }
    }

    public function get_data() {
        $data = array();
        $jqx_data = $this->common->get_jqx_data($_GET, 'customers_id', 'customers.*', 'customers');
        $returnData = array();
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
                    'actions' => '<a data-toggle="modal" class="edit" title="Edit Customer" href="#edit-modal-form" onClick="return getRecord(' . $row['customer_id'] . ');"><i class="fa fa-edit"></i></a> <a data-toggle="modal" class="delete" title="Delete User" href="#delete-modal-form" onClick="return setId(' . $row['customer_id'] . ');"><i class="fa fa-times"></i></a> '
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
        $where = array('customer_id' => $this->input->post('id'));
        $user = $this->common->fetch_row('customer_first_name,customer_last_name,customer_phone,cutomer_email,customer_identity,customer_address,customer_status', 'customers', $where);
        if ($user) {
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($user));
        } else {
            echo 'not_found';
        }
    }

    public function checkCustomerId() {
        $data = array();
        $where = array('customer_identity' => $this->input->post('identity'));
        $user = $this->common->fetch_row('customer_identity', 'customers', $where);
        if ($user) {
            echo 'found';
        } else {
            echo 'not_found';
        }
    }

    public function checkEditCustomerId() {
        $data = array();
        $where = array('customer_identity' => $this->input->post('identity'), 'customer_id!=' => $this->input->post('customer_id'));
        $user = $this->common->fetch_row('customer_identity', 'customers', $where);
        if ($user) {
            echo 'found';
        } else {
            echo 'not_found';
        }
    }

    public function delete() {
        $data = array();
        $where = array('customer_id' => $this->input->post('id'));
        $customer = $this->common->fetch_row('customer_id', 'sale', $where);
        if ($customer) {
            echo 'used';
        } else {
            $where = array('customer_id' => $this->input->post('id'));
            if ($this->common->delete('customers', $where)) {
                echo 'deleted';
            } else {
                echo 'not_found';
            }
        }
    }

    public function report() {
        $data = array();
        $where = array('customer_status' => 'Active');
        $data['vendors'] = $this->common->fetch_where(false, 'customers', $where);
        $data['title'] = "Customer Report";
        $data['content'] = "admin/reports/customer_report";
        $this->load->view(ADMIN_BODY, $data);
    }

    public function reportPDF() {
        //Check access for this area
        check_access($this->session->userdata('role_id'), 3);
        if ($this->uri->segment(4) != "") {
            $day_id = $this->uri->segment(4);
        } else if ($this->session->userdata('day_id')) {
            $day_id = $this->session->userdata('day_id');
        }
        if ($day_id == "") {
            redirect(base_url() . 'admin/customer');
        }
        $this->load->model('booking_model');
        $this->load->library('pdf');
        $data = array();
        $customer_id = $this->input->post('customer');
        $sale_id = $this->input->post('sale_id');
        if($sale_id){
                $sale = $this->booking_model->getSaleDetails($sale_id);

                $data['sale'] = $sale;
                $data['installments'] = $this->booking_model->getInstallments($sale_id);
                $data['adv_installments'] = $this->booking_model->getAdvInstallments($sale_id);
                $data['total_paid'] = $this->booking_model->getTotalPaidBySaleId($sale_id);
                $data['total_adv_paid'] = $this->booking_model->getTotalAdvPaidBySaleId($sale_id);
                $data['installmentsData'] = $this->booking_model->getInstallmentDataBySaleId($sale_id);
        }
        $this->pdf->loadHtml($this->load->view('admin/reports/booking_report',$data, TRUE));
        $this->pdf->render();
        $this->pdf->stream("Customer_booking_".$sale_id.".pdf", array("Attachment"=>0));
    }

    public function getPlots() {
        $data = array();
        $where = array('customer_id' => $this->input->post('customer_id'));
        $plot = $this->common->fetch_where('property_number,property_id,sale_id', 'sale', $where);
        $html = '';
        if ($plot) {
            foreach ($plot as $p) {
                $html .= '<option value="' . $p->sale_id . '">' . $p->property_number . '</option>';
            }
            echo $html;
        } else {
            echo 'not_found';
        }
    }

}
