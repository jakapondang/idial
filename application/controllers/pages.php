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
            $content['mainReviews'] = $this->ListReviews("0,5");
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
            $cat1 = urldecode(mysql_real_escape_string($cat1));
            $cat2 = urldecode(mysql_real_escape_string($cat2));
            $proid = urldecode(mysql_real_escape_string($this->input->get('i')));

            $row1 = $this->cor3->cekRowContent2("jp_category" ,array('uri_name'=>$cat1,'status'=>'1','parent_id'=>'0'),"cat_id","name");


            if($cat2!=NULL){
               //catalog
                $row2 = $this->cor3->cekRowContent2("jp_category" ,array('uri_name'=>$cat2,'status'=>'1','parent_id !='=>'0'),"cat_id","name");
                if($row2['row']>0){
                    $result = $this->catalog->catalogProduct($row1['name'],$row2['name'],$row2['cat_id']);

                    if($result!=false){

                        $this->catalog($row1['name'],$row2['name'],$result);
                    }else{

                        $this->noListing($row2['name'],$row2['cat_id']);
                    }
                }else{


                    $this->errorPage();
                }

            }else{
                $cat1 = str_replace('-',' ',$cat1);
                //Brand
                $rowBrand = $this->cor3->cekRowContent2("jp_brand" ,array('name'=>$cat1,'status'=>'1'),"bra_id","name");
                //Product
                $rowPro = $this->cor3->cekRowContent2("jp_product" ,array('pro_id'=>$proid,'name'=>$cat1,'status'=>'1'),"pro_id","name");

                //Parent Cat
                if($row1['row']>0){
                   $Result = $this->catalog->catalogParent($row1['name'],$row1['cat_id']);
                    if($Result != false){
                        $this->catalogParent($cat1,$row1['cat_id'],$Result);
                    }
                    else{
                       // print "theres no listing for this ". $row1['name']." category";
                        $this->noListing($row1['name'],$row1['cat_id']);
                    }
                }elseif($rowBrand['row']>0){
                    $ProductList = $this->catalog->brandProduct($rowBrand['name'],$rowBrand['bra_id']);
                    $this->brand($rowBrand['name'],$rowBrand['bra_id'],$ProductList);


                }elseif($rowPro['row']>0){

                    $this->product($rowPro['name'],$rowPro);

                }else{

                       $this->errorPage();
                }


            }



        }
        public function brand($bname="",$bra_id="",$ProductList)
        {
            $mConfig = $this->cor3->mainConfig();
            $head       = $mConfig;
            $body       = $mConfig;
            $content    = $mConfig;
            $content['category']=  strtoupper($bname);

            $content['product']=$ProductList;

            $footer     = $mConfig;
            $fcontent   = $mConfig;
            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/catalog/pcatalog',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/catalog/fpcatalog',$fcontent);
        }
        public function catalogParent($cat="",$catid="",$ProductList="")
        {
            $mConfig = $this->cor3->mainConfig();
            $head       = $mConfig;
            $body       = $mConfig;
            $content    = $mConfig;
            $content['category']=  strtoupper($cat);

            $content['product']=$ProductList;


            $footer     = $mConfig;
            $fcontent   = $mConfig;
            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/catalog/pcatalog',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/catalog/fpcatalog',$fcontent);
        }
        public function catalog($cat1="",$cat2="",$ProductList="")
        {
            $mConfig = $this->cor3->mainConfig();

            $content    = $mConfig;
            $content['category1']=  strtoupper($cat1);
            $content['category2']=  strtoupper($cat2);
            $content['product']=$ProductList;

            $head       = $content;
            $body       = $mConfig;
            $footer     = $mConfig;
            $fcontent   = $mConfig;
            $this->load->view($mConfig['themes'].'/catalog/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/catalog/catalog',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/catalog/fcatalog',$fcontent);
        }



        public function product($proName="",$rowPro="")
        {
            $mConfig = $this->cor3->mainConfig();

            $content    = $mConfig;

            // product
            $content['pro_name']=  strtoupper($proName);
            $fimage = "";
            //print $prow['val'];

            $result =  $this->catalog->getSingleProduct($rowPro['pro_id']);
            if($result['row']>0){
                //<MAIN PRODUCT
                foreach($result['result'] AS $rowP){
                    $content['bra_id'] =  $rowP->bra_id;
                    $content['sku'] =  $rowP->sku;
                }

                // BRAND
                $resultBrand =  $this->catalog->getSingleBrand($content['bra_id']);
                if($resultBrand){
                    foreach($resultBrand AS $rowB){
                        $content['nameB'] = $rowB->nameB;

                    }
                }
                //Product Price

                $resultPrice =  $this->catalog->getSingleProductprice($rowPro['pro_id']);
                if($resultPrice['row']>0){
                    $resultPrice = $resultPrice['result'];
                    foreach($resultPrice AS $rowPR){
                        $content['gross'] =  $rowPR->gross;

                    }

                }
                // product meta
                $resultMeta =  $this->catalog->getSingleProductMeta($rowPro['pro_id']);
                if($resultMeta['row']>0){
                    $resultMeta = $resultMeta['result'];
                    $imageProduct ="";

                    foreach($resultMeta AS $rowPM){
                        $content[$rowPM->meta_key] =  $rowPM->meta_value;
                        if (strpos($rowPM->meta_key,'imgNametmb') !== false) {
                            $imageProduct[] = $rowPM->meta_value;
                        }
                        if ($rowPM->meta_key=="imgName1") {
                            $fimage = $rowPM->meta_value;
                        }
                    }
                    $content['imageProduct']= $imageProduct;
                    $content['fimage']= $fimage;

                }


            }

            // Related Product
            //Brand
            $relProduct = $this->catalog->getRelatedProduct($content['bra_id'],$rowPro['pro_id']);
            if($relProduct!=false){
                $content['relProduct'] = $relProduct;
            }else{
                $content['relProduct'] = "Theres no relation";
            }

            $head       = $content;
            $body       = $mConfig;
            $footer     = $mConfig;
            $fcontent   = $mConfig;

            $this->load->view($mConfig['themes'].'/product/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/product/product',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/product/fproduct',$fcontent);  /**/
        }

        public function pricelist()
        {
            $mConfig = $this->cor3->mainConfig();
            $head       = $mConfig;
            $body       = $mConfig;

            $content    = $mConfig;
           // $content    = ;


            $footer     = $mConfig;
            $fcontent   = $mConfig;
            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/pricelist/pricelist',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/pricelist/fpricelist',$fcontent);/**/
        }

        public function ListReviews($limit){
            $div = "";
            $pagid = $this->pages_model->getPage($limit);
            if(!empty($pagid)){

                $rowPagid = count($pagid);
                $last = $rowPagid-1;

                for($i = 0;$i<$rowPagid; $i ++ ){
                    //meta
                    $metaPage[$i]= $this->pages_model->getPageMeta($pagid[$i]);
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