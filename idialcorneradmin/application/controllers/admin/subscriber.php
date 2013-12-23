<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Subscriber extends CI_Controller {

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
            $this->load->library(array('cor3'));
			$this->load->model(array('admin/subscriber_model'));

            if($this->session->userdata('user_admin')==NULL){
                print '<script>window.location="'.base_url().'?err=2";</script>';
            }

        }
        
         public function index(){


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



         }
		 
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




    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */