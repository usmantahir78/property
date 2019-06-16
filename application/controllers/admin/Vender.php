<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vender extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array();

        $data['title'] = "Vender List";
        $data['content'] = "admin/venders";
        $this->load->view(ADMIN_BODY, $data);
    }
    public function save() {
        $data = array();
        $post_data['vender_first_name']         = $this->input->post('vender_first_name');
        $post_data['vender_last_name']          = $this->input->post('vender_last_name');
        $post_data['vender_email']              = $this->input->post('vender_email');
        $post_data['vender_phone']              = $this->input->post('vender_phone');
        $post_data['vender_identity']           = $this->input->post('vender_identity');
        $post_data['vender_address']            = $this->input->post('vender_address');
        $post_data['vender_status']             = $this->input->post('vender_status');
        
         if($this->common->save('venders', $post_data)){
             echo 'saved';
         }else{
             echo 'not_saved';
         }
    }

    public function delete() {
        $data = array();
        $where = array('vender_id' => $this->input->post('id'));
        $vender = $this->common->fetch_row('vender_id','payments',$where);
        if($vender){
            echo 'used';
        }else{
            $where = array('vender_id' => $this->input->post('id'));
            if ($this->common->delete('venders', $where)) {
                echo 'deleted';
            } else {
                echo 'not_found';
            }
        }
    }

    public function update() {
        $data = array();
        $post_data['vender_first_name']         = $this->input->post('vender_first_name');
        $post_data['vender_last_name']          = $this->input->post('vender_last_name');
        $post_data['vender_email']              = $this->input->post('vender_email');
        $post_data['vender_phone']              = $this->input->post('vender_phone');
        $post_data['vender_identity']           = $this->input->post('vender_identity');
        $post_data['vender_address']            = $this->input->post('vender_address');
        $post_data['vender_status']             = $this->input->post('vender_status');
        $where = array('vender_id'=>$this->input->post('id'));
         if($this->common->update('venders', $post_data,$where)){
             echo 'saved';
         }else{
             echo 'not_saved';
         }
    }

    public function get_data() {
        $data = array();
        $jqx_data = $this->common->get_jqx_data($_GET, 'vender_id', 'venders.*', 'venders');
        $returnData = null;
        if ($jqx_data) {
            $delete = '';
            foreach ($jqx_data['resultData'] as $row) {
              
                $returnData[] = array(
                    'vender_id' => $row['vender_id'],
                    'vender_name' => $row['vender_first_name'].' '.$row['vender_last_name'],
                    'vender_identity' => $row['vender_identity'],
                    'vender_phone' => $row['vender_phone'],
                    'vender_email' => $row['vender_email'],
                    'vender_address' => $row['vender_address'],
                    'vender_status' => $row['vender_status'],
                    
                    'actions' => '<a data-toggle="modal" class="edit" title="Edit Vender" href="#edit-modal-form" onClick="return getRecord('.$row['vender_id'].');"><i class="fa fa-edit"></i></a> <a data-toggle="modal" class="delete" title="Delete User" href="#delete-modal-form" onClick="return setId('.$row['vender_id'].');"><i class="fa fa-times"></i></a> '
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
        $where = array('vender_id' => $this->input->post('id'));
        $user = $this->common->fetch_row(false, 'venders', $where);
        if ($user) {
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($user));
        } else {
            echo 'not_found';
        }
    }

}
