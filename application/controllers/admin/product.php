<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Product extends CI_Controller {

        var $table      ="jp_product";
        var $table2      ="jp_productprice";
        var $tableMeta  ="jp_productmeta";
        var $iColumn    = "pro_id";
        var $page       = "product";
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
            $this->load->library(array('cor3','cor3_model','jpupload'));
			$this->load->model(array('admin/product_model'));
            $this->load->helper("file");

            if($this->session->userdata('user_admin')==NULL){
                print '<script>window.location="'.base_url().'jp/?err=2";</script>';
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
             $ColumnOrder =$this->iColumn.",sku,name,nett,gross,status,created,updated";
             $column = $this->iColumn.",sku,name,status,created,updated";
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
            $id = "";
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

            if($this->input->get('id')!=NULL){// if EDIT
                $id = $this->input->get('id');
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
                $editValue = $this->product_model->getValueBrand($table,$iColumn,$id);

                foreach($editValue as $row){
                    $data[$this->iColumn] =  $row->$iColumn;
                    $data['name'] =  $row->name;
                    $data['sku'] =  $row->sku;
                    if($row->status>0){
                        $data['status'] = "checked" ;
                    }else{
                        $data['status'] = "" ;
                    }
                }
                // data edited 2
                $editValue2 = $this->product_model->getValueBrand($this->table2,$iColumn,$id);

                foreach($editValue2 as $row){
                   $data['nett'] =  $row->nett;
                   $data['gross'] =  $row->gross;
                   $data['discount'] =  $row->discount;

                }
                // data meta edited

                $editValuemeta = $this->product_model->getValueBrand($tableMeta,$iColumn,$id);
                $data['imagePreview'] ="";
                foreach($editValuemeta as $row){
                    $data[$row->meta_key] =  $row->meta_value;

                    if($row->meta_key==="imgName1"){
                        $data['imagePreview'] .=  '<div class="controls"><img src="'.base_url().'assets/upload/'.$this->page.'/'.$row->meta_value.'"></div>';
                    }
                    elseif($row->meta_key==="imgName2"){
                        $data['imagePreview'] .=  '<div class="controls"><img src="'.base_url().'assets/upload/'.$this->page.'/'.$row->meta_value.'"></div>';
                    }
                    elseif($row->meta_key==="imgName3"){
                        $data['imagePreview'] .=  '<div class="controls"><img src="'.base_url().'assets/upload/'.$this->page.'/'.$row->meta_value.'"></div>';
                    }
                    elseif($row->meta_key==="imgName4"){
                        $data['imagePreview'] .=  '<div class="controls"><img src="'.base_url().'assets/upload/'.$this->page.'/'.$row->meta_value.'"></div>';
                    }
                    elseif($row->meta_key==="imgName5"){
                        $data['imagePreview'] .=  '<div class="controls"><img src="'.base_url().'assets/upload/'.$this->page.'/'.$row->meta_value.'"></div>';
                    }

                }



            }else{// if NEW
                $pageContentHeader = "Add New";

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
                    "discount"=>"",
                    "status"=>"checked",
                    "parent_id"=>"",
                    "selected"=>"",
                    "sdesc"=>"",
                    "imagePreview" =>"",
                    "error_message"=>$error_message,

                );

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
               //$this->cor3_model->deleteValue($table, $dataWhere);
               // $this->cor3_model->deleteValue($table2, $dataWhere);

                $dataWhere['meta_key'] = "imgName";
                //delete img
                $resultValue = $this->product_model->getValueImage($tableMeta,$id);
                //print_r($resultValue);
                //$this->cor3_model->deleteValue($tableMeta, $dataWhere);
                if(!empty($resultValue)||($resultValue!=NULL)){
                    for($i=0;$i<count($resultValue);$i++ ){
                        print_r($resultValue[$i]);
                        $pathDelete='assets/upload/'.$this->page.'/'.$resultValue[$i]['meta_value'];

                            print $pathDelete."<br/>";
                            //unlink($pathDelete);
                            //delete_files('assets/upload/'.$this->page.'/'.$resultValue);


                    }
                }

                //print "<script>window.location='".base_url()."jp/".$this->page."/?err=3'</script>";


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
                        "sku"=>$sku,
                        "status"=>$status,
                        "author"=>$this->session->userdata('user_id'),
                    );
                }else{
                    $data ="";
                }
                $nett    =  $this->input->post('nett');
                $gross    =  $this->input->post('gross');
                $discount    =  $this->input->post('discount');

                if(!empty($nett)&& !empty($gross)){

                    $data2 = array(
                    "nett"=>$nett,
                    "gross"=>$gross,
                    "discount"=>$discount,

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
                    $data["updated"] = DATE('Y-m-d H:i:s');

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

                    //print_r($imageName);
                    $imgI =1;
                    for($i=0;$i<=count($imageName);$i++){
                        if($imageName[$i]){
                            $dataAttribute["imgName".$imgI] =$imageName[$i]['file_name'];
                        }
                        $imgI ++;
                    }
                    print_r($dataAttribute);

                    $this->action_meta($dataAttribute,$id ,$tableMeta);

                    if(($ResultQuery==TRUE)||($ResultQuery2==TRUE)){
                        print "<script>window.location='".base_url()."admin/".$this->page."/newUpdate/?id=".$id."&err=2".$errUpload."'</script>";
                    }else{
                         print "not updated";
                    }

                }else{
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
                            }
                            $imgI ++;
                        }
                        $this->action_meta($dataAttribute,$ResultQuery['id'] ,$tableMeta);
                        print "<script>window.location='".base_url()."admin/".$this->page."/newUpdate/?id=".$ResultQuery['id']."&err=1".$errUpload."'</script>";

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


                }else{
                    $error_message  = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>';
                    if($err_val == 11 ){

                        $error_message .= '<strong>Sorry , Data Cannot be Delete !</strong><br> Because is PARENT.</div>';
                    }
                    elseif($err_val == 12 ){
                        $error_message .= '<strong>Please fill NAME & SKU. !</strong></div>';
                    }
                }



            }
            return $error_message;
        }



    }

    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */