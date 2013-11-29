<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Brand extends CI_Controller {

        var $table      ="jp_brand";
        var $tableMeta  ="jp_brandmeta";
        var $iColumn    = "bra_id";
        var $page       = "brand";
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
			$this->load->model(array('admin/brand_model'));
            $this->load->helper("file");

            if($this->session->userdata('user_admin')==NULL){
                print '<script>window.location="'.base_url().'jp/?err=2";</script>';
            }

        }
        
         public function index(){

            $err_val = $this->input->get('err');

            $error_message = $this->errorMessage($err_val);

            $themes ="admin";
            $structure = array(
                "dashboard/table/head",
                "dashboard/body",
                "dashboard/".$this->page."/list",
                "dashboard/table/footer");

            $tableName = $this->table;
            $tableName_meta = $this->tableMeta;
            $page = strtoupper($this->page);
            // var table
            $ColumnOrder =$this->iColumn.",meta_value,name,status,created,updated";
            $column = $this->iColumn.",name,status,created,updated";
            $colEnd = count(explode(',',$column));

            $columnWhereKey ='imgName';
            $column2 = "meta_value";
            $colEnd += count(explode(',',$column2));


            $iColumns = $this->iColumn;

            $data = array(
                "site_url"=>base_url(),
                "dashboard" => '',
                "catalog" =>'class="active"' ,
                "extra" =>'' ,
                "urlActionTable"=>$themes.'/tableview/tjoin/?tBn1='.$tableName.'&tBn2='.$tableName_meta.'&Oc='.$ColumnOrder.'&colTab1='.$column.'&colTab2='.$column2.'&icl='.$iColumns.'&cWk='.$columnWhereKey,
                "urlEditRow"=>$themes.'/'.strtolower($page).'/newUpdate/',
                "urlDelRow"=>$themes.'/'.strtolower($page).'/delete/',
                "tableFormName" =>$tableName,
                "tableType" =>"action",
                "colEnd" =>$colEnd,
                "error_message"=>$error_message,
                "pageContent"=>$page,
                "pageContent2"=>"You can see list data of Brand",

            );
            print $this->cor3->html($themes,$structure,$data);

         }


        public function newUpdate(){

            $table = $this->table;
            $tableMeta = $this->tableMeta;
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
                // data edited
                $editCatValue = $this->brand_model->getValueBrand($table,$id);
                $valueEdited = array();
                foreach($editCatValue as $row){
                    $valueEdited[$this->iColumn] =  $row->bra_id;
                    $valueEdited['name'] =  $row->name;
                    $valueEdited['desc'] =  $row->desc;
                    $valueEdited['sdesc'] =  $row->sdesc;
                    if($row->status>0){
                        $valueEdited['status'] = "checked" ;
                    }else{
                        $valueEdited['status'] = "" ;
                    }
                }
                // data meta edited
                $dataWhere = array(
                    $this->iColumn=>$id,
                    "meta_key"=>"imgName"
                );
                $imgName = $this->cor3_model->getSQLvalue_where($tableMeta,$dataWhere,"meta_value");

                // variable html

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
                    "imgName"=>$imgName
                );
                $data = array_merge($data,$valueEdited);

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
                    "status"=>"checked",
                    "parent_id"=>"",
                    "selected"=>"",
                    "sdesc"=>"",
                    "error_message"=>$error_message,

                );

            }

            print $this->cor3->html($themes,$structure,$data);



        }

        public function delete(){


            $id =  $this->input->get('id');
            $table = $this->table;
            $table2 = $this->tableMeta;
            $dataWhere = array($this->iColumn=>$id);
            if(!empty($id)){
               $this->cor3_model->deleteValue($table, $dataWhere);
                $this->cor3_model->deleteValue($table2, $dataWhere);
                $dataWhere['meta_key'] = "imgName";
                //delete img
                $resultValue = $this->cor3_model->getSQLvalue_where($table2,$dataWhere,"meta_value");

                $pathDelete='assets/upload/'.$this->page.'/'.$resultValue;
                if(!empty($resultValue)|| ($resultValue!= NULL)){
                    unlink($pathDelete);
                    //delete_files('assets/upload/'.$this->page.'/'.$resultValue);

                }

                print "<script>window.location='".base_url()."jp/".$this->page."/?err=3'</script>";


            }
        }

        public function action(){


            $table  = $this->table;
            $tableMeta = $this->tableMeta;
            $page = $this->page;

            $id     =  $this->input->post('id');
            $name   = $this->input->post('name');
            $status =  $this->input->post('status');


            //status myquery
            if(empty($status)){
                $status="0";
            }
            $desc   = $this->input->post('desc');
            $sdesc   = $this->input->post('sdesc');

            $data = array(
                "name"=>$name,
                "status"=>$status,
                "desc"=>$desc,
                "sdesc"=>$sdesc
            );

            if(!empty($id)){
                $dataWhere = array(
                    $this->iColumn=>$id
                );
                $data["updated"] = DATE('Y-m-d H:i:s');
                $ResultQuery = $this->cor3_model->updateValue($table, $data, $dataWhere);

                // upload
                $imageName = $this->jpupload->singleUpload($name."-".$id,$this->page);

                if(is_array($imageName)){
                    $insertValue = array();
                    foreach($imageName as $keyimg => $rowimg){
                        $insertValue[] = $keyimg.",".$rowimg;
                    }
                    $insertValue = implode(';', $insertValue); /**/
                }
                // input upload data att
                if(is_array($imageName)){
                    $dataAttribute = array(
                        "imgAtr" =>$insertValue,
                        "imgName" =>$imageName['file_name'],// upload logo
                    );
                    $this->action_meta($dataAttribute,$id ,$tableMeta);
                }
                if($ResultQuery==TRUE){
                    print "<script>window.location='".base_url()."jp/".$this->page."/?err=2'</script>";
                }else{
                    // print "not updated";
                }

            }else{

                $ResultQuery = $this->cor3_model->insertValue($table,$data);
                // upload
                $imageName = $this->jpupload->singleUpload($name."-".$ResultQuery['id'],$this->page);

                if(is_array($imageName)){
                    $insertValue = array();
                    foreach($imageName as $keyimg => $rowimg){
                        $insertValue[] = $keyimg.",".$rowimg;
                    }
                    $insertValue = implode(';', $insertValue); /**/
                }
                // input upload data att
                if($ResultQuery['qstatus']==TRUE){
                    // input upload data att
                    if(is_array($imageName)){
                        $dataAttribute = array(
                            "imgAtr" =>$insertValue,
                            "imgName" =>$imageName['file_name'],// upload logo
                        );
                        $this->action_meta($dataAttribute,$ResultQuery['id'] ,$tableMeta);
                    }
                    print "<script>window.location='".base_url()."admin/".$this->page."/newUpdate/?id=".$ResultQuery['id']."&err=1'</script>";

                }else{
                    //print "not inserted";
                }

            /**/
            }
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
                }



            }
            return $error_message;
        }



    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */