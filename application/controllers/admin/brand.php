<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Brand extends CI_Controller {

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
			$this->load->model(array('admin/brand_model'));

            if($this->session->userdata('user_admin')==NULL){
                print '<script>window.location="'.base_url().'jp/?err=2";</script>';
            }

        }
        
         public function index(){

             $err_val = $this->input->get('err');
             $error_message = "";
             if($err_val != null){
                 $error_message  = '<div style="top:0px; left:0px;width:100%;background-color:#f2f2f2;margin-bottom:20px">';
                 if($err_val == 1 ){
                     $error_message .= '<div style=" font-size: 14px; color:green; padding: 10px;">Data Successfully inserted.</div>';
                 }
                 elseif($err_val == 2){
                     $error_message .= '<div style="font-size: 14px; color:green; padding: 10px;">Data Successfully Updated.</div>';
                 }
                 elseif($err_val == 3 ){
                     $error_message .= '<div style=" font-size: 14px; color:green; padding: 10px;">Data Has been Deleted.</div>';
                 }

                 $error_message .= '</div>';

             }
            $themes ="admin";
            $structure = array(
                "dashboard/table/head",
                "dashboard/body",
                "dashboard/brand/list",
                "dashboard/table/footer");
            $error_message = "";


            $tableName ="jp_brand";
            $page = strtoupper("brand");
            $column = "bra_id,name,status,created,updated";
            $colEnd = count(explode(',',$column));
            $iColumns = "bra_id";

            $data = array(
                "site_url"=>base_url(),
                "dashboard" => '',
                "catalog" =>'class="active"' ,
                "extra" =>'' ,
                "urlActionTable"=>$themes.'/tableview/?tBn='.$tableName.'&colTab='.$column.'&icl='.$iColumns,
                "urlEditRow"=>$themes.'/'.$page.'/edit/',
                "urlDelRow"=>$themes.'/'.$page.'/delete/',
                "tableFormName" =>$tableName,
                "tableType" =>"action",
                "colEnd" =>$colEnd,
                "error_message"=>$error_message,
                "pageContent"=>$page,
                "pageContent2"=>"You can see list data of Brand",

            );
            print $this->cor3->html($themes,$structure,$data);

         }





    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */