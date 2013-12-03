<?php
class Product_model extends CI_Model {

    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function getValueImage($table,$id){
        $query = $this->db->query("SELECT * FROM ".$table." WHERE pro_id = $id AND meta_key LIKE 'imgName%' ");
        $query_result =  $query->result();
        return $query_result;

    }

    function getValue($table,$column,$id){
        $query = $this->db->query("SELECT * FROM ".$table." WHERE $column='$id' ");
        $query_result =  $query->result();
        return $query_result;

    }
    function getBrand() {
        $query = $this->db->query("SELECT bra_id AS braid,name AS nameB FROM jp_brand WHERE status='1'  ORDER BY created DESC");
        $query_result =  $query->result_array();
        return $query_result;

    }
    function getValueMeta($table,$id,$metaKey){
        $query = $this->db->query("SELECT * FROM ".$table." WHERE pro_id = $id AND meta_key = '$metaKey' ");
        $query_result =  $query->result();
        return $query_result;

    }

    function cekGetValue ($table,$data,$get){

        $query = $this->db->get_where($table,$data);
        $returnValue = "";
        if ($query->num_rows() > 0)
        {
            $row = $query->row();

            $returnValue =  $row->$get;
        }

        return $returnValue;
    }
}