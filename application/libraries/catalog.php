<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Catalog {

    var $themes = 'idial';
	
	function Catalog(){
			$this->CI =& get_instance();
            $this->CI->load->model(array('catalog_model'));
			$this->CI->load->helper(array('url'));
			//$this->CI->load->library(array('parser','email','session'));
			//,'session','email'
			//$this->CI->load->model(array('core3_model'));
			
	}
	
   function brandlist(){
       $table1 = 'jp_brand';
       $table2 = 'jp_brandmeta';
       $Result = $this->CI->catalog_model->getBrandValue($table1,$table2);
       $returnValue = '';
       if($Result){
           foreach($Result as $row){
           $returnValue .= '<li><a href="'.base_url().str_replace(" ", "-",strtolower($row->nameB)).'"><img class="brandList"src="'.base_url().'assets/'.$this->themes.'/upload/brand/thmb/'.$row->tmbName.'" alt="'.$row->nameB.'" title="'.$row->nameB.'" /></a></li>';
               }
       }
       return $returnValue;
   }

    function mainCategoryProduct($configValue){
        $tableCat = "jp_category";
        $table1 = 'jp_product';
        $table2 = 'jp_productmeta';
        $table3 = 'jp_productprice';
        $catid  = explode(',',$configValue);
        $value = "";
        for($i=0;$i<count($catid);$i++){
            if($catid[$i]>0){
               $category[$i]   = $this->CI->catalog_model->getCategoryLValue($tableCat,$catid[$i]);
               $pcategory[$i]   = $this->CI->catalog_model->getCategoryLValue($tableCat, $category[$i]['parid']);

               $Result[$i]      = $this->CI->catalog_model->getProductALLValue($table1,$table2,$table3,$catid[$i]);

               $value .='<div class="row"><div class="span12"><a href="'.base_url().str_replace(' ','-',strtolower($pcategory[$i]['name'])).'/'.str_replace(' ','-',strtolower($category[$i]['name'])).'"><h2 class="page"  style="border-left: 10px solid #762B90;padding-left:10px">'.$category[$i]['name'].'</h2></a></div></div>';
                $value .='<div class="row">';
                foreach($Result[$i] AS $row){

                    $value.='<div class="span3">
                       <div class="product">
                           <a href="'.base_url().urlencode(str_replace(' ','-',strtolower($row->title))).'/?i='.$row->proid.'"><img class="imgPro"alt="'.$row->title.'" src="'.base_url().'assets/'.$this->themes.'/upload/product/thmb/'.$row->imgName.'"></a>
                            <div class="name">
                            <a href="'.base_url().urlencode(str_replace(' ','-',strtolower($row->title))).'/?i='.$row->proid.'">'.$row->title.'</a>
                            </div>
                            <div class="price">
                            <p>Rp. '.number_format($row->price,0,"",".").'</p>
                            </div>
                        </div>
                    </div>';


                }
                $value.='</div>';


            }
        }
        return $value;

    }
 function catalogName($parentid){
        $tableCat = "jp_category";
        $parentName = $this->CI->catalog_model->getCategorySValue($tableCat,$parentid);
        return $parentName;
    }
    function brandProduct($name,$braid){
        $table1 = 'jp_product';
        $table2 = 'jp_productmeta';
        $table3 = 'jp_productprice';

        $value = "";
        $Result     = $this->CI->catalog_model->getAllBrandProduct($table1,$table2,$table3,$braid);
        if($Result['row']>0){
            $value.='<div class="row">';
            foreach($Result['result'] AS $row){
                ;
                $value .='<div class="span3">
                               <div class="product">
                                   <a href="'.base_url().urlencode(str_replace(' ','-',strtolower($row->title))).'/?i='.$row->proid.'"><img class="imgPro"alt="'.$row->title.'" src="'.base_url().'assets/'.$this->themes.'/upload/product/thmb/'.$row->imgName.'"></a>
                                    <div class="name">
                                    <a href="'.base_url().urlencode(str_replace(' ','-',strtolower($row->title))).'/?i='.$row->proid.'">'.$row->title.'</a>
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
        //
    }

  function catalogParent($cat1,$catid){

        $table1 = 'jp_product';
        $table2 = 'jp_productmeta';
        $table3 = 'jp_productprice';

        $value = "";
        $Result     = $this->CI->catalog_model->getCatalogValue($table1,$table2,$table3,$catid);
        if($Result['row']>0){
            $value.='<div class="row">';
            foreach($Result['result'] AS $row){
               ;
                $value .='<div class="span3">
                           <div class="product">
                               <a href="'.base_url().urlencode(str_replace(' ','-',strtolower($row->title))).'/?i='.$row->proid.'"><img class="imgPro"class="imgPro" alt="'.$row->title.'" src="'.base_url().'assets/'.$this->themes.'/upload/product/thmb/'.$row->imgName.'"></a>
                                <div class="name">
                                <a href="'.base_url().urlencode(str_replace(' ','-',strtolower($row->title))).'/?i='.$row->proid.'">'.$row->title.'</a>
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
    function catalogProduct($cat1,$cat2,$catid){
        //print $catid;
        $table1 = 'jp_product';
        $table2 = 'jp_productmeta';
        $table3 = 'jp_productprice';

        $value = "";
        $Result     = $this->CI->catalog_model->getCatalogValue($table1,$table2,$table3,$catid);
        if($Result['row']>0){
            $value.='<div class="row">';
            foreach($Result['result'] AS $row){
                ;
                $value .='<div class="span3">
                           <div class="product">
                               <a href="'.base_url().urlencode(str_replace(' ','-',strtolower($row->title))).'/?i='.$row->proid.'"><img class="imgPro"alt="'.$row->title.'" src="'.base_url().'assets/'.$this->themes.'/upload/product/thmb/'.$row->imgName.'"></a>
                                <div class="name">
                                <a href="'.base_url().urlencode(str_replace(' ','-',strtolower($row->title))).'/?i='.$row->proid.'">'.$row->title.'</a>
                                </div>
                                <div class="price">
                                <p>Rp. '.number_format($row->price,0,"",".").'</p>
                                </div>
                            </div>
                        </div>';


            }
            $value .='</div>';
        }else{
            $value =false;
        }




        return $value;

    }

    function getSingleProduct($proid){

        $table = 'jp_product';
        $Result    = $this->CI->catalog_model->getSingleProduct($table,$proid);

        return $Result;
    }
    function getSingleProductMeta($proid){
        $table = 'jp_productmeta';
        $Result    = $this->CI->catalog_model->getSingleProductMeta($table,$proid);

        return $Result;
    }
    function getSingleProductprice($proid){
        $table = 'jp_productprice';
        $Result    = $this->CI->catalog_model->getSingleProductprice($table,$proid);

        return $Result;
    }

    function getSingleBrand($bra_id){

        $Result     = $this->CI->catalog_model->getSingleBrand($bra_id);
        return $Result;
    }


    function getRelatedProduct($bra_id,$pro_id){
        $value ="";
        $Result = $this->CI->catalog_model->getRelatedProduct($bra_id,$pro_id);
        if($Result['row']>0){
            $value.='<div class="row">';
            foreach($Result['result'] AS $row){
                ;
                $value .='<div class="span3">
                           <div class="product">
                               <a href="'.base_url().urlencode(str_replace(' ','-',strtolower($row->title))).'/?i='.$row->proid.'"><img class="imgPro"alt="'.$row->title.'" src="'.base_url().'assets/'.$this->themes.'/upload/product/thmb/'.$row->imgName.'"></a>
                                <div class="name">
                                <a href="'.base_url().urlencode(str_replace(' ','-',strtolower($row->title))).'/?i='.$row->proid.'">'.$row->title.'</a>
                                </div>
                                <div class="price">
                                <p>Rp. '.number_format($row->price,0,"",".").'</p>
                                </div>
                            </div>
                        </div>';


            }
            $value .='</div>';
        }else{
            $value =false;
        }
        return $value;
    }


}
?>
