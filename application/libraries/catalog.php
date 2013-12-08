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
           $returnValue .= '<li><a href="#"><img src="'.base_url().'assets/upload/brand/'.$row->imgName.'" alt="'.$row->nameB.'" title="'.$row->nameB.'" /></a></li>';
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
               $brand[$i]   = $this->CI->catalog_model->getCategoryLValue($tableCat,$catid[$i]);
               $Result[$i]      = $this->CI->catalog_model->getProductALLValue($table1,$table2,$table3,$catid[$i]);
               $value .='<div class="row"><div class="span12"><h2>'.$brand[$i].'</h2></div></div>';
                foreach($Result[$i] AS $row){
                    $value .='<div class="row">
                   <div class="span3">
                       <div class="product">
                           <a href="product.html"><img alt="iphone 5" src="'.base_url().'assets/upload/product/'.$row->imgName.'"></a>
                            <div class="name">
                            <a href="#">'.$row->title.'</a>
                            </div>
                            <div class="price">
                            <p>Rp. '.number_format($row->price,0,"",".").'</p>
                            </div>
                        </div>
                    </div>
                </div>';

                }


            }
        }
        return $value;

    }


}
?>
