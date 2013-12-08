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
            $this->load->library(array('cor3','catalog'));
			$this->load->model(array('pages_model'));


        }
        public function index()
        {
            //main config
            $mConfig = $this->cor3->mainConfig();

            $head       = $mConfig;

            $body       = $mConfig;
            $body['brandList'] = $this->catalog->brandlist();

            $content    = $mConfig;
            $content['mainCategory'] =  $this->catalog->mainCategoryProduct($mConfig['main_category']);


            $footer     = $mConfig;
            $fcontent   = $mConfig;

            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/home',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/fhome',$fcontent);

        }
        public function view($cat1="",$cat2="")
        {
            //main config
            $mConfig = $this->cor3->mainConfig();

            if (file_exists('application/views/idial/page/'.$cat1.'.php'))
            {
                print "page1";



            }
            elseif(file_exists('application/views/idial/page/'.$cat1.'/'.$cat1.'.php')){
                print "page2";
               /**/
            }
            else{

                $cat1 = urldecode($cat1);
                $cat2 = urldecode($cat2);

                $row1 = $this->cor3->cekRowContent("jp_category" ,array('name'=>$cat1,'status'=>'1','parent_id'=>'0'));
                $row2 = $this->cor3->cekRowContent("jp_category" ,array('name'=>$cat2,'status'=>'1','parent_id'=>'0'));

                $statusPage = $this->errorCek($row1,$row2);
                if($statusPage!= false){

                }
            }


        }


        public function errorCek($row1,$row2){


            if(($row1==0)||($row2==0)){
                $mConfig = $this->cor3->mainConfig();

                $head       = $mConfig;
                $body       = $mConfig;
                $content    = $mConfig;
                $footer     = $mConfig;
                $fcontent   = $mConfig;
                $this->load->view($mConfig['themes'].'/head',$head);
                $this->load->view($mConfig['themes'].'/body',$body);
                $this->load->view($mConfig['themes'].'/error404',$content);
                $this->load->view($mConfig['themes'].'/footer',$footer);
                $this->load->view($mConfig['themes'].'/fhome',$fcontent);
                return false;
            //exit();
            }else{
                return true;
            }
        }



        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */