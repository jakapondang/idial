<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Cor3 {
	
	function Cor3(){
			$this->CI =& get_instance();
			$this->CI->load->database();
			$this->CI->load->helper(array('url'));
			$this->CI->load->library(array('parser'));//,'session','email'
			//$this->CI->load->model(array('general_model'));
			
	}
    public function html($themes="html",$data_inject="")
    {
		$content = "";
		
		$data = array(
				'base_url'=>base_url(),
			);
		if(!empty($data_inject)||($data_inject!="")):
			$data = $result = array_merge($data, $data_inject);
		endif;
		$content =  $this->CI->parser->parse($themes.'/head', $data, TRUE);
		
		return $content;
		//$content  =  $this->CI->parser->parse('html/html', $data, TRUE);
		//return $base_url;
		//$head = '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="id" lang="id"><head>#headcontent</head>';
    }
}
?>
