<?php
class Search_model extends CI_Model {
   
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getSearchValue($value){
        $table1 = 'jp_product';
        $table2 = 'jp_productmeta';
        $table3 = 'jp_productprice';
        $query_result =array();
        $query = $this->db->query(
            "SELECT A.pro_id AS proid, A.name AS title ,B.meta_value AS imgName ,C.gross AS price FROM $table1 A
                INNER JOIN $table2 B ON A.pro_id = B.pro_id
                INNER JOIN $table3 C ON A.pro_id = C.pro_id
            WHERE B.meta_key='imgNametmb1' AND A.status='1' AND A.name LIKE '%".$value."%' ORDER BY updated DESC LIMIT 0,10 ");//LIMIT 0,10
        $query_result['row'] =  $query->num_rows();

        $query_result['result'] =  $query->result();
        return $query_result;

    }
    function getOtherProductValue(){
        $table1 = 'jp_product';
        $table2 = 'jp_productmeta';
        $table3 = 'jp_productprice';
        $query_result =array();
        $query = $this->db->query(
            "SELECT A.pro_id AS proid, A.name AS title ,B.meta_value AS imgName ,C.gross AS price FROM $table1 A
                INNER JOIN $table2 B ON A.pro_id = B.pro_id
                INNER JOIN $table3 C ON A.pro_id = C.pro_id
            WHERE B.meta_key='imgNametmb1' AND A.status='1' ORDER BY RAND() DESC LIMIT 0,4 ");//LIMIT 0,10
        $query_result['row'] =  $query->num_rows();

        $query_result['result'] =  $query->result();
        return $query_result;

    }


   
}
