<?php
class Brand_model extends CI_Model {

    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function getValueTable() {
        $query = $this->db->query("SELECT * FROM $this->table ORDER BY created DESC");
        $query_result =  $query->result_array();
        return $query_result;

    }

    function cekRowTable($table) {
        $qry = "SELECT * FROM $table";
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
	
	function deleteValue($table, $dataWhere){
		
		$this->db->delete($table, $dataWhere); 
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

    function cekGetRow ($table,$data){

        $query = $this->db->get_where($table,$data);

        $returnRow = $query->num_rows();

        return $returnRow;
    }
   
}