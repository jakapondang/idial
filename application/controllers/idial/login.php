<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Login extends CI_Controller {
        //var  $themes ="idial";
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
            if($this->session->userdata('user_email')!=NULL){
                print '<script>window.location="'.base_url().'account";</script>';

            }

        }
        public function index() {
            //main config
            $mConfig = $this->cor3->mainConfig();

           $errorMessage = $this->errorMessage($this->input->get('err'));
            $head       = $mConfig;
            $body       = $mConfig;
            $content    ="";
            $footer     ="";
            $fcontent = "";

            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/account/hlogin_regis',$content);
            $this->load->view($mConfig['themes'].'/account/login',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/account/flogin',$fcontent);


        }

        public function register() {
				$themes ="idial";
					$structure = array("head","account/hlogin_regis","body","account/register","footer","account/fregister");

					$error_message = "";
                    $err_val = $this->input->get('err');
					if($err_val == 1 ){
                        $error_message = '
                            <div style="top:0px; left:0px;width:100%;background-color:#f2f2f2;margin-bottom:20px">
   							<div style=" font-size: 14px; color:red; padding: 10px;">
							Sorry , Email address is already exist. Please try again.
							</div></div>';
                    }
                        /**/
					$data = array(
							"site_url"=>base_url(),
							"error_message"=>$error_message,
					);

					print $this->cor3->html($themes,$structure,$data);
			
			
        }




        public function lostpassword() {

            $themes ="idial";
            $structure = array("head","body","account/hlogin_regis","account/lostpass","footer","account/flostpass");
            $error_message = "";
           $err_val = $this->input->get('err');
            if($err_val == 1 ){
                $error_message = '<div style="top:0px; left:0px;width:100%;background-color:#f2f2f2;margin-bottom:20px">
   							<div style=" font-size: 14px; color:red; padding: 10px;">
							Sorry , Your email is not register yet . <a href="'.base_url().'register">Click here for register to our site </a>.
							</div></div>';
            }

            /**/
            $data = array(
                "site_url"=>base_url(),
                "error_message"=>$error_message,
            );

            print $this->cor3->html($themes,$structure,$data);
        }
        public function resetpassword() {
			$token = $this->input->get('token');
			$userid = $this->input->get('iD');
			if(!empty($token)){
				$themes ="idial";
				$structure = array("head","body","account/hlogin_regis","account/resetpassword","footer","account/fresetpass");
				$error_message = "";
				$data = array(
					"site_url"=>base_url(),
					"error_message"=>$error_message,
					"token"=>$token,
					"userid"=>$userid
				);
	
				print $this->cor3->html($themes,$structure,$data);
			}else{
				   print '<script>window.location="'.base_url().'login/?err=3";</script>';
				}
        }

        public function errorMessage($err_val){

            $error_message = "";

            if(!empty($err_val)){
                $error_message  = ' <div style="top:0px; left:0px;width:100%;background-color:#f2f2f2;margin-bottom:20px">';
                if($err_val == 1 ){
                    $error_message .= '<div style=" font-size: 14px; color:red; padding: 10px;">
                                Sorry , Invalid login or password.
                                </div>';
                }
                elseif($err_val == 2 ){
                    $error_message .= '<div style=" font-size: 14px; color:red; padding: 10px;">
                                If there is an account associated . you will receive an email with a link to reset your password.
                                </div>';
                }
                elseif($err_val == 3 ){
                    $error_message .= '<div style=" font-size: 14px; color:red; padding: 10px;">
                                Sorry , Your session link is expired . Please try again.
                                </div>';
                }
                elseif($err_val == 4 ){
                    $error_message .= '<div style=" font-size: 14px; color:red; padding: 10px;">
                                Thank you . Your password has been renew. Please try to login.
                                </div>';
                }


                $error_message .= '</div>';
            }
            return $error_message;
        }
        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */