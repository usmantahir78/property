<?php

class Common extends CI_Model {

    public function fetch($fields = FALSE, $table) {
        if ($fields == FALSE) {
            $fields = '*';
        }
        $this->db->select($fields);
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_where($fields = FALSE, $table, $where) {
        if ($fields == FALSE) {
            $fields = '*';
        }
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_row($fields = FALSE, $table, $where) {
        if ($fields == FALSE) {
            $fields = '*';
        }
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function save($table, $data) {
        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();
        if($insert_id){
            return $insert_id;
        
        }else{
            return false;
            
        }
        
    }

    public function update($table, $data, $where) {
        $this->db->where($where);
        if($this->db->update($table, $data)){
            return true;
        }else{
            return false;
        }
    }

    public function delete($table, $where) {
        $this->db->where($where);
        if($this->db->delete($table)){
            return true;
        }else{
            return false;
        }
    }
    
     public function get_jqx_data($GET,$id,$fields,$table){

        $defaultsortdatafield = (empty($GET['sortdatafield']) &&$GET['sortdatafield'] == ""?$id:$GET['sortdatafield']);
        $defaultsortorder = (empty($GET['sortorder']) && $GET['sortorder'] == "" ?"DESC":$GET['sortorder']);
        $pagenum = $GET['pagenum'];
	$pagesize = $GET['pagesize'];
	$start = $pagenum * $pagesize;
        $query_select = $fields;
        $query_table = $table;
        $query = "SELECT SQL_CALC_FOUND_ROWS $query_select FROM $query_table ORDER BY" . " " . $defaultsortdatafield . " $defaultsortorder LIMIT $start, $pagesize";
        $result = $this->db->query($query) or die("SQL Error 1: " . mysql_error());
	$sql = "SELECT FOUND_ROWS() AS `found_rows`;";
	$rows = $this->db->query($sql);
	$rows = $rows->row();
	$total_rows = $rows->found_rows;
        
	$filterquery = "";
        // filter Query data.
        if(isset($GET['filterscount'])){
           $filterscount = $GET['filterscount'];
            if ($filterscount > 0){
                $where = " WHERE (";
                $tmpdatafield = "";
                $tmpfilteroperator = "";
                for($i=0; $i < $filterscount; $i++){
                    $filtervalue = $GET["filtervalue" . $i];          // get the filter's value.
                    $filtercondition = $GET["filtercondition" . $i];    // get the filter's condition.
                    $filterdatafield = $GET["filterdatafield" . $i];    // get the filter's column.
                    $filteroperator = $GET["filteroperator" . $i];      // get the filter's operator.
                    if($tmpdatafield == ""){
                        $tmpdatafield = $filterdatafield;			
                    }else if($tmpdatafield <> $filterdatafield){
                        $where .= ")AND(";
                    }else if ($tmpdatafield == $filterdatafield){
                        if ($tmpfilteroperator == 0)$where .= " AND ";
                        else $where .= " OR ";	
                    }
                    switch($filtercondition){
                        case "NOT_EMPTY":
                        case "NOT_NULL":
                                $where .= " " . $filterdatafield . " NOT LIKE '" . "" ."'";
                                break;
                        case "EMPTY":
                        case "NULL":
                                $where .= " " . $filterdatafield . " LIKE '" . "" ."'";
                                break;
                        case "CONTAINS_CASE_SENSITIVE":
                                $where .= " BINARY  " . $filterdatafield . " LIKE '%" . $filtervalue ."%'";
                                break;
                        case "CONTAINS":
                                $where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."%'";
                                break;
                        case "DOES_NOT_CONTAIN_CASE_SENSITIVE":
                                $where .= " BINARY " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
                                break;
                        case "DOES_NOT_CONTAIN":
                                $where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
                                break;
                        case "EQUAL_CASE_SENSITIVE":
                                $where .= " BINARY " . $filterdatafield . " = '" . $filtervalue ."'";
                                break;
                        case "EQUAL":
                                $where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
                                break;
                        case "NOT_EQUAL_CASE_SENSITIVE":
                                $where .= " BINARY " . $filterdatafield . " <> '" . $filtervalue ."'";
                                break;
                        case "NOT_EQUAL":
                                $where .= " " . $filterdatafield . " <> '" . $filtervalue ."'";
                                break;
                        case "GREATER_THAN":
                                $where .= " " . $filterdatafield . " > '" . $filtervalue ."'";
                                break;
                        case "LESS_THAN":
                                $where .= " " . $filterdatafield . " < '" . $filtervalue ."'";
                                break;
                        case "GREATER_THAN_OR_EQUAL":
                              $where .= " " . $filterdatafield . " >= '" . $filtervalue ."'";
                        break;
                        case "LESS_THAN_OR_EQUAL":
                                $where .= " " . $filterdatafield . " <= '" . $filtervalue ."'";
                                break;
                        case "STARTS_WITH_CASE_SENSITIVE":
                                $where .= " BINARY " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
                                break;
                        case "STARTS_WITH":
                                $where .= " " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
                                break;
                        case "ENDS_WITH_CASE_SENSITIVE":
                                $where .= " BINARY " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
                                break;
                        case "ENDS_WITH":
                                $where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
                                break;
                    }
                    
                    if ($i == $filterscount - 1) $where .= ")";
                    $tmpfilteroperator = $filteroperator;
                    $tmpdatafield = $filterdatafield;			
		}
                // build the query.
                $query = "SELECT $query_select FROM $query_table ".$where;
                $filterquery = $query;
                $result = $this->db->query($query) or die("SQL Error 1: " . mysql_error());
                $sql = "SELECT FOUND_ROWS() AS `found_rows`;";
                $rows = $this->db->query($sql);
                $rows = $rows->row();
                $new_total_rows = $rows->found_rows;
                $query = "SELECT $query_select FROM $query_table ".$where." LIMIT $start, $pagesize";
                $total_rows = $new_total_rows;
            }
        } 
        // sorted Query data.
        if(isset($GET['sortdatafield'])){ 
            $sortfield = ($GET['sortdatafield'] == "")?"OrderNumber":$GET['sortdatafield'];
            $sortorder = ($GET['sortorder'] == "")?"desc":$GET['sortorder'];
            if($sortorder != ''){
                if ($GET['filterscount'] == 0){
                    if ($sortorder == "desc"){
                        $query = "SELECT $query_select FROM $query_table ORDER BY" . " " . $sortfield . " DESC LIMIT $start, $pagesize";
                    }else if($sortorder == "asc"){
                        $query = "SELECT $query_select FROM $query_table ORDER BY" . " " . $sortfield . " ASC LIMIT $start, $pagesize";
                    }
                }else{
                    if ($sortorder == "desc"){
                        $filterquery .= " ORDER BY" . " " . $sortfield . " DESC LIMIT $start, $pagesize";
                    }else if ($sortorder == "asc"){
                        $filterquery .= " ORDER BY" . " " . $sortfield . " ASC LIMIT $start, $pagesize";
                    }
                    $query = $filterquery;
                }		
            }
        }
       //execution of final query 
        $res = $this->db->query($query);
        $data['resultData'] = $res->result_array();
        $data['total_rows'] = $total_rows;
        return $data;
    }

    public function get_jqx_data_by_where($GET,$id,$fields,$table,$where_field,$where_value){
        $custome_where = "$where_field=$where_value";
        $defaultsortdatafield = (empty($GET['sortdatafield']) &&$GET['sortdatafield'] == ""?$id:$GET['sortdatafield']);
        $defaultsortorder = (empty($GET['sortorder']) && $GET['sortorder'] == "" ?"DESC":$GET['sortorder']);
        $pagenum = $GET['pagenum'];
	$pagesize = $GET['pagesize'];
	$start = $pagenum * $pagesize;
        $query_select = $fields;
        $query_table = $table;
        $query = "SELECT SQL_CALC_FOUND_ROWS $query_select FROM $query_table WHERE $custome_where ORDER BY" . " " . $defaultsortdatafield . " $defaultsortorder LIMIT $start, $pagesize";
        $result = $this->db->query($query) or die("SQL Error 1: " . mysql_error());
	$sql = "SELECT FOUND_ROWS() AS `found_rows`;";
	$rows = $this->db->query($sql);
	$rows = $rows->row();
	$total_rows = $rows->found_rows;
        
	$filterquery = "";
        // filter Query data.
        if(isset($GET['filterscount'])){
           $filterscount = $GET['filterscount'];
            if ($filterscount > 0){
                $where = " WHERE (";
                $tmpdatafield = "";
                $tmpfilteroperator = "";
                for($i=0; $i < $filterscount; $i++){
                    $filterdatafield = $GET["filterdatafield" . $i];    // get the filter's column.
                    if($GET["filterdatafield" . $i]=='instalment_date'){
                        $date = explode(' 00:00:00',$GET["filtervalue" . $i]);
                        if(date('Y-m-d',strtotime($date[0]))=="1970-01-01"){
                            $date = explode(' 23:59:59',$GET["filtervalue" . $i]);
                        }
                        $filtervalue = date('Y-m-d',strtotime($date[0]));
                    }else{
                        $filtervalue = $GET["filtervalue" . $i];          // get the filter's value.
                    }
                    
                    $filtercondition = $GET["filtercondition" . $i];    // get the filter's condition.
                    $filteroperator = $GET["filteroperator" . $i];      // get the filter's operator.
                    
                    if($tmpdatafield == ""){
                        $tmpdatafield = $filterdatafield;			
                    }else if($tmpdatafield <> $filterdatafield){
                        $where .= ")AND(";
                    }else if ($tmpdatafield == $filterdatafield){
                        if ($tmpfilteroperator == 0)$where .= " AND ";
                        else $where .= " OR ";	
                    }
                    switch($filtercondition){
                        case "NOT_EMPTY":
                        case "NOT_NULL":
                                $where .= " " . $filterdatafield . " NOT LIKE '" . "" ."'";
                                break;
                        case "EMPTY":
                        case "NULL":
                                $where .= " " . $filterdatafield . " LIKE '" . "" ."'";
                                break;
                        case "CONTAINS_CASE_SENSITIVE":
                                $where .= " BINARY  " . $filterdatafield . " LIKE '%" . $filtervalue ."%'";
                                break;
                        case "CONTAINS":
                                $where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."%'";
                                break;
                        case "DOES_NOT_CONTAIN_CASE_SENSITIVE":
                                $where .= " BINARY " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
                                break;
                        case "DOES_NOT_CONTAIN":
                                $where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
                                break;
                        case "EQUAL_CASE_SENSITIVE":
                                $where .= " BINARY " . $filterdatafield . " = '" . $filtervalue ."'";
                                break;
                        case "EQUAL":
                                $where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
                                break;
                        case "NOT_EQUAL_CASE_SENSITIVE":
                                $where .= " BINARY " . $filterdatafield . " <> '" . $filtervalue ."'";
                                break;
                        case "NOT_EQUAL":
                                $where .= " " . $filterdatafield . " <> '" . $filtervalue ."'";
                                break;
                        case "GREATER_THAN":
                                $where .= " " . $filterdatafield . " > '" . $filtervalue ."'";
                                break;
                        case "LESS_THAN":
                                $where .= " " . $filterdatafield . " < '" . $filtervalue ."'";
                                break;
                        case "GREATER_THAN_OR_EQUAL":
                              $where .= " " . $filterdatafield . " >= '" . $filtervalue ."'";
                        break;
                        case "LESS_THAN_OR_EQUAL":
                                $where .= " " . $filterdatafield . " <= '" . $filtervalue ."'";
                                break;
                        case "STARTS_WITH_CASE_SENSITIVE":
                                $where .= " BINARY " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
                                break;
                        case "STARTS_WITH":
                                $where .= " " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
                                break;
                        case "ENDS_WITH_CASE_SENSITIVE":
                                $where .= " BINARY " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
                                break;
                        case "ENDS_WITH":
                                $where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
                                break;
                    }
                    
                    if ($i == $filterscount - 1) $where .= ")";
                    $tmpfilteroperator = $filteroperator;
                    $tmpdatafield = $filterdatafield;			
		}
                // build the query.
                $query = "SELECT $query_select FROM $query_table ".$where." AND ".$custome_where;
                $filterquery = $query;
                $result = $this->db->query($query) or die("SQL Error 1: " . mysql_error());
                $sql = "SELECT FOUND_ROWS() AS `found_rows`;";
                $rows = $this->db->query($sql);
                $rows = $rows->row();
                $new_total_rows = $rows->found_rows;
                $query = "SELECT $query_select FROM $query_table ".$where." AND ".$custome_where." LIMIT $start, $pagesize";
                $total_rows = $new_total_rows;
                 //echo $query;
            }
        } 
        // sorted Query data.
        if(isset($GET['sortdatafield'])){ 
            $sortfield = ($GET['sortdatafield'] == "")?"OrderNumber":$GET['sortdatafield'];
            $sortorder = ($GET['sortorder'] == "")?"desc":$GET['sortorder'];
            if($sortorder != ''){
                if ($GET['filterscount'] == 0){
                    if ($sortorder == "desc"){
                        $query = "SELECT $query_select FROM $query_table ".$custome_where." ORDER BY" . " " . $sortfield . " DESC LIMIT $start, $pagesize";
                    }else if($sortorder == "asc"){
                        $query = "SELECT $query_select FROM $query_table WHERE ".$custome_where." ORDER BY" . " " . $sortfield . " ASC LIMIT $start, $pagesize";
                    }
                }else{
                    if ($sortorder == "desc"){
                        $filterquery .= " ORDER BY" . " " . $sortfield . " DESC LIMIT $start, $pagesize";
                    }else if ($sortorder == "asc"){
                        $filterquery .= " ORDER BY" . " " . $sortfield . " ASC LIMIT $start, $pagesize";
                    }
                    $query = $filterquery;
                }		
            }
        }
       //execution of final query 
       // echo $query;
        $res = $this->db->query($query);
        $data['resultData'] = $res->result_array();
        $data['total_rows'] = $total_rows;
        return $data;
    }
    public function ledgerentry($data) {
        $this->db->insert('ledger', $data);
        $insert_id = $this->db->insert_id();
        if($insert_id){
            return $insert_id;
        
        }else{
            return false;
            
        }
    }
}

?>