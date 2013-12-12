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

        }
        public function index() {
            //main config
            $mConfig = $this->cor3->mainConfig();

            $head       = $mConfig;
            $body       = $mConfig;
            $content    = array(
                            'error_message'=>$this->errorMessage($this->input->get('err')),
                        );

            $footer     ="";
            $fcontent   = "";

            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/account/hlogin_regis',$content);
            $this->load->view($mConfig['themes'].'/account/login',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/account/flogin',$fcontent);


        }

        public function register() {
            $mConfig = $this->cor3->mainConfig();

            $head       = $mConfig;
            $body       = $mConfig;
            $content    = array(
                'error_message'=>$this->errorMessage($this->input->get('err')),
            );

            $footer     ="";
            $fcontent   = "";

            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/account/hlogin_regis',$content);
            $this->load->view($mConfig['themes'].'/account/register',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/account/fregister',$fcontent);

        }




        public function lostpassword() {
            $mConfig = $this->cor3->mainConfig();

            $head       = $mConfig;
            $body       = $mConfig;
            $content    = array(
                'error_message'=>$this->errorMessage($this->input->get('err')),
            );

            $footer     ="";
            $fcontent   = "";

            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/account/hlogin_regis',$content);
            $this->load->view($mConfig['themes'].'/account/lostpass',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/account/flostpass',$fcontent);


        }
        public function resetpassword() {
			$token = $this->input->get('token');
			$userid = $this->input->get('iD');
			if(!empty($token)){
                $mConfig = $this->cor3->mainConfig();

                $head       = $mConfig;
                $body       = $mConfig;
                $content    = array(
                    'error_message'=>$this->errorMessage($this->input->get('err')),
                    "token"=>$token,
                    "userid"=>$userid,
                );

                $footer     ="";
                $fcontent   = "";

                $this->load->view($mConfig['themes'].'/head',$head);
                $this->load->view($mConfig['themes'].'/body',$body);
                $this->load->view($mConfig['themes'].'/account/hlogin_regis',$content);
                $this->load->view($mConfig['themes'].'/account/resetpassword',$content);
                $this->load->view($mConfig['themes'].'/footer',$footer);
                $this->load->view($mConfig['themes'].'/account/fresetpass',$fcontent);


	

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
                elseif($err_val == 5 ){
                    $error_message .= '<div style=" font-size: 14px; color:red; padding: 10px;">
                                    Sorry , your email is already registered. Please try to <a href="'.base_url().'login">login</a> or <a href="'.base_url().'lost-password">forgot your password</a>.
                                </div>';
                }
                elseif($err_val == 6 ){
                    $error_message = '<div style="top:0px; left:0px;width:100%;background-color:#f2f2f2;margin-bottom:20px">
   							<div style=" font-size: 14px; color:red; padding: 10px;">
							Sorry , Your email is not register yet . <a href="'.base_url().'register">Click here for register to our site </a>.
							</div></div>';
                }


                $error_message .= '</div>';
            }
            return $error_message;
        }
        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */