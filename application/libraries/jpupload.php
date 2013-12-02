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
            $config['max_size']	= '0';
            $config['file_name'] = $newName;
            $this->CI->load->library('upload', $config);


            if (!$this->CI->upload->do_upload())
            {

               // $data =  $this->CI->upload->display_errors();
                $data = 0;
            }
            else
            {
                $data =$this->CI->upload->data();


            }
        return $data;


    }
    public function  multiUpload($newName,$category="")
    {

        $this->CI->load->library('upload');

        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        $data = array();
        for($i=0; $i<$cpt; $i++)
        {

            $_FILES['userfile']['name']= $files['userfile']['name'][$i];
            $_FILES['userfile']['type']= $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error']= $files['userfile']['error'][$i];
            $_FILES['userfile']['size']= $files['userfile']['size'][$i];



            $this->CI->upload->initialize($this->set_upload_options($newName."-".$i,$category));
            if(!$this->CI->upload->do_upload()){
                //$data[]= $this->CI->upload->display_errors();
                $data[]= 0;
            }else{
                $data[] =$this->CI->upload->data();


            }


        }
        return $data;

    }
    private function set_upload_options($newName,$category)
    {
    //  upload an image options
            $config = array();
            $config['upload_path'] = 'assets/upload/'.$category;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '0';
            $config['overwrite']     = FALSE;
            $config['file_name']    = $newName;


            return $config;
    }







}
?>
