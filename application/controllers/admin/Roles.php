<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array();

        $data['title'] = "Roles List";
        $data['content'] = "admin/roles";
        $this->load->view(ADMIN_BODY, $data);
    }
    public function save() {
        $data = array();
        $post_data['role_name']         = $this->input->post('role_name');
        $post_data['role']          = str_replace(" ","_",$this->input->post('role_name'));
        $post_data['role_status']              = $this->input->post('role_status');
        
         if($this->common->save('roles', $post_data)){
             echo 'saved';
         }else{
             echo 'not_saved';
         }
    }

    public function delete() {
        $data = array();
        $where = array('role_id' => $this->input->post('id'));
        $user = $this->common->fetch_row('role_id','users',$where);
        if($user){
            echo 'used';
        }else{
            $where = array('role_id' => $this->input->post('id'));
            if ($this->common->delete('roles', $where)) {
                echo 'deleted';
            } else {
                echo 'not_found';
            }
        }
    }

    public function update() {
        $data = array();
        $post_data['role_name']         = $this->input->post('role_name');
        $post_data['role']          = strtolower(str_replace(" ","_",$this->input->post('role_name')));
        $post_data['role_status']              = $this->input->post('role_status');
        $where = array('role_id'=>$this->input->post('id'));
         if($this->common->update('roles', $post_data,$where)){
             echo 'saved';
         }else{
             echo 'not_saved';
         }
    }

    public function get_data() {
        $data = array();
        $jqx_data = $this->common->get_jqx_data($_GET, 'role_id', 'roles.*', 'roles');
        $returnData = array();
        if ($jqx_data) {
            $delete = '';
            foreach ($jqx_data['resultData'] as $row) {
              $permission = '';
              
              if($row['role_id']!=1){
                  $permission = '<a data-toggle="modal" class="edit" title="Update Permissions" href="'.base_url().'admin/permissions/set/'.$row['role_id'].'" ><i class="fa fa-key"></i></a>';
              }
                $returnData[] = array(
                    'role_id' => $row['role_id'],
                    'role_name' => $row['role_name'],
                    'role_status' => $row['role_status'],
                    
                    'actions' => '<a data-toggle="modal" class="edit" title="Edit Role" href="#edit-modal-form" onClick="return getRecord('.$row['role_id'].');"><i class="fa fa-edit"></i></a> '.$permission.' <a data-toggle="modal" class="delete" title="Delete Role" href="#delete-modal-form" onClick="return setId('.$row['role_id'].');"><i class="fa fa-times"></i></a> '
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
        $where = array('role_id' => $this->input->post('id'));
        $user = $this->common->fetch_row(false, 'roles', $where);
        if ($user) {
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($user));
        } else {
            echo 'not_found';
        }
    }

}
