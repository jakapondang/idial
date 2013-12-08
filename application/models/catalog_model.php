<?php
class Catalog_model extends CI_Model {
   
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getBrandValue($table1,$table2){
        $query = $this->db->query(
            "SELECT B.meta_value AS imgName,A.name AS nameB FROM $table1 A INNER JOIN $table2 B ON A.bra_id = B.bra_id  WHERE B.meta_key='imgName' AND A.status='1' ORDER BY created DESC");
        $query_result =  $query->result();
        return $query_result;

    }
    function getCategoryLValue($table1,$value){
        $query = $this->db->query(
            "SELECT name FROM $table1 WHERE cat_id = '".$value."'");
       foreach($query->result() as $row){
          $name =  $row->name;
       }
        return $name;

    }
    function getProductALLValue($table1,$table2,$table3,$value){
        $query = $this->db->query(
            "SELECT A.pro_id AS proid, A.name AS title ,B.meta_value AS imgName ,C.gross AS price   FROM $table1 A
                INNER JOIN $table2 B ON A.pro_id = B.pro_id
                INNER JOIN $table3 C ON A.pro_id = C.pro_id
            WHERE B.meta_key='imgName1' AND A.status='1' AND A.cat_id = '".$value."' ORDER BY created DESC LIMIT 0,4 ");
        $query_result =  $query->result();
        return $query_result;

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