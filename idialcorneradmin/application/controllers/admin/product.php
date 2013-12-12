<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Product extends CI_Controller {

        var $table      ="jp_product";
        var $table2      ="jp_productprice";
        var $tableMeta  ="jp_productmeta";
        var $iColumn    = "pro_id";
        var $page       = "product";
        var $imageLink  = "http://idialcorner.jp/assets/idial/upload/";
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
            $this->load->library(array('cor3','cor3_model','jpupload','csvreader'));
			$this->load->model(array('admin/product_model'));
            $this->load->helper("file");

            if($this->session->userdata('user_admin')==NULL){
                print '<script>window.location="'.base_url().'?err=2";</script>';
            }

        }

         public function index(){

             $err_val = $this->input->get('err');
             $error_message = $this->errorMessage($err_val);
             $page= $this->page;
             $iColumn=$this->iColumn;
             $themes ="admin";
             $structure = array(
                 "dashboard/table/head",
                 "dashboard/body",
                 "dashboard/".$page."/list",
                 "dashboard/table/footer");


             $tableName =$this->table;
             $page = strtoupper($this->page);
             // var table
             $ColumnOrder =$this->iColumn.",cat_id,bra_id,sku,name,nett,gross,status,updated";
             $column = $this->iColumn.",cat_id,bra_id,sku,name,status,updated";
             $colEnd = count(explode(',',$column));

             $column2 = "nett,gross";
             $colEnd += count(explode(',',$column2));

             $data = array(
                 "site_url"=>base_url(),
                 "dashboard" => '',
                 "catalog" =>'class="active"' ,
                 "extra" =>'' ,
                 "urlActionTable"=>$themes.'/tableview/ijoin/?tBn1='.$this->table.'&tBn2='.$this->table2.'&Oc='.$ColumnOrder.'&colTab1='.$column.'&colTab2='.$column2.'&icl='.$iColumn,
                 "urlEditRow"=>$themes.'/'.strtolower($page).'/newUpdate/',
                 "urlDelRow"=>$themes.'/'.strtolower($page).'/delete/',
                 "urlImpPro"=>strtolower($page).'/import/' ,
                 "tableFormName" =>$tableName,
                 "tableType" =>"action",
                 "colEnd" =>$colEnd,
                 "error_message"=>$error_message,
                 "pageContent"=>$page,
                 "pageContentLink"=>strtolower($page),
                 "pageContent2"=>"You can see list data of ".$page,

             );
             print $this->cor3->html($themes,$structure,$data);

         }


        public function newUpdate(){

            $table = $this->table;
            $tableMeta = $this->tableMeta;
            $iColumn = $this->iColumn;

            //error
            $err_val = $this->input->get('err');
            $error_message = $this->errorMessage($err_val);

            //themes
            $themes ="admin";
            $page = strtoupper($this->page);
            $structure = array(
                "dashboard/form/head",
                "dashboard/body",
                "dashboard/".$this->page."/form",
                "dashboard/form/footer");

            $id = $this->input->get('id');
            $brandValue = $this->product_model->getBrand();
            $catValue = $this->product_model->getCategory2();
            $catName = $this->product_model->getCategoryALL();

            if(!empty($id)){// if EDIT

                $pageContentHeader = "Edit";
                $data = array(
                    "site_url"=>base_url(),
                    "dashboard" => '',
                    "catalog" =>'class="active"' ,
                    "extra" =>'',
                    "pageContent"=>$page,
                    "id"=>$id,
                    "pageContentLink"=>strtolower($page),
                    "pageContentHeader" =>$pageContentHeader,
                    "pageContent2"=>"You can ".$pageContentHeader." Content here",
                    "error_message"=>$error_message,


                );
                // data edited 1
                $editValue = $this->product_model->getValue($table,$iColumn,$id);

                foreach($editValue as $row){
                    $data[$this->iColumn] =  $row->$iColumn;
                    $data['name'] =  $row->name;
                    $data['cat_id'] =  $row->cat_id;
                    $data['bra_id'] =  $row->bra_id;
                    $data['sku'] =  $row->sku;


                    if($row->status>0){
                        $data['status'] = "checked" ;
                    }else{
                        $data['status'] = "" ;
                    }
                }


                // data BRAND selected

                $Count = count($brandValue);

                for($i=0;$i<$Count;$i++){

                    if(in_array($data['bra_id'], $brandValue[$i])){

                        $brandValue[$i]['selected']="selected";

                    }else{
                        $brandValue[$i]['selected']="";
                    }

                }
                 $data['brandValue'] = $brandValue;

                // data Category selected

                $Count = count($catValue);

                for($i=0;$i<$Count;$i++){

                    if(in_array($data['cat_id'], $catValue[$i])){

                        $catValue[$i]['selected']="selected";

                    }else{
                        $catValue[$i]['selected']="";
                    }

                    if($catValue[$i]['parid']>0){
                        $catValue[$i]['nameP'] = $catName[$catValue[$i]['parid']]." >> ".$catValue[$i]['nameP'];

                    }

                }
                $data['catValue'] = $catValue;

                // data edited 2
                $editValue2 = $this->product_model->getValue($this->table2,$iColumn,$id);

                foreach($editValue2 as $row){
                   $data['nett'] =  $row->nett;
                   $data['gross'] =  $row->gross;
                   //$data['discount'] =  $row->discount;
                    $data['stock'] =  $row->stock;

                }
                // data meta edited
                $data['desc'] = $this->product_model->cekGetValue($tableMeta,array('pro_id'=>$id,'meta_key'=>'desc'),'meta_value');
                $data['sdesc'] = $this->product_model->cekGetValue($tableMeta,array('pro_id'=>$id,'meta_key'=>'sdesc'),'meta_value');
                //$data['desc'] =   $this->product_model->getValueMeta($tableMeta,$id,'desc');

                $editValuemeta = $this->product_model->getValueImage($tableMeta,$iColumn,$id);
                //print_r($editValuemeta);
                $data['imagePreview'] ="";
                foreach($editValuemeta as $row){
                    $data[$row->meta_key] =  $row->meta_value;

                    if($row->meta_key==="imgName1"){
                        $data['imagePreview'] .=  '<div class="controls"><img src="'.$this->imageLink.$this->page.'/'.$row->meta_value.'"></div>';
                    }
                    elseif($row->meta_key==="imgName2"){
                        $data['imagePreview'] .=  '<div class="controls"><img src="'.$this->imageLink.$this->page.'/'.$row->meta_value.'"></div>';
                    }
                    elseif($row->meta_key==="imgName3"){
                        $data['imagePreview'] .=  '<div class="controls"><img src="'.$this->imageLink.$this->page.'/'.$row->meta_value.'"></div>';
                    }
                    elseif($row->meta_key==="imgName4"){
                        $data['imagePreview'] .=  '<div class="controls"><img src="'.$this->imageLink.$this->page.'/'.$row->meta_value.'"></div>';
                    }
                    elseif($row->meta_key==="imgName5"){
                        $data['imagePreview'] .=  '<div class="controls"><img src="'.$this->imageLink.$this->page.'/'.$row->meta_value.'"></div>';
                    }

                }



            }else{// if NEW
                $pageContentHeader = "Add New";
                // data parent selected

                $data = array(
                    "site_url"=>base_url(),
                    "dashboard" => '',
                    "catalog" =>'class="active"' ,
                    "extra" =>'',
                    "pageContent"=>$page,
                    "id"=>$id,
                    "pageContentLink"=>strtolower($page),
                    "pageContentHeader" =>$pageContentHeader,
                    "pageContent2"=>"You can ".$pageContentHeader." Content here",
                    $this->iColumn=>"",
                    "name"=>"",
                    "desc"=>"",
                    "sku"=>"",
                    "nett"=>"",
                    "gross"=>"",
                    //"discount"=>"",
                    "stock"=>"",
                    "status"=>"checked",
                    "parent_id"=>"",
                    "selected"=>"",
                    "sdesc"=>"",
                    "imagePreview" =>"",
                    "error_message"=>$error_message,
                    'brandValue' => $brandValue,

                );
                // data Category

                $Count = count($catValue);

                for($i=0;$i<$Count;$i++){

                   if($catValue[$i]['parid']>0){
                        $catValue[$i]['nameP'] = $catName[$catValue[$i]['parid']]." >> ".$catValue[$i]['nameP'];

                    }

                }
                $data['catValue'] = $catValue;


            }

           print $this->cor3->html($themes,$structure,$data);



        }

        public function delete(){


            $id =  $this->input->get('id');
            $table = $this->table;
            $table2 = $this->table2;
            $tableMeta  =$this->tableMeta;
            $dataWhere = array($this->iColumn=>$id);
            if(!empty($id)){
               $this->cor3_model->deleteValue($table, $dataWhere);
               $this->cor3_model->deleteValue($table2, $dataWhere);
                //delete img
                $resultValue = $this->product_model->getValueImage($tableMeta,$this->iColumn,$id);
                //print_r($resultValue);

                if(!empty($resultValue)||($resultValue!=NULL)){
                    $this->cor3_model->deleteValue($tableMeta, $dataWhere);
                    foreach($resultValue as $row){

                       $pathDelete1='../assets/idial/upload/'.$this->page.'/'.$row->meta_value;
                       $pathDelete2='../assets/idial/upload/'.$this->page.'/thmb/'.$row->meta_value;
                       unlink($pathDelete1);
                        unlink($pathDelete2);
                       //delete_files('assets/upload/'.$this->page.'/'.$resultValue);


                    }
                }

                print "<script>window.location='".base_url().$this->page."/?err=3'</script>";/**/


            }
        }


        public function action(){


            $table  = $this->table;
            $tableMeta = $this->tableMeta;
            $page = $this->page;

            $id     =  $this->input->post('id');
            $name   = $this->input->post('name');
            $status =  $this->input->post('status');
            $sku    =  $this->input->post('sku');
            $cat_id = $this->input->post('cat_id');
            $bra_id = $this->input->post('bra_id');

            if(!empty($name)&&!empty($sku)){
                //status myquery
                if(empty($status)){
                    $status="0";
                }
                $desc   = $this->input->post('desc');
                $sdesc   = $this->input->post('sdesc');


                if(!empty($name)&& !empty($sku)){
                    $data = array(
                        "name"=>$name,
                        "bra_id"=>$bra_id,
                        "cat_id"=>$cat_id,
                        "sku"=>$sku,
                        "status"=>$status,
                        "author"=>$this->session->userdata('user_id'),
                    );
                }else{
                    $data ="";
                }
                $nett    =  $this->input->post('nett');
                $gross    =  $this->input->post('gross');
                //$discount    =  $this->input->post('discount');
                $stock    =  $this->input->post('stock');


                if(!empty($nett)&& !empty($gross)){

                    $data2 = array(
                    "nett"=>$nett,
                    "gross"=>$gross,
                    //"discount"=>$discount,
                     "stock"=>$stock

                    );
                }else{
                    $data2 = "";
                }

                $dataAttribute = array(
                    "desc"=>$desc,
                    "sdesc"=>$sdesc,// Description
                );

                if(!empty($id)){
                    $dataWhere = array(
                        $this->iColumn=>$id
                    );


                    if(!empty($data)){
                        $ResultQuery = $this->cor3_model->updateValue($table, $data, $dataWhere);
                    }

                    if(!empty($data2)){

                        $returnRow = $this->cor3_model->GetNumber_Row($this->table2,$dataWhere);
                        if($returnRow>0){

                            $ResultQuery2 = $this->cor3_model->updateValue($this->table2, $data2, $dataWhere);

                        }else{
                            $data2[$this->iColumn] = $id;
                            $ResultQuery2 = $this->cor3_model->insertValue($this->table2, $data2);
                        }
                    }
                    //upload
                     $imageName = $this->jpupload->multiUpload($name."-".$id,$this->page);
                    // input upload data att
                    $rowIMG = count($imageName);
                    $imgI =1;
                    for($i=0;$i<=$rowIMG;$i++){
                        if($imageName[$i]){
                           // $resizeImage = $this->jpupload->resizeUpload($this->page,$imageName['file_name']);
                            $dataAttribute["imgName".$imgI] =$imageName[$i]['file_name'];

                            $dataAttribute["imgNametmb".$imgI] = $this->jpupload->resizeUpload($this->page,$imageName[$i]['file_name'],400,400);
                        }
                        $imgI ++;
                    }


                    $actionMeta = $this->action_meta($dataAttribute,$id ,$tableMeta);

                    if(($ResultQuery==TRUE)||($ResultQuery2==TRUE)||($rowIMG>0) ){
                        print "<script>window.location='".base_url()."admin/".$this->page."/newUpdate/?id=".$id."&err=2'</script>";
                    }else{
                         print "not updated";
                    }

                }else{
                    $data["created"] = DATE('Y-m-d H:i:s');
                    if(!empty($data)){
                        $ResultQuery = $this->cor3_model->insertValue($table,$data);
                    }
                    if(!empty($data2)){
                        if(!empty($ResultQuery['id'])){
                            $data2[$this->iColumn] = $ResultQuery['id'];
                            $ResultQuery = $this->cor3_model->insertValue($this->table2,$data2);
                        }

                    }

                    // input upload data att
                    if($ResultQuery['qstatus']==TRUE){
                        //upload
                         $imageName = $this->jpupload->multiUpload($name."-".$ResultQuery['id'],$this->page);
                        // input upload data att

                        //print_r($imageName);
                        $imgI =1;
                        for($i=0;$i<=count($imageName);$i++){
                            if($imageName[$i]){
                                $dataAttribute["imgName".$imgI] =$imageName[$i]['file_name'];
                                $dataAttribute["imgNametmb".$imgI] = $this->jpupload->resizeUpload($this->page,$imageName[$i]['file_name'],400,400);
                            }
                            $imgI ++;
                        }
                        $this->action_meta($dataAttribute,$ResultQuery['id'] ,$tableMeta);
                        print "<script>window.location='".base_url()."admin/".$this->page."/newUpdate/?id=".$ResultQuery['id']."&err=1'</script>";

                    }else{
                        print "not inserted";
                    }


                }
            }else{
                print "<script>window.location='".base_url()."admin/".$this->page."/newUpdate/?err=12'</script>";
            }/**/
        }

        public function action_meta($dataAttribute=array(),$id ,$tableMeta){



            foreach($dataAttribute as $keyName => $valName){

                $dataWhere = array(
                    $this->iColumn=>$id,
                    "meta_key"=>$keyName,
                );
                //cek if meta key exist
                $cekRowAttribute = $this->cor3_model->GetNumber_Row($tableMeta ,$dataWhere);

                if($cekRowAttribute>0){
                    //cek if the same
                    $dataWhere_ts = array(
                        $this->iColumn=>$id,
                        "meta_key"=>$keyName,
                        "meta_value"=>$valName
                    );
                    $cekRowAttribute_ts = $this->cor3_model->GetNumber_Row($tableMeta ,$dataWhere_ts);
                    if($cekRowAttribute_ts== 0){
                        $dataValue = array(
                            "meta_value"=>$valName,
                        );
                        $resultQuery =  $this->cor3_model->updateValue($tableMeta,$dataValue,$dataWhere);

                    }
                }else{
                    $dataValue = array(
                        $this->iColumn=>$id,
                        "meta_key"=>$keyName,
                        "meta_value"=>$valName,
                    );
                    $resultQuery = $this->cor3_model->insertValue($tableMeta,$dataValue);

                }
            }//foreach


        }


        public function errorMessage($err_val=""){
            $error_message="";
            if($err_val != null){//
                if(($err_val>0)&&($err_val<11)){
                    $error_message  = '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>';
                    if($err_val == 1 ){
                        $error_message .= '<strong>Data Successfully Inserted..</strong></div>';

                    }
                    elseif($err_val == 2){
                        $error_message .= '<strong>Data Successfully Updated.</strong></div>';

                    }
                    elseif($err_val == 3 ){
                        $error_message .= '<strong>Data Has been Deleted. !</strong></div>';
                    }
                    elseif($err_val == 4 ){
                        $error_message .= '<strong>Data Has been Imported. !</strong></div>';
                    }


                }else{
                    $error_message  = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>';
                    if($err_val == 11 ){

                        $error_message .= '<strong>Sorry , Data Cannot be Delete !</strong><br> Because is PARENT.</div>';
                    }
                    elseif($err_val == 12 ){
                        $error_message .= '<strong>Please fill NAME & SKU. !</strong></div>';
                    }
                    elseif($err_val == 13 ){
                        $error_message .= '<strong>Your files is empty , please browse the import file .csv !</strong></div>';
                    }
                }



            }
            return $error_message;
        }

        public function importproduct(){
            $err_val = $this->input->get('err');
            $error_message = $this->errorMessage($err_val);
            $page= $this->page;
            $iColumn=$this->iColumn;
            $themes ="admin";
            $structure = array(
                "dashboard/head",
                "dashboard/body",
                "dashboard/".$page."/impexp",
                "dashboard/form/footer"
            );
            $data = array(
                "site_url"=>base_url(),
                "dashboard" => '',
                "catalog" =>'class="active"' ,
                "extra" =>'' ,
                "error_message"=>$error_message,
                "pageContent"=>strtoupper($page),
                "pageContentLink"=>$page,
                "pageContent2"=>"You can import your data ".strtoupper($page),
            );

            print $this->cor3->html($themes,$structure,$data);

        }
        public function action_import(){

           $data = "";
           $result =  $this->jpupload->csvUpload();
            if($result['error']>0){//not success
                print "<script>window.location='".base_url().$this->page."/import/?err=".$result['error']."';</script>";
            }else{//success upload

                $csvData = $this->csvreader->parse_file($result['import']);

                $i =0;
                $error =array();
                foreach($csvData AS $row){
                    //product main
                    $data[$i] = array(
                        "cat_id"=>$row['cat_id'],
                        "bra_id"=>$row['bra_id'],
                        "name"=>$row['name'],
                        "sku"=>$row['sku'],
                        "status"=>$row['status'],
                        "created"=>date("Y-m-d H:i:s"),
                        "author"=>$this->session->userdata('user_id')
                    );

                    //product price
                    $data2[$i] = array(
                        "nett"=>$row['nett'],
                        "gross"=>$row['gross'],
                        "stock"=>$row['stock']
                    );

                    if(($row['pro_id']>0)||($row['pro_id']!=NULL)||!empty($row['pro_id'])){
                        $Whereid[$i]= array('pro_id'=>$row['pro_id']);
                        // product main
                        $result = $this->import_insert_updated($this->table,$Whereid[$i] ,$data[$i]);
                        // product price
                        $result2 = $this->import_insert_updated($this->table2,$Whereid[$i] ,$data2[$i]);


                    }else{
                       // product main
                        $result = $this->cor3_model->insertValue($this->table,$data[$i]);
                        if($result['id']>0){// product price if id exist
                            $id[$i]= array('pro_id'=>$result['id']);
                            $data2[$i] = array_merge($id[$i], $data2[$i]);
                            $result2 = $this->cor3_model->insertValue($this->table2,$data2[$i]);

                        }else{

                        }

                    }
                    $i++;
                }// end foreach


                   print "<script>window.location='".base_url().$this->page."/import/?err=4';</script>";

               /* if(!$error){ //success}else{
                   print "<script>window.location='".base_url().$this->page."/import/?err=14&mess=".$error."';</script>";
               }*/

            }
        }

        function import_insert_updated($table,$Whereid ,$data){

            $rowExist = $this->cor3_model->GetNumber_Row ($table,$Whereid);
             if($rowExist>0){
                 $result =  $this->cor3_model->updateValue($table, $data,$Whereid);
                //print_r($data);

             }else{
                if($table==$this->table2){
                    $join =array_merge( $Whereid ,$data);

                    $result = $this->cor3_model->insertValue($table,$join);
                }else{
                    $result = $this->cor3_model->insertValue($table,$data);
                }

             }
            return $result;


        }



    }

    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */