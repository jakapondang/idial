<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Pricelist extends CI_Controller {

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
			$this->load->model(array('pages_model','idial/pricelist_model'));


        }
        public function index()
        {
            $mConfig = $this->cor3->mainConfig();

            $head       = $mConfig;
            $body       = $mConfig;

            $content    = $mConfig;

            $Productlist ="";
            $categoryName = $this->pricelist_model->getCategoryName();
            $catAvailable      = $this->pricelist_model->getProductCategory();
            $rowC = count($catAvailable);
           // print $rowC;
            if($rowC>0){

                for($i=0;$i<$rowC;$i++){
                    $Productlist[$i] = $this->pricelist_model->getProductList();


                }

                $content['catName'] =  $categoryName;
                $content['catAva'] =  $catAvailable;
                $content['productList'] = $Productlist;

                $footer     = $mConfig;
                $fcontent   = $mConfig;
                $this->load->view($mConfig['themes'].'/head',$head);
                $this->load->view($mConfig['themes'].'/body',$body);
                $this->load->view($mConfig['themes'].'/pricelist/pricelist',$content);
                $this->load->view($mConfig['themes'].'/footer',$footer);
                $this->load->view($mConfig['themes'].'/pricelist/fpricelist',$fcontent);
            }else{
               $this->noListing("PRICE LIST",0);
            }

        }

        public function noListing($catName,$catid){

            $mConfig = $this->cor3->mainConfig();
            $head       = $mConfig;
            $body       = $mConfig;
            $content    = $mConfig;
            $content ['catName'] = $catName;
            $footer     = $mConfig;
            $fcontent   = $mConfig;
            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/nolisting',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/fpage',$fcontent);/**/

        }





        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */