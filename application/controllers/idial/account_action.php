<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Account_action extends CI_Controller {
        
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
            $this->load->library(array('cor3','usersecure'));
			$this->load->model('idial/account_model','account_model');

        }
        
        public function register() {
           /* $themes     ="idial";
            $structure  = array("email/register");
            $data       = array("site_url"=>base_url());
            $message    =  $this->cor3->html($themes,$structure,$data);
            $plain_message="";
            print $message;*/

            $subject    = "Welcome to iDialCorner.com";
            $mailfrom   = "hello@idialcorner.com";
            $mailto     = "jaka.pondang@gmail.com";
            $mailfname  = "iDial Corner";

            $themes     ="idial";
            $structure  = array("email/register");
            $data       = array("site_url"=>base_url());
            $message    =  $this->cor3->html($themes,$structure,$data);
            $plain_message="";
           // print $message;
            $this->cor3->sentEmail($subject,$message,$plain_message,$mailfrom,$mailfname,$mailto);

           /* $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $pass  = $this->input->post('cpassword');

            $rowCount  = $this->account_model->cekRowTable("jp_users","user_email",$email);

            if($rowCount > 0){
                // EMail Already exist
                print '<script>window.location="'.base_url().'register/?err=1";</script>';

            }else{

                $this->usersecure->create($email,$pass);
                $subject    = "Welcome to iDialCorner.com";
                $mailfrom   = "hello@idialcorner.com";
                $mailto     = $email;
                $mailfname  = "iDial Corner";

                $themes     ="idial";
                $structure  = array("email/register");
                $data       = array("site_url"=>base_url());
                $message    =  $this->cor3->html($themes,$structure,$data);
                $plain_message="";

               // $this->cor3->sentEmail($subject,$message,$plain_message,$mailfrom,$mailfname,$mailto);
                //print '<script>window.location="'.base_url().'account/";</script>';

            }*/

        }

        public function logout(){

            $this->usersecure->logout();
            print '<script>window.location="'.base_url().'";</script>';
        }
		

		
		
		 

        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */