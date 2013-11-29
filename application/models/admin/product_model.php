<?php
class Brand_model extends CI_Model {

    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function getValueBrand($table,$id){
        $query = $this->db->query("SELECT * FROM ".$table." WHERE bra_id='$id' ");
        $query_result =  $query->result();
        return $query_result;

    }
   
}