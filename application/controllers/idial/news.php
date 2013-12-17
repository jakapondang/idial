<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class News extends CI_Controller {

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
			$this->load->model(array('idial/news_model'));


        }


        public function index() {
            $mConfig = $this->cor3->mainConfig();


            $head       = $mConfig;
            $body       = $mConfig;
            $content    = $mConfig;
            $this->NewsList();
            //$content['pageList']    = $this->getListPage();
            $footer     = $mConfig;
            $fcontent   = $mConfig;
            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/news/news',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/news/fnews',$fcontent);
        }

        public function NewsList(){

           $row =  $this->news_model->getRowPage();
           if($row>0){
               $queryPage = $this->news_model->getPage();
               foreach( $queryPage->result()AS $row){
                    print $row->pag_id."=".$row->name."<br>";
                    //$queryMeta = $this->news_model->getPageMeta($row->pag_id);
                  // print_r($queryMeta);

               }
           }

        }







        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */