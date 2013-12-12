<?php
class Product_model extends CI_Model {

    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function getValueImage($table,$iColumn,$id){
        $query = $this->db->query("SELECT * FROM ".$table." WHERE $iColumn = '$id' AND meta_key LIKE 'imgName%' ");
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
    function getCategory() {
        $query = $this->db->query("SELECT A.cat_id AS catid,B.name AS nameP ,A.name AS nameC FROM jp_category A INNER JOIN jp_category B ON A.parent_id=B.cat_id  WHERE A.status='1' AND A.parent_id!='0'  ORDER BY A.created DESC");
        $query_result =  $query->result_array();
        return $query_result;

    }
    function getCategory2() {
        $query = $this->db->query("SELECT cat_id AS catid,name AS nameP ,parent_id AS parid FROM jp_category  WHERE status='1' ORDER BY created");
        $query_result =  $query->result_array();
        return $query_result;

    }
    function getCategoryALL(){
        $query = $this->db->query("SELECT cat_id AS catid,name AS nameP  FROM jp_category  WHERE status='1' AND parent_id='0' ORDER BY created");
        $query_result =  $query->result();
        $result="";
        foreach($query_result AS $row){
            $result[$row->catid] = $row->nameP;
        }
        return $result;

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