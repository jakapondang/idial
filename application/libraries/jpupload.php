<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Jpupload {
	
	function Jpupload(){
			$this->CI =& get_instance();
			$this->CI->load->database();
			$this->CI->load->helper(array('url'));

	}
	
    public function singleUpload($newName , $category="")
    {
            $config['upload_path'] = 'assets/upload/'.$category;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '1000';
            $config['file_name'] = $newName;
            $this->CI->load->library('upload', $config);


            if (!$this->CI->upload->do_upload())
            {

                return $this->CI->upload->display_errors();
            }
            else
            {
                $data =$this->CI->upload->data();

                return $data;
            }


    }



}
?>
