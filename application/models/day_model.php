<?php

class Day_model extends CI_Model {

    function getDay($day_id){
        $query = $this->db->query("SELECT d.*,u.first_name,u.last_name
                FROM dayopenclose d, users u
                WHERE d.user_id=u.user_id AND d.day_id=$day_id");
        return $query->row();
    }
    function getDayDetails($day_id){
        $query = $this->db->query("SELECT l.*,u.first_name,u.last_name,c.customer_first_name,c.customer_last_name
            FROM `ledger` l, users u,customers c
            WHERE l.user_id=u.user_id AND l.customer_id=c.customer_id
            AND l.day_id=$day_id");
        return $query->result();
    }
    public function getInstalmentDetails($vocher_type,$vocher_number) {
       if($vocher_type=='advance'){
           $query = $this->db->query("SELECT c.customer_first_name fname,c.customer_last_name lname,i.instalment_description des,i.slip_number "
                   . "FROM adv_instalments i,customers c,sale s "
                   . "WHERE i.sale_id=s.sale_id AND s.customer_id=c.customer_id AND i.instalment_number='$vocher_number'");
        return $query->row();
       }else if($vocher_type=='instalment'){
           $query = $this->db->query("SELECT i.instalment_description des,i.slip_number,c.customer_first_name fname,customer_last_name lname
FROM instalments i,customers c WHERE i.instalment_number='$vocher_number'");
        return $query->row();
       }else if($vocher_type=='vender'){
           $query = $this->db->query("SELECT p.description des,p.slip_number,v.vender_first_name fname,v.vender_last_name lname "
                   . "FROM payments p, venders v WHERE p.vender_id=v.vender_id AND p.vocher_number='$vocher_number'");
        return $query->row();
       }
    }
    function getDayAmount($day_id,$type){
        $query = $this->db->query("SELECT SUM(amount) total_amount FROM ledger WHERE day_id=$day_id AND type='$type'");
        return $query->row();
    }
    function getDayCloseCash(){
        $query = $this->db->query("SELECT day_close_amount FROM `dayopenclose` ORDER BY day_id DESC Limit 1");
        return $query->row();
    }
    function getVenderReport($vender_id,$from_date,$to_date){
        if($from_date!="" && $to_date==""){
            $where = "WHERE l.date_created BETWEEN '".$from_date."' AND NOW()";
        }
        else if($to_date!="" && $from_date==""){
            $where = "WHERE l.date_created <= '".$to_date."'";
        }else if($to_date=="" && $from_date==""){
            $where = "WHERE l.date_created <= NOW()";
        }else if($to_date!="" && $from_date!=""){
            $where = "WHERE l.date_created BETWEEN '".$from_date."' AND '".$to_date."'";
        }
        $query = $this->db->query("SELECT l.*,v.vender_first_name,v.vender_last_name,p.slip_number,p.r_p_number,p.description FROM `ledger` l 
LEFT JOIN venders v ON v.vender_id=l.customer_id
LEFT JOIN payments p ON p.vocher_number=l.vocher_number $where AND l.customer_type='vender' AND l.customer_id=$vender_id");
        return $query->result();
    }
    function getCustomerAdvReport($customer_id,$from_date,$to_date,$property_id){
        if($from_date!="" && $to_date==""){
            $where = "WHERE l.date_created BETWEEN '".$from_date."' AND NOW()";
        }
        else if($to_date!="" && $from_date==""){
            $where = "WHERE l.date_created <= '".$to_date."'";
        }
        else if($to_date=="" && $from_date==""){
            $where = "WHERE l.date_created <= NOW()";
        }else if($to_date!="" && $from_date!=""){
            $where = "WHERE l.date_created BETWEEN '".$from_date."' AND '".$to_date."'";
        }
        $query = $this->db->query("SELECT l.*,c.customer_first_name,customer_last_name,adv.slip_number,adv.instalment_description FROM `ledger` l 
LEFT JOIN adv_instalments adv ON adv.instalment_number=l.vocher_number
LEFT JOIN customers c ON c.customer_id=l.customer_id
$where AND l.customer_type='customer' and vocher_type='advance' AND adv.property_id=$property_id AND l.customer_id=$customer_id");
        return $query->result();
    }
    function getCustomerInstalmentsReport($customer_id,$from_date,$to_date,$property_id){
        if($from_date!="" && $to_date==""){
            $where = "WHERE l.date_created BETWEEN '".$from_date."' AND NOW()";
        }
        else if($to_date!="" && $from_date==""){
            $where = "WHERE l.date_created <= '".$to_date."'";
        }
        else if($to_date=="" && $from_date==""){
            $where = "WHERE l.date_created <= NOW()";
        }else if($to_date!="" && $from_date!=""){
            $where = "WHERE l.date_created BETWEEN '".$from_date."' AND '".$to_date."'";
        }
        $query = $this->db->query("SELECT l.*,c.customer_first_name,customer_last_name,ins.slip_number,ins.instalment_description FROM `ledger` l 
LEFT JOIN instalments ins ON l.vocher_number=ins.instalment_number
LEFT JOIN customers c ON c.customer_id=l.customer_id
$where AND l.customer_type='customer' and l.vocher_type='instalment' AND ins.property_id=$property_id AND l.customer_id=$customer_id");
        return $query->result();
    }
}

?>