<?php
class News_model extends CI_Model {
   
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getRowPage(){
        $table ="jp_page";

        $query_result ="";
        $query = $this->db->query(
            "SELECT * FROM ".$table."  WHERE status = '1'  ORDER BY updated ");

        $query_result = $query->num_rows;
        return $query_result;
    }
    function getPage(){
        $table ="jp_page";

        $query_result ="";
        $query = $this->db->query("SELECT * FROM ".$table."  WHERE status = '1' ");
            //"SELECT * FROM ".$table."  WHERE status = '1'  LIMIT ".$limit);
        if($query->num_rows()>0){

            $query_result =   $query->result();
         }


        return $query_result;
    }

    function getPageMeta($id){
        $table ="jp_pagemeta";

        $query_result ="";
        $query = $this->db->query(
            "SELECT * FROM ".$table."  WHERE pag_id = '".$id."' ");
        if($query->num_rows()>0){
            foreach( $query->result() AS $row){
                $query_result[$row->meta_key] = $row->meta_value;
            }



        }
        return $query_result;
    }



   
}