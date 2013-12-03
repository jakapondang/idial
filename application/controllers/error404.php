<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Error404 extends CI_Controller {
        var $themes= "idial";

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
            $this->load->library(array('cor3','cor3_model'));

        }
        
        public function index() {

            $structure = array("head","body","error404","footer","home/fhome");
            $data = array("site_url"=>base_url());

			print $this->cor3->html($this->themes,$structure,$data);
        }
		


		 

        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */