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
			//$this->load->library(array('parser'));
           
        }
        
        public function index() {
			$themes ="html";
			$data = array("cek"=>"123");
			print $this->cor3->html($themes);
        }

        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */