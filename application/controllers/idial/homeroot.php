<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Homeroot extends CI_Controller {
        
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
			$this->load->model('idial/home_model','home_model');

        }
        
        public function index() {
			$themes ="idial";
            $structure = array("head","body","home/home","footer","home/fhome");

            $preload = $this->cor3->html($themes,array("preload"));
            $data = array(
                    "site_url"=>base_url(),
                    "preload"=>$preload,
            );

			print $this->cor3->html($themes,$structure,$data);
        }
		
		public function contact() {
			/**/
            $themes ="idial";
            $structure = array("head","body","contact/contact","footer","contact/fcontact");
            $data = array("site_url"=>base_url());

            print $this->cor3->html($themes,$structure,$data);
		}
        public function service() {
            /**/

        }
        public function aboutus() {
            /**/

        }
		public function email() {
			/**/
			$themes ="idial/email";
            $structure = array("temp_1");
            $data = array("site_url"=>base_url());
			
			
			$mailfrom = "admin@dev.idialcorner.com";
							$mailfname = "iDial Corner";
							$mailto = "jaka.pondang@me.com";
							$mailbcc = "jaka.pondang@gmail.com";
							
							$subject = 'iDialCorner.com New Subscriber!';
							$plain_text = "You have a new subscriber!\n\nEmail: wewe<br>";
							$plain_text .= "Voucher Code: 1231231";
							
						$message =	$this->cor3->html($themes,$structure,$data);
			$this->cor3->sent_email($subject,$message,$mailfrom,$mailto,$mailbcc,$mailfname,$plain_text);
			
			
			//$this->load->view('idial/email/temp_1');
			echo $this->email->print_debugger();
		}
		 

        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */