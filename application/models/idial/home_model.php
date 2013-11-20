<?php
class Home_model extends CI_Model {
   
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
   /* function cekSubscribe($value,$column) {
        $qry = "SELECT * FROM `subscriber_cs` WHERE `$column`='$value'";
         $query =  $this->db->query($qry);
		 return $query->num_rows();
       
    }
	
	function getSlideShow_Thumb() {
        $qry = "SELECT * FROM `myg_home-slideshow` WHERE `category`='thumb' AND status='1'";
                
         return ($this->db->query($qry));
    }

    function insert_data_cs($data) {
        $this->db->insert("subscriber_cs", $data);
    }*/
    
   
}