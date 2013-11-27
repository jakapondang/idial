<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Dashboard extends CI_Controller {

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
            $this->load->library(array('cor3','adminsecure'));
			$this->load->model(array('admin/admin_model'));
            //$this->config->set_item('base_url','http://idialcorner.jp/jp') ;
            if($this->session->userdata('user_admin')==NULL){
                print "<script>window.location='".base_url()."jp/?err=2'</script>";
            }

        }
        
        public function index() {

            $themes ="admin";
            $structure = array("dashboard/head","dashboard/body","dashboard/dashboard","dashboard/footer");

            $error_message = "";
            $data = array(
                "site_url"=>base_url(),
                "dashboard" => 'class="active"',
                "catalog" =>'' ,
                "extra" => '',
                "pageContent"=>"dashboard",
                "pageContent2"=>"Welcome to iDial Dashboard",
                "error_message"=>$error_message
            );


			print $this->cor3->html($themes,$structure,$data);
        }



		 

        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */