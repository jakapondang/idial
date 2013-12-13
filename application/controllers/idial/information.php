<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Information extends CI_Controller {

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
            $this->load->library(array('cor3','catalog'));
			$this->load->model(array('pages_model'));


        }

        public function contact() {
            $mConfig = $this->cor3->mainConfig();


            $head       = $mConfig;
            $body       = $mConfig;
            $content    = $mConfig;
            $footer     = $mConfig;
            $fcontent   = $mConfig;
            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/contact/contact',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/contact/fcontact',$fcontent);
        }
        public function aboutus() {
            $mConfig = $this->cor3->mainConfig();


            $head       = $mConfig;
            $body       = $mConfig;
            $content    = $mConfig;
            $footer     = $mConfig;
            $fcontent   = $mConfig;
            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/aboutus/aboutus',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/aboutus/faboutus',$fcontent);
        }

        public function privacypolicy() {
            $mConfig = $this->cor3->mainConfig();


            $head       = $mConfig;
            $body       = $mConfig;
            $content    = $mConfig;
            $footer     = $mConfig;
            $fcontent   = $mConfig;
            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/privacy/privacy',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/privacy/fprivacy',$fcontent);
        }

        public function terms() {
            $mConfig = $this->cor3->mainConfig();


            $head       = $mConfig;
            $body       = $mConfig;
            $content    = $mConfig;
            $footer     = $mConfig;
            $fcontent   = $mConfig;
            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/terms/terms',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/terms/fterms',$fcontent);
        }







        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */