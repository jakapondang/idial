<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Adminroot extends CI_Controller {
        
        /**

        */
        
        public function __construct() {
            parent::__construct();
            $this->load->library(array('cor3','adminsecure'));
			$this->load->model(array('admin/admin_model'));
		
           /**/
        }
        
        public function index() {
			 if($this->session->userdata('user_admin')!= NULL){
                print '<script>window.location="'.base_url().'dashboard";</script>';
            }
            $err_val = $this->input->get('err');

            $error_message = $this->errorMessage($err_val);

			$themes ="admin";
            $structure = array("head","body","footer");
            $data = array(
                "site_url"=>base_url(),
                "error_message"=>$error_message,
            );

			print $this->cor3->html($themes,$structure,$data);
        }

        public function action_login(){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $ResultLogin = $this->adminsecure->login($username, $password);
           if($ResultLogin==TRUE):

                   print '<script>window.location="'.base_url().'dashboard";</script>';
              else:

                  print '<script>window.location="'.base_url().'?err=1";</script>'; 
              endif; /*  */

        }

        public function action_logout(){
            $this->adminsecure->logout();
			 print '<script>window.location="'.base_url().'";</script>'; 
			

        }


        public function errorMessage($err_val=""){
            $error_message="";
            if($err_val != null){//
                if(($err_val>0)&&($err_val<11)){
                    $error_message  = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>';
                    if($err_val == 1 ){
                        $error_message .= '<strong>Sorry , Invalid login or password.</strong></div>';
                    }
                    elseif($err_val == 2){
                        $error_message .= '<strong>Sorry , Your session is expired.</strong></div>';
                    }

                }else{

                }



            }
            return $error_message;
        }
		 

        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */