<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Jpupload {

    var $path= '../assets/idial/upload/';
	
	function Jpupload(){
			$this->CI =& get_instance();
			$this->CI->load->database();
			$this->CI->load->helper(array('url'));


	}
	
    public function singleUpload($newName , $category="")
    {
            $path = $this->path.$category;

            $config['upload_path'] =$path;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '0';
            $config['file_name'] = $newName;
            $this->CI->load->library('upload', $config);


            if (!$this->CI->upload->do_upload())
            {

               //$data =  $this->CI->upload->display_errors();
                $data = 0;
            }
            else
            {
                $data =$this->CI->upload->data();

            }
        return $data;


    }


    public function resizeUpload($category,$imgName,$width,$height){
        $this->CI->load->library('image_lib');

        $path = $this->path.$category.'/'.$imgName;
        $npath = $this->path.$category.'/thmb/'.$imgName;

        $config['image_library'] = 'gd2';
        $config['source_image'] = $path;
        $config['new_image'] = $npath;
       // $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $config['width']     = $width;
        $config['height']   = $height;

        $this->CI->image_lib->clear();
        $this->CI->image_lib->initialize($config);
        $this->CI->image_lib->resize();
        return $imgName;
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

            //$this->resizeUpload($category,$imgName,$width,$height);
        }
        return $data;

    }
    private function set_upload_options($newName,$category)
    {
    //  upload an image options
            $config = array();
            $config['upload_path'] = $this->path.$category;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '0';
            $config['overwrite']     = FALSE;
            $config['file_name']    = $newName;


            return $config;
    }

    // ============ CSV FILES
    function csvUpload() {

        $path =  $this->path.'import/';
        $temp = $_FILES["userfile"]["tmp_name"];
        $name = $_FILES["userfile"]["name"];
        $type = $_FILES["userfile"]["type"];
        $Result = "";
        if(!empty($temp)){
            if($type == "text/csv"){
                if(! move_uploaded_file($temp, $path.$name )){
                    $Result['error'] = 15;

                }else{
                    $Result['import']=$path.$name;
                    $Result['error'] = 0;
                }
            }else{
                $Result['error'] = 14;

            }
        }else{
            $Result['error'] = 13;
        }
        return $Result;

        //$allowedExts = array("text/csv", "jpeg", "jpg", "png");
        /*if(! move_uploaded_file($temp, $path.$name )){

        }*/

    }
}
?>
