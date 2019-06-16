<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array();
        
        //Fetch Roles
        $where = array('role_status'=>'Active');
        $data['roles'] = $this->common->fetch_where('role_id,role_name','roles',$where);
        
        $data['title'] = "Users";
        $data['content'] = "admin/users";
        $this->load->view(ADMIN_BODY,$data);
    }
    public function save() {
        $data = array();
        $post_data['first_name']        = $this->input->post('first_name');
        $post_data['last_name']         = $this->input->post('last_name');
        $post_data['user_email']        = $this->input->post('user_email');
        $post_data['password']          = md5($this->input->post('password'));
        $post_data['role_id']           = $this->input->post('role_id');
        $post_data['status']            = $this->input->post('status');
        
         if($this->common->save('users', $post_data)){
             echo 'saved';
         }else{
             echo 'not_saved';
         }
    }
    public function delete() {
        $data = array();
        $where = array('user_id'=>$this->input->post('id'));
         if($this->common->delete('users', $where)){
             echo 'deleted';
         }else{
             echo 'not_found';
         }
    }
    public function update() {
        $data = array();
        $post_data['first_name']        = $this->input->post('first_name');
        $post_data['last_name']         = $this->input->post('last_name');
        $post_data['user_email']        = $this->input->post('user_email');
        $post_data['role_id']           = $this->input->post('role_id');
        $post_data['status']            = $this->input->post('status');
        $where = array('user_id'=>$this->input->post('id'));
         if($this->common->update('users', $post_data,$where)){
             echo 'saved';
         }else{
             echo 'not_saved';
         }
    }
    public function updatePassword() {
        $data = array();
        $post_data['password']        = md5($this->input->post('password'));
        $where = array('user_id'=>$this->input->post('id'));
         if($this->common->update('users', $post_data,$where)){
             echo 'saved';
         }else{
             echo 'not_saved';
         }
    }
    public function get_data() {
        $data = array();
       $jqx_data = $this->common->get_jqx_data($_GET,'user_id','users.*','users');
       $returnData = null;
       if($jqx_data){
           $delete = '';
           foreach ($jqx_data['resultData'] as $row){
               if($row['user_id']!=1){
                   $delete = '<a data-toggle="modal" class="delete" title="Delete User" href="#delete-modal-form" onClick="return setId('.$row['user_id'].');"><i class="fa fa-times"></i></a>';
               }
           $returnData[] = array(
            'user_id'       => $row['user_id'],
            'user_email'    => $row['user_email'],
            'first_name'    => $row['first_name'],
            'last_name'     => $row['last_name'],
            'role_id'       => $row['role_id'],
            'status'        => $row['status'],
            'actions'       => '<a data-toggle="modal" class="edit" title="Edit User" href="#edit-modal-form" onClick="return getRecord('.$row['user_id'].');"><i class="fa fa-edit"></i></a> <a data-toggle="modal" class="edit" title="Update Passsword" href="#password-modal-form" onClick="return getRecord('.$row['user_id'].');"><i class="fa fa-key"></i></a> '.$delete.' '
          );
        }
        $data[] = array(
           'TotalRows' => $jqx_data['total_rows'],
	   'Rows' => $returnData
	);
        $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($data));
       }else{
           $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($data));
       }
    }
    
    public function getRecord() {
        $data = array();
        $where = array('user_id'=>$this->input->post('id'));
        $user = $this->common->fetch_row('first_name,last_name,user_email,role_id,status','users',$where);
         if($user){
             $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($user));
         }else{
             echo 'not_found';
         }
    }
    public function checkEmail() {
        $data = array();
        $where = array('user_email'=>$this->input->post('user_email'));
        $user = $this->common->fetch_row('first_name,last_name,user_email,role_id,status','users',$where);
         if($user){
             echo 'found';
         }else{
             echo 'not_found';
         }
    }
    public function checkEditEmail() {
        $data = array();
        $where = array('user_email'=>$this->input->post('user_email'),'user_id !='=>$this->input->post('id'));
        $user = $this->common->fetch_row('first_name,last_name,user_email,role_id,status','users',$where);
         if($user){
             echo 'found';
         }else{
             echo 'not_found';
         }
    }

}
