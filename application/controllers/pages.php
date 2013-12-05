<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Pages extends CI_Controller {

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
			$this->load->model(array('pages_model'));


        }
        public function index()
        {

           $mConfig = $this->cor3->mainConfig();
            $head       = $mConfig;
            $body       = $mConfig;
            $content    = $mConfig;
            $footer     = $mConfig;
            $fcontent   = $mConfig;

            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/home/home',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/home/fhome',$fcontent);

        }
        public function view($page = '')
        {
           $page = urldecode($page);

            if ( ! file_exists('application/views/idial/'.$page.'/'.$page.'.php'))
            {

                show_404();
            }
            $data = array(
                "site_url"=>base_url(),
                "preload"=>"",
            );
            $menuCategory=$this->pages_model->getMainMenu('jp_category');

            $data['title'] = ucfirst($page);
            $data['menuCategory'] = $menuCategory;// Capitalize the first letter
            //$data['nav'] = $this->content_model->get_nav();
            //$data['content'] = $this->content_model->get_content();

          /*  if(empty($data['content']))
            {
                show_404();
            }*/
            $structure = array("head","body",$page."/".$page,"footer",$page."/f".$page);



            print $this->cor3->html($this->themes,$structure,$data);


        }






        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */