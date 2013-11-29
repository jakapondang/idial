
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cor3_model {

    function Cor3_model(){
        $this->CI =& get_instance();
        $this->CI->load->database();

    }

    public function insertValue($table,$data){
        $returnData = array();
        $this->CI->db->insert($table, $data);
        $returnData['id'] = $this->CI->db->insert_id();

        if($this->CI->db->affected_rows() != 1){
            $returnData['qstatus']= false ;
        }else{
            $returnData['qstatus'] = true;
        }
        return $returnData;
    }

    public function updateValue($table, $data, $dataWhere){

        $this->CI->db->update($table, $data, $dataWhere);
        return ($this->CI->db->affected_rows() != 1) ? false : true;
    }

    public function deleteValue($table, $dataWhere){

        $this->CI->db->delete($table, $dataWhere);

    }

    public function getNumberRow($table,$ids,$col,$id){
        $query = $this->CI->db->query("SELECT ".$ids." FROM ".$table." WHERE ".$col."='$id' ");
        return $query->num_rows();
    }

    public function GetNumber_Row ($table,$data){

        $query = $this->CI->db->get_where($table,$data);

        $returnRow = $query->num_rows();

        return $returnRow;
    }
    function getSQLvalue_where($table,$data,$get){

        $query = $this->CI->db->get_where($table,$data);
        $returnValue = "";
        if ($query->num_rows() > 0)
        {
            $row = $query->row();

            $returnValue =  $row->$get;
        }

        return $returnValue;
    }

}

