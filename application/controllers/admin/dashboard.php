<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Dashboard extends CI_Controller {
        
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
			 $this->load->model(array('admin_model'));

        }
        
        public function index() {
			$themes ="admin/dashboard";
            $structure = array("head","body","dashboard","footer");
            $data = array(
                        "site_url"=>base_url(),
                         "Page"=>"Dashboard"
            );

			print $this->cor3->html($themes,$structure,$data);
        }


        public function data_subscriber(){
            $queryData = $this->admin_model->dataSubscriber();
            $data = array(
                    "site_url"=>base_url(),
                    "Page"=>"Subscriber",
                    "dataSubscriber" =>$queryData
            );

            $themes1 ="admin/dashboard/table/subscriber";
            $structure1 = array("head");

            $themes2 ="admin/dashboard";
            $structure2 = array("body");


            $structure3 = array("subscriber","footer");

            print $this->cor3->html($themes1,$structure1,$data);
            print $this->cor3->html($themes2,$structure2,$data);
            print $this->cor3->html($themes1,$structure3,$data);





        }
		 

        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */