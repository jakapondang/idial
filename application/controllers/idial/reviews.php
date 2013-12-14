<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Reviews extends CI_Controller {

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
			$this->load->model(array('idial/reviews_model'));


        }


        public function index() {
            $mConfig = $this->cor3->mainConfig();


            $head       = $mConfig;
            $body       = $mConfig;
            $content    = $mConfig;
            $content['pageList']    = $this->getListPage();
            $footer     = $mConfig;
            $fcontent   = $mConfig;
            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/review/review',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/review/freview',$fcontent);
        }

        public function getListPage() {

            $rowpage = $this->reviews_model->getRowPage();
            $digits = "";
            $count = strval($rowpage /5);
            $digits = explode('.' ,$count);
            $countDigits = count($digits);
            if($countDigits >1){
               $count =$digits[0]+1;

            }
            $n = 0;
            $result = "";

            for( $l =0;$l<$count;$l ++){
                $limit[$l] = $n.",5";

                $result .=$this->queryPage($limit[$l]);

                $n += 5;
            } /*
            $l = 0;
            $limit[$l] = "0,5";
            $result .=$this->queryPage($limit[$l]);
            $result .=$this->queryPage($limit[$l]); */

            return $result;

        }

        public function queryPage($limit){
            $div = "";
            $pagid = $this->reviews_model->getPage($limit);
            if(!empty($pagid)){

                $rowPagid = count($pagid);
                $last = $rowPagid-1;

                for($i = 0;$i<$rowPagid; $i ++ ){
                    //meta
                    $metaPage[$i]= $this->reviews_model->getPageMeta($pagid[$i]);
                    if(!empty($metaPage[$i])){
                        foreach( $metaPage[$i] AS $row){
                            $metaValue[$i][$row->meta_key] = $row->meta_value;

                        }
                    }
                    if($i<=2){
                        if($i==0){
                            $div .='<div class="row"><div class="span12" style="border-bottom: 1px solid #f2f2f2;">';
                        }
                        if($i==2){
                            $div .='<div class="span3" style="padding: 10px;width: 270px;text-align: center">';
                        }else{

                            $div .='<div class="span3" style="border-right:1px solid #f2f2f2;padding: 10px;width: 270px;text-align: center">';
                        }
                        //content
                        $div .= '<img src="http://idialcorner.jp/assets/idial/upload/page/'.$metaValue[$i]['imgName'].'" style="width:30%">';
                        $div .= '<p style="padding-top:5px">'.$metaValue[$i]['sdesc'].' </p>';



                        if($i==2){

                            $div .="</div></div></div>";
                        }
                        elseif($i==$last){
                            $div .="</div></div></div>";
                        }else{

                            $div .="</div>";
                        }

                    }else{
                        if($i == 3){
                            $div .='<div class="row"><div class="span12" style="border-bottom: 1px solid #f2f2f2;text-align: center">';

                        }
                        if($i==4){
                            $div .='<div class="span5" style="padding: 30px">';
                        }else{

                            $div .='<div class="span5" style="border-right: 1px solid #f2f2f2;padding: 30px;text-align: center">';
                        }

                        //content
                        $div .= '<img src="http://idialcorner.jp/assets/idial/upload/page/'.$metaValue[$i]['imgName'].'" style="width:50%">';
                        $div .= '<p style="padding-top:5px">'.$metaValue[$i]['sdesc'].' </p>';

                        if($i==$last){
                            $div .="</div></div></div>";
                        }else{

                            $div .="</div>";
                        }

                    }
                }// endfor

            }
           return $div;


        }







        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */