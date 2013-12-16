<?php
class Info_model extends CI_Model {
   
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertValueSubscriber($table,$data){
        $returnData = array();
        $this->db->insert($table, $data);
        $returnData['id'] = $this->db->insert_id();

        if($this->db->affected_rows() != 1){
            $returnData['qstatus']= false ;
        }else{
            $returnData['qstatus'] = true;
        }
        return $returnData;
    }


   
}
