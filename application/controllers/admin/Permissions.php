<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('permission_model');
    }

    public function set() {
        $data = array();
        
        //Fetch Roles
        $data['permissions'] = $this->permission_model->fetch();
        
        $data['title'] = "Permisson";
        $data['content'] = "admin/permissions/permissions";
        $this->load->view(ADMIN_BODY,$data);
    }

    public function update() {
        $data = array();
        $post_data['role_id']       = $this->input->post('role_id');
        $post_data['permission_id'] = $this->input->post('permission_id');
        $post_data['permission_status']    = $this->input->post('permission');
        
        $where = array('role_id'=>$this->input->post('role_id'),'permission_id'=>$this->input->post('permission_id'));
        $permission = $this->common->fetch_row('permission_status', 'role_permission', $where);
        if($permission){
            if($this->common->update('role_permission', $post_data,$where)){
                echo 'saved';
            }else{
                echo 'not_saved';
            }
        }else{
            if($this->common->save('role_permission', $post_data)){
                echo 'saved';
            }else{
                echo 'not_saved';
            }
        }
        
        
    }
    public function denied() {
        $data = array();
        
        $data['title'] = "Access Denied";
        $data['content'] = "admin/permissions/denied";
        $this->load->view(ADMIN_BODY,$data);
    }
   

}
