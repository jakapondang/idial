<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Adminroot extends CI_Controller {
        
        /**

        */
        
        public function __construct() {
            parent::__construct();
            $this->load->library(array('cor3','adminsecure'));
			$this->load->model(array('admin/admin_model'));
        }
        
        public function index() {
            $err_val = $this->input->get('err');
            $error_message ="";
            if(!empty($err_val)){
                $error_message  = ' <div style="top:0px; left:0px;width:100%;background-color:#f2f2f2;margin-bottom:20px">';
                if($err_val == 1 ){
                    $error_message .= '<div style=" font-size: 14px; color:red; padding: 10px;">
                                Sorry , Invalid login or password.
                                </div>';
                }elseif($err_val == 2 ){
                    $error_message .= '<div style=" font-size: 14px; color:red; padding: 10px;">
                                Sorry , Your session is expired.
                                </div>';
                }
            }
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

                  redirect('jp/dashboard', 'refresh');
              else:

                  redirect('jp/dashboard/?err=1', 'refresh');
              endif;

        }

        public function action_logout(){
            $this->adminsecure->logout();
            redirect('jp', 'refresh');

        }
		
		 

        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */