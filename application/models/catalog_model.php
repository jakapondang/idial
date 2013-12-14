<?php
class Catalog_model extends CI_Model {
   
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getBrandValue($table1,$table2){
        $query = $this->db->query(
            "SELECT B.meta_value AS tmbName,A.name AS nameB FROM $table1 A INNER JOIN $table2 B ON A.bra_id = B.bra_id  WHERE B.meta_key='imgNametmb' AND A.status='1' ORDER BY created DESC");
        $query_result =  $query->result();
        return $query_result;

    }
    function getCategoryLValue($table1,$value){
        $result =array();
        $query = $this->db->query(
            "SELECT parent_id,name FROM $table1 WHERE cat_id = '".$value."' AND status ='1'");
       foreach($query->result() as $row){
          $result['parid'] =  $row->parent_id;
          $result['name'] =  $row->name;
       }
        return $result;

    }

    function getCategorySValue($table1,$value){

        $query = $this->db->query(
            "SELECT parent_id,name FROM $table1 WHERE cat_id = '".$value."' AND status ='1'");
        foreach($query->result() as $row){

            $result =  $row->name;
        }
        return $result;

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

    function getCatalogValue($table1,$table2,$table3,$value){
        $query_result =array();
        $query = $this->db->query(
            "SELECT A.pro_id AS proid, A.name AS title ,B.meta_value AS imgName ,C.gross AS price FROM $table1 A
                INNER JOIN $table2 B ON A.pro_id = B.pro_id
                INNER JOIN $table3 C ON A.pro_id = C.pro_id
            WHERE B.meta_key='imgNametmb1' AND A.status='1' AND A.cat_id = '".$value."' ORDER BY created DESC LIMIT 0,10 ");
        $query_result['row'] =  $query->num_rows();

        $query_result['result'] =  $query->result();
        return $query_result;

    }
    function getAllBrandProduct($table1,$table2,$table3,$value){
        $query_result =array();
        $query = $this->db->query(
            "SELECT A.pro_id AS proid, A.name AS title ,B.meta_value AS imgName ,C.gross AS price   FROM $table1 A
                INNER JOIN $table2 B ON A.pro_id = B.pro_id
                INNER JOIN $table3 C ON A.pro_id = C.pro_id
            WHERE B.meta_key='imgNametmb1' AND A.status='1' AND A.bra_id = '".$value."' ORDER BY created DESC LIMIT 0,10 ");
        $query_result['row'] =  $query->num_rows();

        $query_result['result'] =  $query->result();
        return $query_result;

    }

    function getSingleProduct($table,$value){
        $query_result =array();
        $query = $this->db->query(
            "SELECT * FROM $table WHERE  status='1' AND pro_id = '".$value."' ");
        $query_result['row'] =  $query->num_rows();

        $query_result['result'] =  $query->result();
        return $query_result;

    }
    function getSingleProductMeta($table,$value){
        $query_result =array();
        $query = $this->db->query(
            "SELECT *  FROM $table WHERE pro_id = '".$value."' ");
        $query_result['row'] =  $query->num_rows();

        $query_result['result'] =  $query->result();
        return $query_result;

    }
    function getSingleProductprice($table,$value){
        $query_result =array();
        $query = $this->db->query(
            "SELECT *  FROM $table WHERE pro_id = '".$value."' ");
        $query_result['row'] =  $query->num_rows();

        $query_result['result'] =  $query->result();
        return $query_result;

    }

    function getSingleBrand($value){
        $query = $this->db->query(
            "SELECT B.meta_value AS imgName,A.name AS nameB FROM jp_brand A INNER JOIN jp_brandmeta B ON A.bra_id = B.bra_id  WHERE A.bra_id='".$value."' AND  A.status='1' AND B.meta_key='imgName'");
        $query_result =  $query->result();
        return $query_result;

    }

    function getRelatedProduct($bra_id,$pro_id){
        $query = $this->db->query(
            "SELECT A.pro_id AS proid , A.name AS title , A.sku AS sku , D.gross AS price , C.meta_value AS imgName FROM jp_product A
            INNER JOIN jp_brand B ON A.bra_id = B.bra_id
            LEFT JOIN jp_productmeta C ON A.pro_id = C.pro_id
            LEFT JOIN jp_productprice D ON A.pro_id = D.pro_id
            WHERE ( A.bra_id='".$bra_id."' AND A.pro_id != '".$pro_id."' AND A.status='1' AND C.meta_key LIKE 'imgNametmb%') ORDER BY RAND() LIMIT 0,4");
        $query_result['row'] =  $query->num_rows();
        if($query->num_rows()>0){
            $query_result['result'] =  $query->result();
        }
        return $query_result;

    }




   
}