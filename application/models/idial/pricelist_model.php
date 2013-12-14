<?php
class Pricelist_model extends CI_Model {
   
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getCategoryName(){
        $table = "jp_category";
        $where = array(
                "status"=>'1'
        );
        $query_result ="";
        $query = $this->db->get_where($table,$where);
        if($query->num_rows()>0){

            foreach($query->result()AS $row){
                $query_result[$row->cat_id] = $row->name;
            }
        }
        return $query_result;
    }

    function getProductCategory(){
        $table ="jp_product";
        $query_result ="";
        $query = $this->db->query(
            "SELECT cat_id FROM ".$table." WHERE status = '1' GROUP BY cat_id ORDER BY updated");
        if($query->num_rows()>0){

            foreach($query->result()AS $row){
                $query_result[] = $row->cat_id;
           }
        }
        return $query_result;
    }

    function getProductList(){
        $query = $this->db->query(
            "SELECT A.pro_id AS proid,A.cat_id AS catid,A.bra_id AS braid ,A.name AS name, B.gross AS price ,B.stock AS stock FROM jp_product A
            INNER JOIN jp_productprice B ON A.pro_id = B.pro_id  WHERE A.status = '1' ORDER BY updated");

        $returnValue ="";
        if ($query->num_rows() > 0)
        {
            $returnValue = $query->result();

        }
        return $returnValue;
    }

   
}