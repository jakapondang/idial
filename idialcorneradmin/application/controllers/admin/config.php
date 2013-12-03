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
                "dashboard/formc/head",
                "dashboard/body",
                "dashboard/".$this->page."/form",
                "dashboard/formc/footer");

            // data edited
            $editValue = $this->jpconfig_model->getValueConfig($this->table);
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
            foreach($editValue as $row){
                $data[$row->type] = $row->content;
            }

            print $this->cor3->html($themes,$structure,$data);


            /* if($this->input->get('id')!=NULL){// if EDIT
                 $id = $this->input->get('id');
                 $pageContentHeader = "Edit";
                 $edit = "AND cat_id !=".$id." ";



                     // variable html
                     $data = array(
                         "site_url"=>base_url(),
                         "dashboard" => 'class="active"',
                         "catalog" =>'' ,
                         "extra" =>'',
                         "pageContent"=>strtoupper($this->page),

                         "pageContentLink"=>$this->page,
                         "pageContentHeader" =>$pageContentHeader,
                         "pageContent2"=>"You can ".$pageContentHeader." Content here",
                         "error_message"=>$error_message,

                         //"editCatValue"=>$editCatValue,

                     );
                     $data = array_merge($data,$valueEdited);

             }else{// if NEW
                 $pageContentHeader = "";

                 $data = array(
                     "site_url"=>base_url(),
                     "dashboard" => 'class="active"',
                     "catalog" =>'' ,
                     "extra" =>'',
                     "pageContent"=>strtoupper($this->page),
                     "id"=>$id,
                     "pageContentLink"=>$this->page,
                     "pageContentHeader" =>$pageContentHeader,
                     "pageContent2"=>"You can set your ".$this->page." Content here",
                     "error_message"=>$error_message,

                     "type"=>"",
                     "content"=>"",
                     "status"=>"checked",

                 );

             }
 */
            //print $this->cor3->html($themes,$structure,$data);


        }


        public function action(){
            $main_email = $this->input->post('main_email');
            $header_menu_background = $this->input->post('header_menu_background');
            $body_background = $this->input->post('body_background');
            $footer_background = $this->input->post('footer_background');
            if(!empty($main_email)||!empty($header_menu_background)){
                $data = array(
                    'content'=>$main_email,
                    "author"=>$this->session->userdata('user_id'),
                );
                $dataWhere = array('type'=>'main_email');
                $this->cor3_model->updateValue($this->table, $data, $dataWhere);

                $data = array(
                    'content'=>$header_menu_background,
                    "author"=>$this->session->userdata('user_id'),
                );
                $dataWhere = array('type'=>'header_menu_background');
                $this->cor3_model->updateValue($this->table, $data, $dataWhere);

                $data = array(
                    'content'=>$body_background,
                    "author"=>$this->session->userdata('user_id'),
                );
                $dataWhere = array('type'=>'body_background');
                $this->cor3_model->updateValue($this->table, $data, $dataWhere);

                $data = array(
                    'content'=>$footer_background,
                    "author"=>$this->session->userdata('user_id'),
                );
                $dataWhere = array('type'=>'footer_background');
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