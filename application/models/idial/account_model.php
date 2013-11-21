<?php
class Account_model extends CI_Model {
   
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function cekRowTable($table,$column,$value) {
        $qry = "SELECT * FROM jp_users WHERE $column='$value'";
        $query =  $this->db->query($qry);
        return $query->num_rows();


    }
    
   
}