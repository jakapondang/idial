<?php
class Product_model extends CI_Model {

    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function getValueImage($table,$id){
        $query = $this->db->query("SELECT * FROM ".$table." WHERE pro_id = $id AND meta_key LIKE 'imgName%' ");
        $query_result =  $query->result();
        return $query_result;

    }
   
}