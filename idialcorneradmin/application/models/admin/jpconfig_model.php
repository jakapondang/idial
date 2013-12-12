<?php
class Jpconfig_model extends CI_Model {

    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function getValue($table,$column,$id){
        $query = $this->db->query("SELECT * FROM ".$table." WHERE $column='$id' ");
        $query_result =  $query->result();
        return $query_result;

    }
    function getValueConfig($table ,$dataWhere){
        $query = $this->db->query("SELECT * FROM ".$table." ".$dataWhere);
        $query_result =  $query->result();
        return $query_result;

    }


    function getCategory() {
        $query = $this->db->query("SELECT A.cat_id AS catid,B.name AS nameP ,A.name AS nameC FROM jp_category A INNER JOIN jp_category B ON A.parent_id=B.cat_id  WHERE A.status='1' AND A.parent_id!='0'  ORDER BY A.created DESC");
        $query_result =  $query->result_array();
        return $query_result;

    }
   
}