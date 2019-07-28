<?php 

/**
 * Access Helper
 * 
 * This helper contains the functions relating to Access.
 */

function get_role_access($role_id,$permission_id) {
    if($role_id==1){
        return true;
    }
    $CI =& get_instance();
    $permission = $CI->common->fetch_row('permission_status','role_permission',array('permission_id'=>$permission_id,'role_id'=>$role_id));
    if($permission) {
    if($permission->permission_status=="Allow"){
        return true;
    }else{
        return false;
    }
    }else{
        return false;
    }
}
function check_access($role_id,$permission_id) {
    if($role_id==1){
        return true;
    }
    $CI =& get_instance();
    $permission = $CI->common->fetch_row('permission_status','role_permission',array('permission_id'=>$permission_id,'role_id'=>$role_id));
    if($permission) {
    if($permission->permission_status=="Allow"){
        return true;
    }else{
        redirect(base_url() . 'admin/permissions/denied');
    }
    }else{
        redirect(base_url() . 'admin/permissions/denied');
    }
}
?>