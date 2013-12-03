<?php
class Subscriber_model extends CI_Model {
   
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function dataSubscriber() {
        $query = $this->db->query("SELECT id,contact_person AS cp , code AS cd , created AS dt FROM subscriber_cs ORDER BY created");
        $query_result =  $query->result_array();
		 return $query_result;
       
    }
	
	function getSlideShow_Thumb() {
        $qry = "SELECT * FROM `myg_home-slideshow` WHERE `category`='thumb' AND status='1'";
                
         return ($this->db->query($qry));
    }

    function insert_data_cs($data) {
        $this->db->insert("subscriber_cs", $data);
    }
    
   
}