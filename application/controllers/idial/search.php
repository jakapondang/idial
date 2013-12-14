<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Search extends CI_Controller {

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
			$this->load->model(array('idial/search_model'));


        }

        public function index()
        {

            $mConfig = $this->cor3->mainConfig();

            $search = $this->input->get('s');
            if($search){
                $mConfig['ksearch'] = $search;
            }else{
                $mConfig['ksearch'] = "Theres no related Smartphone / Tablet ";
            }
            $head       = $mConfig;
            $body       = $mConfig;
            $content    = $mConfig;
            $charCount = strlen($search); // 6
            if($charCount>2){
                $productList =  $this->productList($search);
                if($productList!=false){
                    $content['productList'] = $productList;
                }else{
                    $OproductList =  $this->otherProductList();
                    $content['productList'] = $OproductList;


                }
            }else{
                $OproductList =  $this->otherProductList();
                $content['productList'] = $OproductList;
            }


            // $content    = ;


            $footer     = $mConfig;
            $fcontent   = $mConfig;
            $this->load->view($mConfig['themes'].'/search/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/search/search',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/search/fsearch',$fcontent);/**/
        }
        public function productList($search){
             $value = "";
            $Result     = $this->search_model->getSearchValue($search);
            if($Result['row']>0){
                $value.='<div class="row">';
                foreach($Result['result'] AS $row){
                    ;
                    $value .='<div class="span3">
                           <div class="product">
                               <a href="'.base_url().str_replace(' ','-',strtolower($row->title)).'/?i='.$row->proid.'"><img class="imgPro"class="imgPro" alt="'.$row->title.'" src="'.base_url().'assets/idial/upload/product/thmb/'.$row->imgName.'"></a>
                                <div class="name">
                                <a href="'.base_url().str_replace(' ','-',strtolower($row->title)).'/?i='.$row->proid.'">'.$row->title.'</a>
                                </div>
                                <div class="price">
                                <p>Rp. '.number_format($row->price,0,"",".").'</p>
                                </div>
                            </div>
                        </div>';


                }
                $value .='</div>';
            }else{
                $value = false;
            }
            return $value;
        }

        public function otherProductList(){
            $value = "";
            $Result     = $this->search_model->getOtherProductValue();
            if($Result['row']>0){
                $value .='<div class="row"><div class="span12" style=""><h2 class="page"  style="padding-left:10px;color: red" >Sorry , We cannot found product that your looking for. </h2></div></div>';
                $value .='<div class="row"><div class="span12"><h2 class="page"  style="border-left: 10px solid #762B90;padding-left:10px" >Checkout Hot product</h2></div></div>';
                $value.='<div class="row">';
                foreach($Result['result'] AS $row){
                    ;
                    $value .='<div class="span3">
                           <div class="product">
                               <a href="'.base_url().str_replace(' ','-',strtolower($row->title)).'/?i='.$row->proid.'"><img class="imgPro"class="imgPro" alt="'.$row->title.'" src="'.base_url().'assets/idial/upload/product/thmb/'.$row->imgName.'"></a>
                                <div class="name">
                                <a href="'.base_url().str_replace(' ','-',strtolower($row->title)).'/?i='.$row->proid.'">'.$row->title.'</a>
                                </div>
                                <div class="price">
                                <p>Rp. '.number_format($row->price,0,"",".").'</p>
                                </div>
                            </div>
                        </div>';


                }
                $value .='</div>';
            }else{
                $value = false;
            }
            return $value;
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

        public function errorPage(){

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
                $this->load->view($mConfig['themes'].'/fpage',$fcontent);/**/

        }



        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */