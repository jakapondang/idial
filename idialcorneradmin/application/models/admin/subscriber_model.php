<?php
class Subscriber_model extends CI_Model {
   
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function cekSubscriber($table,$id,$value) {
        $query = $this->db->query("SELECT * FROM ".$table." WHERE ".$id."='".$value."'");
        $query_result =  $query->num_rows();
		 return $query_result;
       
    }
	

    
   
}