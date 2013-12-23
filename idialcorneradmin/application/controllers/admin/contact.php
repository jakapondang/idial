<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Contact extends CI_Controller {
        var $page = "contact";
        var $table = "jp_contact";
        var $iColumn = "id";
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
			$this->load->model(array('admin/contact_model'));

            if($this->session->userdata('user_admin')==NULL){
                print '<script>window.location="'.base_url().'?err=2";</script>';
            }

        }
        public function index(){


            $themes ="admin";
            $structure = array(
                "dashboard/table/head",
                "dashboard/body",
                "dashboard/".$this->page."/list",
                "dashboard/table/footer");
            $error_message = "";


            $column = $this->iColumn.",contact_person,message,status,created";

            $data = array(
                "site_url"=>base_url(),
                "dashboard" => '',
                "catalog" =>'' ,
                "extra" =>'class="active"' ,
                "urlActionTable"=>$themes.'/tableview/?tBn='.$this->table.'&colTab='.$column.'&icl='.$this->iColumn,
                "urlEditRow"=>'',
                "urlDelRow"=>'',
                "tableFormName" =>$this->table,
                "tableType" =>"view",
                "error_message"=>$error_message,
                "pageContent"=>strtoupper($this->page),
                "pageContentLink"=>strtolower($this->page),
                "pageContent2"=>"You can see list data of ".$this->page,
            );

            print $this->cor3->html($themes,$structure,$data);

        }

        public function action_change_status($status){
            $id = $this->input->get('id');
            $row = $this->subscriber_model->cekSubscriber($this->table,$this->iColumn,$id);
            if($row>0){

               $dataWhere = array(
                   $this->iColumn =>$id
               );
               $data = array("order"=>$status);

               $ResultQuery = $this->cor3_model->updateValue($this->table, $data, $dataWhere);

                if($ResultQuery){
                    print "<script>window.location='".base_url().$this->page."/?err=2'</script>";
                }
            }
        }

        /*
         public function cs(){


            $themes ="admin";
            $structure = array(
                "dashboard/table/head",
                "dashboard/body",
                "dashboard/subscriber/list",
                "dashboard/table/footer");
            $error_message = "";

             $tableName ="subscriber_cs";
             $page = "subscriber";
             $column = "id,contact_person,code,created";
             $iColumns = "id";
             $data = array(
                 "site_url"=>base_url(),
                 "dashboard" => '',
                 "catalog" =>'' ,
                 "extra" =>'class="active"' ,
                 "urlActionTable"=>$themes.'/tableview/?tBn='.$tableName.'&colTab='.$column.'&icl='.$iColumns,
                 "urlEditRow"=>'',
                 "urlDelRow"=>'',
                 "tableFormName" =>$tableName,
                 "tableType" =>"view",
                 "error_message"=>$error_message,
                 "pageContent"=>strtoupper($page),
                 "pageContentLink"=>strtolower($page),
                 "pageContent2"=>"You can see list data of ".$page,
             );

            print $this->cor3->html($themes,$structure,$data);



         }*/
		 
		 public function order(){


            $themes ="admin";
            $structure = array(
                "dashboard/table/head",
                "dashboard/body",
                "dashboard/subscriber/listorder",
                "dashboard/table/footer");
            $error_message = "";

             $tableName ="jp_subscriber";
             $page = "Subscriber";
             $column = "id,name,contact_person,address,pro_id,qty,order";
             $iColumns = "id";
             $data = array(
                 "site_url"=>base_url(),
                 "dashboard" => '',
                 "catalog" =>'' ,
                 "extra" =>'class="active"' ,
                 "urlActionTable"=>$themes.'/tableview/?tBn='.$tableName.'&colTab='.$column.'&icl='.$iColumns,
                 "urlEditRow"=>'',
                 "urlDelRow"=>'',
                 "tableFormName" =>$tableName,
                 "tableType" =>"action",
                 "error_message"=>$error_message,
                 "pageContent"=>strtoupper($page),
                 "pageContentLink"=>strtolower($page),
                 "pageContent2"=>"You can see list data of ".$page,
             );

            print $this->cor3->html($themes,$structure,$data);



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
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */