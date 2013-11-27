<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Adminaction {
	
	function Cor3(){
			$this->CI =& get_instance();
			$this->CI->load->database();
			$this->CI->load->helper(array('url'));
			$this->CI->load->library(array('form','session'));
			//,'session','email'
			//$this->CI->load->model(array('general_model'));
			
	}
	
    public function tableList()
    {
    }
}
?>
