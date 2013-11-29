<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Category extends CI_Controller {

        var $table      ="jp_category";
        var $iColumn    = "cat_id";
        var $page       = "category";
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
            $this->load->library(array('cor3','cor3_model'));
			$this->load->model(array('admin/category_model'));
            if($this->session->userdata('user_admin')==NULL){
                print "<script>window.location='".base_url()."jp/?err=2'</script>";
            }

        }
        
         public function index(){


             $err_val = $this->input->get('err');
             $error_message = $this->errorMessage($err_val);

            $themes ="admin";
            $structure = array(
                "dashboard/table/head",
                "dashboard/body",
                "dashboard/category/list",
                "dashboard/table/footer");


            $tableName =$this->table;
            $page = strtoupper($this->page);
            $column = "cat_id,parent_id,name,status,created,updated";
            $colEnd = count(explode(',',$column));
            $iColumns = $this->iColumn;


            $data = array(
                "site_url"=>base_url(),
                "dashboard" => '',
                "catalog" =>'class="active"' ,
                "extra" =>'' ,
                "urlActionTable"=>$themes.'/tableview/?tBn='.$tableName.'&colTab='.$column.'&icl='.$iColumns,
                "urlEditRow"=>$themes.'/'.strtolower($page).'/newUpdate/',
                "urlDelRow"=>$themes.'/'.strtolower($page).'/delete/',
                "tableFormName" =>$tableName,
                "tableType" =>"action",
                "colEnd" =>$colEnd,
                "error_message"=>$error_message,
                "pageContent"=>$page,
                "pageContentLink"=>strtolower($page),
                "pageContent2"=>"You can see list data of Category",

            );
            print $this->cor3->html($themes,$structure,$data);

         }

        public function newUpdate(){

            $table = $this->table;
            $id = "";
            $edit = "";
            $error_message="";

            //themes
            $themes ="admin";
            $page = strtoupper($this->page);
            $structure = array(
                "dashboard/form/head",
                "dashboard/body",
                "dashboard/category/form",
                "dashboard/form/footer");

            if($this->input->get('id')!=NULL){// if EDIT
                $id = $this->input->get('id');
                $pageContentHeader = "Edit";
                $edit = "AND cat_id !=".$id." ";

                    // data edited
                    $editCatValue = $this->category_model->getValueCategory($table,$id);
                    $valueEdited = array();
                    foreach($editCatValue as $row){
                        $valueEdited['parent_id'] =  $row->parent_id;
                        $valueEdited['name'] =  $row->name;
                        $valueEdited['desc'] =  $row->desc;
                        $valueEdited['sdesc'] =  $row->sdesc;
                        if($row->status>0){
                            $valueEdited['status'] = "checked" ;
                        }else{
                            $valueEdited['status'] = "" ;
                        }
                    }

                    // data parent selected
                    $parentValue = $this->category_model->getParentCategory($table,$edit);
                    $Count = count($parentValue);


                    for($i=0;$i<$Count;$i++){

                        if(in_array($valueEdited['parent_id'], $parentValue[$i])){

                            $parentValue[$i]['selected']="selected";

                        }else{
                            $parentValue[$i]['selected']="";
                        }

                    }
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
                        "parentValue"=>$parentValue,
                        //"editCatValue"=>$editCatValue,

                    );
                    $data = array_merge($data,$valueEdited);

            }else{// if NEW
                $pageContentHeader = "Add New";
                $parentValue = $this->category_model->getParentCategory($table,$edit);
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
                    "parentValue"=>$parentValue,
                    "cat_id"=>"",
                    "name"=>"",
                    "desc"=>"",
                    "sdesc"=>"",
                    "status"=>"checked",
                    "parent_id"=>"",
                    "selected"=>"",

                );

            }

            print $this->cor3->html($themes,$structure,$data);



        }

        public function delete(){
           $id =  $this->input->get('id');
           $table = $this->table;
           $dataWhere = array($this->iColumn=>$id);
           if(!empty($id)){
            //cek parent register another category
            $Result = $this->cor3_model->getNumberRow($table,$this->iColumn,"parent_id",$id);
            if($Result>0){
                print "<script>window.location='".base_url()."jp/".$this->page."/?err=11'</script>";
            }else{
                print "<script>window.location='".base_url()."jp/".$this->page."/?err=3'</script>";
            }
            // $this->cor3_model->deleteValue($table, $dataWhere);

            // print "<script>window.location='".base_url()."jp/".$this->page."/?err=3'</script>";
               //print "<script>window.location='".base_url()."jp/category'</script>";

           }
        }

        public function action(){

            $table  = $this->table;
            $id     =  $this->input->post('id');
            $parent_id     =  $this->input->post('parent_id');
            $name   = $this->input->post('name');
            $status =  $this->input->post('status');

            if(empty($status)){
                $status="0";
            }
            $desc   = $this->input->post('desc');
            $sdesc   = $this->input->post('sdesc');
            $data = array(
                "parent_id"=>$parent_id,
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
                if($ResultQuery==TRUE){
                    print "<script>window.location='".base_url()."jp/".$this->page."/?err=2'</script>";
                }else{
                   print "not updated";
                }

            }else{

                $ResultQuery = $this->cor3_model->insertValue($table,$data);
                if($ResultQuery['qstatus']==TRUE){

                    print "<script>window.location='".base_url()."jp/".$this->page."/?err=1'</script>";
                }else{
                    print "not inserted";
                }

            }/**/

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