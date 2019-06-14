<?php

class Booking_model extends CI_Model {

    function getSaleDetails($sale_id){
        $query = $this->db->query("SELECT * FROM sale s,customers c,nominee n,property p "
                . "WHERE c.customer_id=s.customer_id "
                . "AND s.property_id=p.property_id "
                . "AND p.property_id=n.property_id "
                . "AND s.sale_id=$sale_id");
        return $query->row();
    }
    function getInstallments($sale_id){
        $query = $this->db->query("SELECT * FROM instalments WHERE sale_id=$sale_id");
        return $query->result();
    }
    function getInstallmentDetail($installment_id){
        $query = $this->db->query("SELECT * FROM instalments i,customers c,property p "
                . "WHERE i.property_id=p.property_id "
                . "AND i.customer_id=c.customer_id "
                . "AND i.instalment_id=$installment_id");
        return $query->row();
    }
    function getAdvInstallments($sale_id){
        $query = $this->db->query("SELECT * FROM adv_instalments WHERE sale_id=$sale_id");
        return $query->result();
    }
    function getAdvInstallmentById($adv_id){
        $query = $this->db->query("SELECT * FROM adv_instalments a, sale s, customers c,property p WHERE a.sale_id=s.sale_id AND s.property_id=p.property_id AND s.customer_id=c.customer_id AND a.adv_id=$adv_id");
        return $query->row();
    }
    function getTotalPaidBySaleId($sale_id){
        $query = $this->db->query("SELECT IFNULL(SUM(instalment_amount),0) total_paid FROM instalments "
                . "WHERE installment_status='Paid' "
                . "AND sale_id=$sale_id");
        return $query->row();
    }
    function getTotalAdvPaidBySaleId($sale_id){
        $query = $this->db->query("SELECT IFNULL(SUM(adv_paid_amount),0) total_adv_paid "
                . "FROM adv_instalments "
                . "WHERE adv_status='Paid' AND sale_id=$sale_id");
        return $query->row();
    }
}

?>