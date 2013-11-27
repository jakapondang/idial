<?php
class Category_model extends CI_Model {

    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function getParentCategory($table,$edit="") {
        $query = $this->db->query("SELECT cat_id,name FROM $table WHERE parent_id='0' AND status='1' $edit ORDER BY created DESC");
        $query_result =  $query->result_array();
        return $query_result;

    }
    function getValueCategory($table,$id){
        $query = $this->db->query("SELECT * FROM $table WHERE cat_id='$id' ");
        $query_result =  $query->result();
        return $query_result;

    }

   
}