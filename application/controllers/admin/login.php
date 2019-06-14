<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
            if(isset($_SESSION['user_id'])){
                redirect(base_url().'admin/dashboard');
            }
		$this->load->view('admin/login');
	}
        public function auth()
	{
            $email      = $this->input->post('email');
            $password   = md5($this->input->post('password'));
            $where = array('user_email'=>$email,'password'=>$password);
            $login = $this->common->fetch_row('*','users',$where);
            if($login){
               if($login->status=='Active'){
                   $userdata = array(
                    'user_id' => $login->user_id,
                    'user_email' => $login->user_email,
                    'first_name' => $login->first_name,
                    'last_name' => $login->last_name,
                    'role_id' => $login->role_id,
                    'status' => $login->status
                );

                $this->session->set_userdata($userdata);
                $where = array('user_id'=>$login->user_id,'day_status'=>'open');
                $day = $this->common->fetch_row('*','dayopenclose',$where);
                if($day){
                    $day = array( 'day_id' => $day->day_id,'day_status' => 'open' );
                    $this->session->set_userdata($day);
                }
                echo 'authrized';
                }else if($login->status=='Inactive'){
                    echo 'Inactive';
                } 
            } else{
                echo 'not_found';
            }
            
		//$this->load->view('admin/login');
	}
        public function logout()
	{
            $userdata = array(
                    'user_id',
                    'user_email',
                    'first_name',
                    'last_name',
                    'role_id',
                    'status'
                );
            $this->session->unset_userdata($userdata);
            redirect(base_url().'admin/login');
	}
}
