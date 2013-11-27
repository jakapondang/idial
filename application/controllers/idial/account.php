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
            if($this->session->userdata('user_email')==NULL){
                print '<script>window.location="'.base_url().'login";</script>';
            }

        }
        
        public function index() {
            //get error message
            $error_message = $this->errorMessage($this->input->get('err'));

			$themes ="idial";
            $structure = array("head","body","account/account","footer","account/faccount");
            $data = array(
                "site_url"=>base_url(),
                "error_message"=>$error_message,
                "email"=>$this->session->userdata('user_email'),
                "firstname"=>$this->session->userdata('firstname'),
                "lastname"=>$this->session->userdata('lastname'),
                "phone"=>$this->session->userdata('phone'),
            );

			print $this->cor3->html($themes,$structure,$data);
        }
		
        public function errorMessage($err_val=0){
            $error_message = "";
            if($err_val>0){
                $error_message  = ' <div style="top:0px; left:0px;width:100%;background-color:#f2f2f2;margin-bottom:20px">';
                if($err_val == 1 ){
                    $error_message .= '<div style=" font-size: 14px; color:red; padding: 10px;">
                                Sorry  , PASSWORD Cannot be empty.
                                </div>';
                }
                elseif($err_val == 2 ){
                    $error_message .= '<div style=" font-size: 14px; color:red; padding: 10px;">
                               Sorry , Your Current PASSWORD is wrong or system have problem saving data.
                                </div>';
                }
                elseif($err_val == 3){
                    $error_message .= '<div style=" font-size: 14px; color:green; padding: 10px;">
                               Your data have been save.
                                </div>';
                }
                $error_message .= '</div>';
            }else{


            }


            return $error_message;
        }
        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */