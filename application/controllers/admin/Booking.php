<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('booking_model');
		$this->load->library('pdf');
    }

    public function dwd()
	{
		echo "Dawood test";
	}

    public function index() {
        $data = array();

        //Fetch Roles
        $where = array('role_status' => 'Active');
        $data['roles'] = $this->common->fetch_where('role_id,role_name', 'roles', $where);

        $data['title'] = "Booking";
        $data['content'] = "admin/booking/booking";
        $this->load->view(ADMIN_BODY, $data);
    }

    public function create() {
        $data = array();

        //Fetch Roles
        $where = array('role_status' => 'Active');
        $data['roles'] = $this->common->fetch_where('role_id,role_name', 'roles', $where);

        $data['title'] = "Booking";
        $data['content'] = "admin/booking/create";
        $this->load->view(ADMIN_BODY, $data);
    }

    public function save() {
        $data = array();
        $sale_id = '';
        
        if ($this->input->post('submit')) {
            
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

            $customer['user_id'] = $this->session->userdata('user_id');
            if($this->input->post('customer_id')==0){
                $customer['customer_first_name']        = $this->input->post('customer_first_name');
                $customer['customer_last_name']         = $this->input->post('customer_last_name');
                $customer['customer_identity']          = $this->input->post('customer_identity');
                $customer['customer_phone']             = $this->input->post('customer_phone');
                $customer['customer_address']           = $this->input->post('customer_address');
                $customer['customer_address']           = $this->input->post('customer_address');
                $customer_id = $this->common->save('customers', $customer);
            }else{
                $customer_id = $this->input->post('customer_id');
            }
            if ($customer_id) {
                $target_dir = "assets/admin/uploads/";
                $target_file = $target_dir . basename($_FILES["file"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $newfilename = round(microtime(true)) . '_image.' . $imageFileType;

                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $newfilename)) {
                    $customer_image = $newfilename;
                } else {
                    $customer_image = '';
                }
                $target_file = $target_dir . basename($_FILES["file2"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $newfilename = round(microtime(true)) . '_file.' . $imageFileType;

                if (move_uploaded_file($_FILES["file2"]["tmp_name"], $target_dir . $newfilename)) {
                    $customer_file = $newfilename;
                } else {
                    $customer_file = '';
                }
                $property['user_id']                = $this->session->userdata('user_id');
                $property['property_number']        = $this->input->post('plot_no');
                $property['property_in_marla']      = $this->input->post('property_in_marla');
                $property['property_in_sarsahi']    = $this->input->post('property_in_sarsahi');
                $property['property_per_marla']     = $this->input->post('property_per_marla');
                $property['property_total_price']   = $this->input->post('property_total_price');
                $property['property_status']        = 'Booked';
                $property_id = $this->common->save('property', $property);
                
                $nominee['nominee_first_name']      = $this->input->post('nominee_first_name');
                $nominee['nominee_last_name']       = $this->input->post('nominee_last_name');
                $nominee['nominee_identity']        = $this->input->post('nominee_identity');
                $nominee['nominee_phone']           = $this->input->post('nominee_phone');
                $nominee['nominee_cast']            = $this->input->post('nominee_cast');
                $nominee['nominee_relation']        = $this->input->post('nominee_relation');
                $nominee['nominee_address']         = $this->input->post('nominee_address');
                $nominee['customer_id']             = $customer_id;
                $nominee['property_id']             = $property_id;
                $this->common->save('nominee', $nominee);
                
                $sale['property_id'] = $property_id;
                $sale['customer_id'] = $customer_id;
                $sale['user_id'] = $this->session->userdata('user_id');
                $sale['token_number'] = $this->input->post('token_no');
                $sale['property_number'] = $this->input->post('plot_no');
                $sale['advance_percent'] = $this->input->post('advance_percent');
                $sale['advance_amount'] = $this->input->post('advance_amount');
                $sale['property_token'] = $this->input->post('property_token');
                $sale['remaning_advance_payment_date'] = $this->input->post('remaning_advance_payment_date');
                $sale['total_instalments'] = $this->input->post('total_instalments');
                $sale['instalment_amount'] = $this->input->post('instalment_amount');
                $sale['instalment_payment_date'] = $this->input->post('instalment_payment_date');
                $sale['description'] = $this->input->post('description');
                $sale['customer_name'] = $this->input->post('customer_first_name').' '.$this->input->post('customer_last_name');
                $sale['customer_identity'] = $this->input->post('customer_identity');
                $sale['total_price'] = $this->input->post('property_total_price');
                $sale['remaining_advance'] = $this->input->post('remaining_advance');
                $sale['customer_image'] = $customer_image;
                $sale['customer_file'] = $customer_file;
                $sale_id = $this->common->save('sale', $sale);
                
                $instalment = array();
                $instalment_type = $this->input->post('instalment_type');
                $date = $this->input->post('booking_date');
                for($p=0;$p<$this->input->post('total_instalments');$p++){
                    $int = array();
                    if($instalment_type=='monthly') {
                        $date = date('Y-m-d', strtotime("+1 months", strtotime( $date)));
                    }else if($instalment_type=='quarterly'){
                        $date = date('Y-m-d', strtotime("+3 months", strtotime( $date)));
                    }else if($instalment_type=='biyearly'){
                        $date = date('Y-m-d', strtotime("+6 months", strtotime( $date)));
                    }else if($instalment_type=='yearly'){
                        $date = date('Y-m-d', strtotime("+12 months", strtotime( $date)));
                    }
                    $int['instalment_date'] = $date;
                    $int['property_number'] = $this->input->post('plot_no');
                    $int['customer_id']     = $customer_id;
                    $int['customer_name']   = $this->input->post('customer_first_name').' '.$this->input->post('customer_last_name');
                    $int['total_amount']    = $this->input->post('instalment_amount');
                    $int['instalment_amount']   = $this->input->post('instalment_amount');
                    $int['property_id']         = $property_id;
                    $int['sale_id']         = $sale_id;
                    $instalment[]               = $int;
                }
                $this->db->insert_batch('instalments', $instalment); 
                
                if($this->input->post('property_token')>0){
                    $adv = array();
                    $adv['property_id'] = $property_id;
                    $adv['sale_id'] = $sale_id;
                    $adv['adv_amount'] = $this->input->post('property_token');
                    $adv['adv_date'] = date('Y-m-d');
                    $adv['adv_status'] = 'Paid';
                    $adv['adv_receive_by'] = $this->session->userdata('user_id');
                    $adv['adv_receive_date'] = date('Y-m-d');
                    $adv['instalment_number'] = date('YmdHis');
                    $adv['adv_paid_amount'] = $this->input->post('property_token');
                    
                    $this->common->save('adv_instalments', $adv);
                }
                
                //////////// If advance have installments ////////////////////
                $advance = array();
                $adv_amount_array = $this->input->post('adv_amount');
                if(count($adv_amount_array)>0){
                    if($adv_amount_array[0]>0) {
                    $adv_date_array = $this->input->post('adv_date');
                    for($a=0;$a<count($adv_amount_array);$a++){
                        if($adv_amount_array[$a]>0) {
                            $adv = array();
                            $adv['property_id'] = $property_id;
                            $adv['sale_id'] = $sale_id;
                            $adv['adv_amount'] = $adv_amount_array[$a];
                            $adv['adv_date'] = $adv_date_array[$a];
                            $adv['adv_status'] = 'Pending';
                            $adv['adv_paid_amount'] = 0;
                            $advance[] = $adv;
                        }
                    }
                    $this->db->insert_batch('adv_instalments', $advance); 
                    }else{
                        if($this->input->post('property_token')<$this->input->post('advance_amount')){
                                 $adv = array();
                                $adv['property_id'] = $property_id;
                                $adv['sale_id'] = $sale_id;
                                $adv['adv_amount'] = $this->input->post('advance_amount')-$this->input->post('property_token');
                                $adv['adv_date'] = date('Y-m-d');
                                $adv['adv_status'] = 'Pending';
                                $adv['adv_receive_by'] = $this->session->userdata('user_id');
                                $adv['adv_paid_amount'] = 0;
                                
                                $this->common->save('adv_instalments', $adv);
                            }
                    }
                    
                }
            }

            $this->db->trans_complete(); # Completing transaction

            /* Optional */

            if ($this->db->trans_status() === FALSE) {
                # Something went wrong.
                $this->db->trans_rollback();
                return FALSE;
            } else {
                # Everything is Perfect. 
                # Committing data to the database.
                $this->db->trans_commit();
//                echo "<pre>";
//                print_r($this->input->post()); exit;
                redirect(base_url().'admin/booking/details/'.$sale_id);
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
        $jqx_data = $this->common->get_jqx_data($_GET, 'token_number', 'sale.*', 'sale');
        $returnData = null;
        if ($jqx_data) {
            $delete = '';
            foreach ($jqx_data['resultData'] as $row) {
              
                $returnData[] = array(
                    'property_number' => $row['property_number'],
                    'customer_name' => $row['customer_name'],
                    'customer_identity' => $row['customer_identity'],
                    'total_price' => number_format($row['total_price'],2),
                    'token_number' => $row['token_number'],
                    'total_instalments' => $row['total_instalments'],
                    'actions' => '<a title="Edit Booking" class="edit" href="'.base_url().'admin/booking/details/' . $row['sale_id'] .'"><i class="fa fa-eye"></i></a><span> | </span><a title="Download Pdf" target="_blank" class="edit" href="'.base_url().'admin/booking/pdfDetails/' . $row['sale_id'] .'"><i class="fa fa-download"></i></a> '
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
    public function checkPlotAvailabilty() {
        $data = array();
        $where = array('property_number' => $this->input->post('plot_no'));
        $property_number = $this->common->fetch_row('property_number', 'property', $where);
        if ($property_number) {
            echo 'found';
        } else {
            echo 'not_found';
        }
    }
    public function getCustomer() {
        $data = array();
        $where = array('customer_identity' => $this->input->post('id'));
        $customer = $this->common->fetch_row('customer_id,customer_first_name,customer_last_name,customer_phone,cutomer_email,customer_address', 'customers', $where);
        if ($customer) {
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($customer));
        } else {
            echo 'not_found';
        }
    }
    public function details() {
       //echo date('Y-m-d',strtotime('Wed May 01 2019 00:00:00 GMT+0500 (Pakistan Standard Time)')); exit;
        $data = array();
        $data['title'] = "Sale Details";
        $sale_id = $this->uri->segment(4);
        if($sale_id){
            $sale = $this->booking_model->getSaleDetails($sale_id);

            $data['sale'] = $sale;
            $data['installments'] = $this->booking_model->getInstallments($sale_id);
            $data['adv_installments'] = $this->booking_model->getAdvInstallments($sale_id);
            $data['total_paid'] = $this->booking_model->getTotalPaidBySaleId($sale_id);
            $data['total_adv_paid'] = $this->booking_model->getTotalAdvPaidBySaleId($sale_id);
            //            echo "<pre>";
//            print_r($data['installments']); exit;
        }else{
            redirect(base_url().'admin/booking');
        }
        
        $data['content'] = "admin/booking/details";
        $this->load->view(ADMIN_BODY, $data);
    }

    public function pdfDetails()
	{
		$sale_id = $this->uri->segment(4);
		if($sale_id){
			$sale = $this->booking_model->getSaleDetails($sale_id);

			$data['sale'] = $sale;
			$data['installments'] = $this->booking_model->getInstallments($sale_id);
			$data['adv_installments'] = $this->booking_model->getAdvInstallments($sale_id);
			$data['total_paid'] = $this->booking_model->getTotalPaidBySaleId($sale_id);
			$data['total_adv_paid'] = $this->booking_model->getTotalAdvPaidBySaleId($sale_id);
			$data['installmentsData'] = $this->booking_model->getInstallmentDataBySaleId($sale_id);
		}
		$this->pdf->loadHtml($this->load->view('mpdf',$data, TRUE));
		$this->pdf->render();
		$this->pdf->stream("Customer_booking_".$sale_id.".pdf", array("Attachment"=>0));
	}

    public function get_installment_data() {
        $sale_id = $this->uri->segment(4);
        $data = array();
        $jqx_data = $this->common->get_jqx_data_by_where($_GET, 'property_id', 'instalments.*', 'instalments','sale_id',$sale_id);
        $returnData = null;
        if ($jqx_data) {
            $delete = '';
            foreach ($jqx_data['resultData'] as $row) {
              
                if($row['installment_status']=='Pending'){
                    $action = '<a  class="edit" title="Edit User" href="'.base_url().'admin/instalments/create/'.$row['instalment_id'].'">Receive</a>';
                }else{
                    $action = '<a  class="edit" title="Edit User" href="javascript:void(0);">Received</a>';
                }
                
                $returnData[] = array(
                    'instalment_date' => date('d-m-Y',strtotime($row['instalment_date'])),
                    'customer_name' => $row['customer_name'],
                    'property_number' => $row['property_number'],
                    'amount_type' => 'Installment',
                    'installment_status' => $row['installment_status'],
                    'total_amount' => number_format($row['total_amount'],2),
                    'actions' => $action
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
