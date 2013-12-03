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
    function getValueConfig($table){
        $query = $this->db->query("SELECT * FROM ".$table."");
        $query_result =  $query->result();
        return $query_result;

    }
   
}