<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Page extends CI_Controller {

        var $table      ="jp_page";
        var $table2     ="jp_pagemeta";
        var $iColumn    = "pag_id";
        var $page       = "page";
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
            $this->load->library(array('cor3','cor3_model','jpupload'));
			$this->load->model(array('admin/page_model'));
            $this->load->helper("file");

            if($this->session->userdata('user_admin')==NULL){
                print '<script>window.location="'.base_url().'?err=2";</script>';
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
            $column = $this->iColumn.",name,status,created,updated";
             $colEnd = count(explode(',',$column));
             $iColumns = $this->iColumn;


             $data = array(
                 "site_url"=>base_url(),
                 "dashboard" => '',
                 "catalog" =>'' ,
                 "extra" =>'' ,
                 "page" =>'class="active"' ,
                 "urlActionTable"=>$themes.'/tableview/?tBn='.$this->table.'&colTab='.$column.'&icl='.$iColumns,
                 "urlEditRow"=>$themes.'/'.$this->page.'/newUpdate/',
                 "urlDelRow"=>$themes.'/'.$this->page.'/delete/',
                 "tableFormName" =>$this->table,
                 "tableType" =>"action",
                 "colEnd" =>$colEnd,
                 "error_message"=>$error_message,
                 "pageContent"=>strtoupper($this->page),
                 "pageContentLink"=>$this->page,
                 "pageContent2"=>"You can see list data of ".strtoupper($this->page."s"),


             );
             print $this->cor3->html($themes,$structure,$data);

         }

        public function previewPage() {
            $desc = $this->input->post('pdesc_pre');
            $id = $this->input->post('id');

            $goback = '<div class="header row">
            <div class="container">
                <div class="row">
                    <div class="span12" style="text-align: center">
                       <a href="#" onclick="window.close();"> <h3>GO BACK EDITING PAGE</h3></a>
                   </div>
               </div>
           </div>';
            if($id==1){
            $subscribe = ' <h3 style="color:#9B67AD">SUBSCRIBE AND GET OUR PROMO</h3>
                    <form class="form-inline" action="{site_url}homeroot/subscribe" method="post">
                        <input type="text" name="email" placeholder="Masukan email / No Hp">
                        <button type="submit" id="submit" disabled class="btn">Submit</button>
                        <img id="loadform" src="{base_url}img/loading-animation.gif" title="iDial load" width=""/>
                    </form>
                    <div class="success-message"></div>
                    <div class="error-message"></div>';

            }else{
                $subscribe="";
            }
            $themes ="cs";
            $structure = array("head","body-cs","footer");
            $data = array(
                "site_url"=>base_url(),
                "title_page"=>"PREVIEW PAGE",
                "disabled"=>'disabled',
                "goback"=>$goback,
                "desc"=>$desc,
                "back"=>"PREVIEW</br>PAGE",
                  "subscribe"=>$subscribe,

            );

            print $this->cor3->html($themes,$structure,$data);
        }
        public function newUpdate(){

            $id = "";

            //error
            $err_val = $this->input->get('err');
            $error_message = $this->errorMessage($err_val);

            //themes
            $themes ="admin";

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
                    "catalog" =>'' ,
                    "extra" =>'',
                    "page" =>'class="active"' ,
                    "pageContent"=>strtoupper($this->page),
                    "id"=>$id,
                    "pageContentLink"=>$this->page,
                    "pageContentHeader" =>$pageContentHeader,
                    "pageContent2"=>"You can ".$pageContentHeader." Content here",
                    "error_message"=>$error_message,
                    "imageLink"=>$this->imageLink,

                );
                // data edited
                $editCatValue = $this->page_model->getValue($this->table,$this->iColumn,$id);

                foreach($editCatValue as $row){

                    $data['name'] =  $row->name;


                    if($row->status>0){
                        $data['status'] = "checked" ;
                    }else{
                        $data['status'] = "" ;
                    }
                }
                // data meta edited

                $editValuemeta = $this->page_model->getValue($this->table2,$this->iColumn,$id);
                foreach($editValuemeta as $row){
                    $data[$row->meta_key] =  $row->meta_value;

                }
        }else{// if NEW
                $pageContentHeader = "Add New";

                $data = array(
                    "site_url"=>base_url(),
                    "dashboard" => 'class="active"',
                    "catalog" =>'' ,
                    "extra" =>'',
                    "pageContent"=>strtoupper($this->page),
                    "id"=>$id,
                    "pageContentLink"=>$this->page,
                    "pageContentHeader" =>$pageContentHeader,
                    "pageContent2"=>"You can ".$pageContentHeader." Content here",
                    $this->iColumn=>"",
                    "name"=>"",
                    "desc"=>"",
                    "sdesc"=>"",
                    "status"=>"checked",
                    "desc"=>"",
                    "error_message"=>$error_message,

                );

            }

            print $this->cor3->html($themes,$structure,$data);



        }

        public function delete(){


            $id =  $this->input->get('id');
            $table = $this->table;
            $tableMeta = $this->tableMeta;
            $dataWhere = array($this->iColumn=>$id);
            if(!empty($id)){
               $this->cor3_model->deleteValue($table, $dataWhere);

                //delete img
                $resultValue = $this->cor3_model->getSQLvalue_where($tableMeta,$dataWhere,"meta_value");
                $this->cor3_model->deleteValue($tableMeta, $dataWhere);
                $dataWhere['meta_key'] = "imgName";

                $pathDelete='assets/upload/'.$this->page.'/'.$resultValue;
                if(!empty($resultValue)|| ($resultValue!= NULL)){
                    unlink($pathDelete);
                    //delete_files('assets/upload/'.$this->page.'/'.$resultValue);

                }

                print "<script>window.location='".base_url().$this->page."/?err=3'</script>";


            }
        }

        public function action(){

            $id     =  $this->input->post('id');
            $name   = $this->input->post('name');
            $status =  $this->input->post('status');
            $desc   = $this->input->post('pdesc');
            $sdesc   = $this->input->post('psdesc');

            //status myquery
            if(empty($status)){
                $status="0";
            }

            $data = array(
                "name"=>$name,
                "status"=>$status,
                "author"=>$this->session->userdata('user_id'),
            );
            $dataAttribute = array(
                "desc"=>$desc,
                "sdesc"=>$sdesc,
            );


            if(!empty($id)){
                $dataWhere = array(
                    $this->iColumn=>$id
                );
                // update query
                $ResultQuery = $this->cor3_model->updateValue($this->table, $data, $dataWhere);

                // update meta
                $imageName = $this->jpupload->singleUpload($name."-".$id,$this->page);
                print $imageName['file_name'];

                //$resizeImage = $this->jpupload->resizeUpload($this->page,$imageName['file_name'],400,75);

                $errUpload="";
                if($imageName){

                    $dataAttribute["imgName"] =$imageName['file_name'];
                    //$dataAttribute["imgNametmb"] =$resizeImage;

                }else{
                    $errUpload = '&err2=5';
                }

                $resultMeta = $this->action_meta($dataAttribute,$id ,$this->table2);

                if(($ResultQuery==TRUE)||($resultMeta)){

                   print "<script>window.location='".base_url()."admin/".$this->page."/newUpdate/?id=".$id."&err=2'</script>";
                }else{
                   print "<script>window.location='".base_url()."admin/".$this->page."/newUpdate/?id=".$id."&err=2'</script>";
                    // print "not updated";
                }

            }else{
                $data["created"] = DATE('Y-m-d H:i:s');
                $ResultQuery = $this->cor3_model->insertValue($this->table,$data);

                // upload
                $imageName = $this->jpupload->singleUpload($name."-".$ResultQuery['id'],$this->page);
                //$resizeImage = $this->jpupload->resizeUpload($this->page,$imageName['file_name'],100,75);

                $errUpload="";

                if($imageName!= 0){

                    $dataAttribute["imgName"] =$imageName['file_name'];
                    //$dataAttribute["imgNametmb"] =$resizeImage;

                }else{
                    $errUpload = '&err2=5';
                }

                $this->action_meta($dataAttribute,$ResultQuery['id'] ,$this->table2);

                 if($ResultQuery['qstatus']==TRUE){

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