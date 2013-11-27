
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cor3_model {

    function Cor3_model(){
        $this->CI =& get_instance();
        $this->CI->load->database();

    }

    public function insertValue($table,$data){

        $this->CI->db->insert($table, $data);
        return ($this->CI->db->affected_rows() != 1) ? false : true;
    }

    public function updateValue($table, $data, $dataWhere){

        $this->CI->db->update($table, $data, $dataWhere);
        return ($this->CI->db->affected_rows() != 1) ? false : true;
    }

    public function deleteValue($table, $dataWhere){

        $this->CI->db->delete($table, $dataWhere);

    }

}

