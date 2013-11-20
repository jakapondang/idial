<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Account extends CI_Controller {
        
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

        }
        
        public function index() {
			
			$themes ="idial";
            $structure = array("head","body","account/login","footer","account/flogin");
            $data = array("site_url"=>base_url());

			print $this->cor3->html($themes,$structure,$data);
        }
		
		public function register() {
				$themes ="idial";
					$structure = array("head","account/hregister","body","account/register","footer","account/fregister");
					$error_message = '<div style="top:0px; left:0px;width:100%; background-color:#FFFFFF;margin-bottom:20px">
   							<div style="font-family: Tahoma; font-size: 14px; background-color:#f2f2f2;color:red; padding: 10pt;">
							ERROR MESSAGE
							</div></div>';
					/*if(!empty()){
						$error_message = '<div style="top:0px; left:0px;width:100%; background-color:#FFFFFF;margin-bottom:20px">
   							<div style="font-family: Tahoma; font-size: 14px; background-color:#f2f2f2;color:red; padding: 10pt;">
							'..'
							</div></div>';
						}*/
					$data = array(
							"site_url"=>base_url(),
							"error_message"=>$error_message,
					);
		
					print $this->cor3->html($themes,$structure,$data);
			
			
        }
		
		
		 

        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */