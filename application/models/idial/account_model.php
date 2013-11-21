<?php
class Account_model extends CI_Model {
   
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function cekRowTable($table,$column,$value) {
        $qry = "SELECT * FROM $table WHERE $column='$value'";
        $query =  $this->db->query($qry);
        return $query->num_rows();


    }
    function insertValue($table,$data){

        $this->db->insert($table, $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    function updateValue($table, $data, $dataWhere){

        $this->db->update($table, $data, $dataWhere);
       return ($this->db->affected_rows() != 1) ? false : true;
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