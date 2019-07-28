<?php

class Permission_model extends CI_Model {

    function fetch(){
        $query = $this->db->query("SELECT p.*,rp.permission_status FROM permissions p 
LEFT JOIN role_permission rp ON p.permission_id=rp.permission_id ORDER BY p.permission_id ASC");
        return $query->result();
    }
}

?>