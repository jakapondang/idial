<?php
class Pages_model extends CI_Model {
   
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getPage($limit){
        $table ="jp_page";

        $query_result ="";
        $query = $this->db->query(
            "SELECT * FROM ".$table."  WHERE status = '1'  LIMIT ".$limit);
        if($query->num_rows()>0){

            foreach( $query->result()AS $row){
                $query_result[]= $row->pag_id;
            }
        }

        return $query_result;
    }

    function getPageMeta($id){
        $table ="jp_pagemeta";

        $query_result ="";
        $query = $this->db->query(
            "SELECT * FROM ".$table."  WHERE pag_id = '".$id."' ");
        if($query->num_rows()>0){
            $query_result = $query->result();



        }
        return $query_result;
    }




}
