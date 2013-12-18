<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Config extends CI_Controller {

        var $table      ="jp_config";
        var $iColumn    = "con_id";
        var $page       = "config";
        /**
        * Index Page for this controller.
        *
        * Maps to the following URL
        * 		http://example.com/index.php/welcome
        *	- or -  
        * 		http://example.com/index.php/welcome/index
        *	- or -
        * Since this controller is set as the default controller in 
        * config/routes.php, it's displayed at http://example.com/
        *
        * So any other public methods not prefixed with an underscore will
        * map to /index.php/welcome/<method_name>
        * @see http://codeigniter.com/user_guide/general/urls.html
        */
        
        public function __construct() {
            parent::__construct();
            $this->load->library(array('cor3','cor3_model'));
			$this->load->model(array('admin/jpconfig_model'));
            if($this->session->userdata('user_admin')==NULL){
                print "<script>window.location='".base_url()."?err=2'</script>";
            }

        }
        


        public function index(){


            //themes
            $themes ="admin";
            if($this->input->get('err')){
                $error_message = $this->errorMessage($this->input->get('err'));
            }else{
                $error_message = "";
            }
            $pageContentHeader ="";

            $structure = array(
                "dashboard/form/head",
                "dashboard/body",
                "dashboard/".$this->page."/form",
                "dashboard/form/footer");
            $data= array(
                "site_url"=>base_url(),
                "dashboard" => 'class="active"',
                "catalog" =>'' ,
                "user" =>'',
                "error_message"=>$error_message,
                "pageContent"=>strtoupper($this->page),
                "pageContentLink"=>$this->page,
                "pageContentHeader" =>$pageContentHeader,
                "pageContent2"=>"You can set your ".$this->page." Content here",
                "error_message"=>$error_message
            );
            // data edited
            $editValue = $this->jpconfig_model->getValueConfig($this->table,"WHERE type LIKE 'main_%'");
            foreach($editValue as $row){
                $data[$row->type] = $row->content;
                if($row->type == 'main_category'){// category
                    $mcat_id =$row->content;
                }
            }
           // print_r($data);
            // Category
            $catValue = $this->jpconfig_model->getCategory();
            //$data['catValue1'] = $catValue;
            //$data['catValue2']  = $catValue;
            //$data['catValue3']  = $catValue;

            $mcat_id =  explode(',',$mcat_id);
            $mcat_array =array();
            for($i=0;$i<count($mcat_id);$i++){
                for($c= 0 ; $c<count($catValue);$c++){
                    if(IN_ARRAY($mcat_id[$i] ,$catValue[$c])){

                        $catValue[$c]['selected']="selected='selected'";
                        //print   $catValue[$c]['catid']."selected";

                    }else{
                        $catValue[$c]['selected']="";
                        //print  $catValue[$c]['catid']."NOTSELECTED";
                    }


                }
                $data['catValue'.$i] = $catValue;

            }





          print $this->cor3->html($themes,$structure,$data);


        }

        public function background(){


            //themes
            $themes ="admin";
            if($this->input->get('err')){
                $error_message = $this->errorMessage($this->input->get('err'));
            }else{
                $error_message = "";
            }
            $pageContentHeader ="";

            $structure = array(
                "dashboard/formc/head",
                "dashboard/body",
                "dashboard/".$this->page."/bgform",
                "dashboard/formc/footer");
            $data= array(
                "site_url"=>base_url(),
                "dashboard" => 'class="active"',
                "catalog" =>'' ,
                "extra" =>'',
                "error_message"=>$error_message,
                "pageContent"=>strtoupper($this->page),
                "pageContentLink"=>$this->page,
                "pageContentHeader" =>$pageContentHeader,
                "pageContent2"=>"You can set your ".$this->page." Content here",
                "error_message"=>$error_message
            );
            // data edited
            $editValue = $this->jpconfig_model->getValueConfig($this->table,"WHERE type NOT LIKE 'main_%'");
            foreach($editValue as $row){
                $data[$row->type] = $row->content;

            }

            print $this->cor3->html($themes,$structure,$data);


        }


        public function action_config(){
           $main_title = $this->input->post('main_title');
           $main_email = $this->input->post('main_email');
            $main_add = $this->input->post('main_add');
            $main_desc = $this->input->post('main_desc');



           $mcat_id ="";
           for( $i=0 ; $i < count($_POST['mcat_id']) ; $i++ )
           {

                   $mcat_id[] = $_POST['mcat_id'][$i];

                // if you require then the query for your database
           }

            if(!empty($main_title)||!empty($main_email)||!empty($mcat_id)){
               $data = array(
                   'content'=>$main_title,
                   "author"=>$this->session->userdata('user_id'),
               );
               $dataWhere = array('type'=>'main_title');
               $this->cor3_model->updateValue($this->table, $data, $dataWhere);

               $data = array(
                   'content'=>$main_email,
                   "author"=>$this->session->userdata('user_id'),
               );
               $dataWhere = array('type'=>'main_email');
               $this->cor3_model->updateValue($this->table, $data, $dataWhere);


              $mcat_id =  implode(',',$mcat_id);
               $data = array(
                'content'=>$mcat_id,
                "author"=>$this->session->userdata('user_id'),
               );
               $dataWhere = array('type'=>'main_category');
               $this->cor3_model->updateValue($this->table, $data, $dataWhere);

              $data = array(
                     'content'=>$main_add,
                     "author"=>$this->session->userdata('user_id'),
                 );
               $dataWhere = array('type'=>'main_add');
               $this->cor3_model->updateValue($this->table, $data, $dataWhere);

              $data = array(
                    'content'=>$main_desc,
                    "author"=>$this->session->userdata('user_id'),
                );
              $dataWhere = array('type'=>'main_desc');
              $this->cor3_model->updateValue($this->table, $data, $dataWhere);



               print "<script>window.location='".base_url().$this->page."/?err=2'</script>";
           }


        }
        public function action_background(){

            $hm_background = $this->input->post('hm_background');
            $bf_background = $this->input->post('bf_background');
            $fo_background = $this->input->post('fo_background');


            if(!empty($hm_background)||!empty($bf_background)||!empty($fo_background)){

                $data = array(
                    'content'=>$hm_background,
                    "author"=>$this->session->userdata('user_id'),
                );
                $dataWhere = array('type'=>'hm_background');
                $this->cor3_model->updateValue($this->table, $data, $dataWhere);

                $data = array(
                    'content'=>$bf_background,
                    "author"=>$this->session->userdata('user_id'),
                );
                $dataWhere = array('type'=>'bf_background');
                $this->cor3_model->updateValue($this->table, $data, $dataWhere);

                $data = array(
                    'content'=>$fo_background,
                    "author"=>$this->session->userdata('user_id'),
                );
                $dataWhere = array('type'=>'fo_background');
                $this->cor3_model->updateValue($this->table, $data, $dataWhere);
               print "<script>window.location='".base_url().$this->page."/?err=2'</script>";
            }


        }


        public function errorMessage($err_val=""){
            $error_message="";
            if($err_val != null){//
                if(($err_val>0)&&($err_val<11)){
                    $error_message  = '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>';
                    if($err_val == 1 ){
                        $error_message .= '<strong>Data Successfully Inserted..</strong></div>';

                    }
                    elseif($err_val == 2){
                        $error_message .= '<strong>Data Successfully Updated.</strong></div>';

                    }
                    elseif($err_val == 3 ){
                        $error_message .= '<strong>Data Has been Deleted. !</strong></div>';
                    }
                }else{
                    $error_message  = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>';
                    if($err_val == 11 ){

                        $error_message .= '<strong>Sorry , Data Cannot be Delete !</strong><br> Because is PARENT.</div>';
                    }
                }



            }
            return $error_message;
        }

    }
    
    /* End of file homeroot.php


    /* Location: ./application/controllers/homeroot.php */