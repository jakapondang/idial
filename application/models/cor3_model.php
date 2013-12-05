<?php
class Cor3_model extends CI_Model {


    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function insertValue($table,$data){
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

    function updateValue($table, $data, $dataWhere){

        $this->db->update($table, $data, $dataWhere);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function deleteValue($table, $dataWhere){

        $this->db->delete($table, $dataWhere);

    }

    function getNumberRow($table,$ids,$col,$id){
        $query = $this->db->query("SELECT ".$ids." FROM ".$table." WHERE ".$col."='$id' ");
        return $query->num_rows();
    }

    function GetNumber_Row ($table,$data){

        $query = $this->db->get_where($table,$data);

        $returnRow = $query->num_rows();

        return $returnRow;
    }
    function getSQLvalue_where($table,$data,$get){

        $query = $this->db->get_where($table,$data);
        $returnValue = "";
        if ($query->num_rows() > 0)
        {
            $row = $query->row();

            $returnValue =  $row->$get;
        }

        return $returnValue;
    }


    function getMainMenu($table,$where="")
    {
        $query = $this->db->query('SELECT cat_id,parent_id AS pid,name,uri_name FROM '.$table.' WHERE status="1" '.$where );

        $Value = "";
        if ($query->num_rows() > 0)
        {
            $Value = $query->result();
        }
        return $Value;
    }

    function getMAinMenu2($table,$where){
        $query = $this->db->query('SELECT cat_id,parent_id AS pid,name,uri_name FROM '.$table.' WHERE status="1" '.$where );

        $Value['name'] = array();
        $Value['id'] = array();
        $Value['uri_name'] = array();
        if ($query->num_rows() > 0)
        {
            foreach($query->result() as $row){
                $Value['name'][]  = $row->name;
                $Value['id'][] = $row->cat_id;
                $Value['uri_name'][] = $row->uri_name;
            }
        }
        return $Value;

    }


}