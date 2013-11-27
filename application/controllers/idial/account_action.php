<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Account_action extends CI_Controller {
        
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
            $this->load->library(array('cor3','usersecure'));
			$this->load->model('idial/account_model','account_model');

        }
        public function login() {
            $email   = $this->input->post('email');
            $pass   = $this->input->post('password');
            if(!empty($email)||!empty($pass)){
                $returnValue = $this->usersecure->login($email,$pass);
                if($returnValue==false){
                    print '<script>window.location="'.base_url().'login/?err=1";</script>';

                }else{
                    print '<script>window.location="'.base_url().'account";</script>';

                }
            }else{
                  print '<script>alert("Cannot Be Empty");window.location="'.base_url().'login";</script>';
            }

        }
        public function register() {


          $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $pass  = $this->input->post('cpassword');

            $rowCount  = $this->account_model->cekRowTable("jp_users","user_email",$email);

            if($rowCount > 0){
                // EMail Already exist
                print '<script>window.location="'.base_url().'register/?err=1";</script>';

            }else{
                //var email
                $username = explode("@",$email);
                $subject    = "Welcome to iDialCorner.com";
                $mailfrom   = "hello@idialcorner.com";
                $mailto     = $email;
                $mailbcc    = "jaka.pondang@gmail.com";
                $mailfname  = "iDial Corner";

                $themes     ="idial";
                $structure  = array("email/head","email/register","email/footer");
                $data       = array(
                    "site_url"=>base_url(),
                    "username"=>ucfirst($username[0]),
                    "email_user"=>$email,
                    "pass_user"=> $pass
                );
                $plain_message="";
                $message    =  $this->cor3->html($themes,$structure,$data);

                //insert & email
               $Userid =  $this->usersecure->create($email,$pass,$username[0]);
               /* print "<script>alert('$Userid');</script>";*/
                if($Userid > 0 ){
                    $datameta = array(
                        "user_id"=>$Userid,
                        "meta_key"=>"phone",
                        "meta_value"=>$phone
                    );
                    $CreateUserMeta = $this->account_model->insertValue("jp_usermeta",$datameta);


                   if($CreateUserMeta != false){

                        $this->cor3->sentEmail($subject,$message,$plain_message,$mailfrom,$mailfname,$mailto,$mailbcc);
                        print '<script>window.location="'.base_url().'account";</script>';
                   }
                   else{

                       print '<script>window.location="'.base_url().'serverERROR2";</script>';
                   }
                }else{
                    print '<script>window.location="'.base_url().'serverERROR";</script>';

                }

            }

        }

        public function logout(){
            if($this->session->userdata('user_email') ==NULL){
                print '<script>window.location="'.base_url().'login";</script>';

            }
            $this->usersecure->logout();
            $themes ="idial";
            $structure = array("head","body","account/logout","footer","account/faccount");
            $data = array("site_url"=>base_url());

            print $this->cor3->html($themes,$structure,$data);
            print "<script>setInterval(function(){window.location='".base_url()."';},5000);</script>";
        }

        public function sentLostpassword() {
            $table = "jp_users";
            $email =  $this->input->post('email');
            $get   = "user_id";
            $data = array("user_email"=>$email);
            $userid = $this->account_model->cekGetValue($table,$data,$get);

            if($userid > 0){
               // var cek
               $table2 = "jp_usermeta_tmp";
               $get2   = "umeta_id";
               $data2  = array(
                    "user_id"=>$userid,
                    "meta_key"=>"lostpassword"
                );


               //create code
               $idsama = true;
               while ($idsama) {
                    $code = "iD";
                    $rand_string = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                    $lenght = 11;
                    $code .= $this->cor3->get_random_string($rand_string, $lenght);


                    $cekCode =  $this->account_model->cekRowTable($table2,"meta_value",$code);
                    if ($cekCode == 0) {
                        $idsama = false;
                    }
                }

              	// var Email
                $data3  = array(
                    "user_id"=>$userid,
                    "meta_key"=>"firstname"
                );
                $fname = $this->account_model->cekGetValue("jp_usermeta",$data3,"meta_value");

                $subject    = "Reset Password - iDialCorner.com";
                $mailfrom   = "hello@idialcorner.com";
                $mailto     = $email;
                $mailbcc    = "jaka.pondang@gmail.com";
                $mailfname  = "iDial Corner";

                $themes     ="idial";
                $structure  = array("email/head","email/resetpassword","email/footer");
                $data       = array(
                    "site_url"=>base_url(),
                    "username"=>ucfirst($fname),
                    "reset_link"=>base_url()."reset_password/?token=".$code."&iD=".$userid,

                );
                $plain_message="";
                $message    =  $this->cor3->html($themes,$structure,$data);
                $this->cor3->sentEmail($subject,$message,$plain_message,$mailfrom,$mailfname,$mailto,$mailbcc);
				
				$rowId = $this->account_model->cekGetValue($table2,$data2,$get2);
               if($rowId>0){

                   $dataUpdate = array(
                       "meta_value"=> $code ,
                   );

                   $dataWhere = array(
                     "umeta_id"=> $rowId ,
                   );
                   $cekUpdate = $this->account_model->updateValue($table2, $dataUpdate, $dataWhere);
                   if($cekUpdate == false){
                       print '<script>window.location="'.base_url().'login/?err=3";</script>';
                   }else{

                       print '<script>window.location="'.base_url().'login/?err=2";</script>';

                   }

               }else{
                   $dataInsert = array(
                       "user_id"=>$userid,
                       "meta_key"=>"lostpassword",
                       "meta_value"=> $code ,

                   );
                   $cekInsert = $this->account_model->insertValue($table2 ,$dataInsert);
                   if($cekInsert == false){
                       print '<script>alert("INSERT DB ERROR");window.location="'.base_url().'login";</script>';
                   }else{
                       print '<script>window.location="'.base_url().'login/?err=2";</script>';
                   }
               }
            }else{
                print '<script>window.location="'.base_url().'lostpassword/?err=1";</script>';
            }

            //print "test";

        }
		
		 public function getLinkResetpassword() {
			 $userid = $this->input->get('iD');
			 $token = $this->input->get('token');
			 $table = "jp_usermeta_tmp";
             $get   = "umeta_id";
             $data  = array(
                    "user_id"=>$userid,
                    "meta_key"=>"lostpassword",
					"meta_value"=>$token
                );
				
			 $rowId = $this->account_model->cekGetValue($table,$data,$get);
               if($rowId>0){
				   print '<script>window.location="'.base_url().'resetpassword/?token='.$token.'&iD='.$userid.'";</script>';
			   }else{
				   print '<script>window.location="'.base_url().'login/?err=3";</script>';
				   }
		 }
		 
		 public function NewResetPassword() {
			$userid = $this->input->post('userid');
            $pass  = $this->input->post('cpassword');
			$token  = $this->input->post('token');
			
			$table = "jp_usermeta_tmp";
			$dataWhere  = array(
                    "user_id"=>$userid,
                    "meta_key"=>"lostpassword",
					"meta_value"=>$token
                );
            $returnValue = $this->usersecure->reset_password($userid,$pass);
			if($returnValue==true){
				$this->account_model->deleteValue($table,$dataWhere);
				
				print '<script>window.location="'.base_url().'login/?err=4";</script>';
			}
		 }


        public function editAccount() {
            $fname = $this->input->post('fname');

            $lname = $this->input->post('lname');

            $phone = $this->input->post('phone');

            $email = $this->input->post('email');

            $pass  = $this->input->post('cpassword');

            $oldpass = $this->input->post('oldpass');

            $user_id = $this->session->userdata('user_id');
            $errorValue = "";
            $table = "jp_users";
            $tableMeta = "jp_usermeta";

            $dataAttribute = array(
                "firstname" =>$fname,
                "lastname"=>$lname,
                "phone"=>$phone,
            );
            // Update email
            $dataWhereEmail = array(
               "user_email"=>$email,
            );

            $cekRowEmail = $this->account_model->cekGetRow($table ,$dataWhereEmail);
            //if email already exist
             if($cekRowEmail==0){
                $this->usersecure->update($user_id, $email);
             }
            // Update password
            if(!empty($oldpass) && !empty($pass)){
                $resultEditPass = $this->usersecure->edit_password($this->session->userdata('user_email') , $oldpass, $pass);
                if($resultEditPass== false){
                    $errorValue= "?err=2";
                }
            }else{
                $errorValue= "?err=1";
            }
            // Save attribute meta
            foreach($dataAttribute as $keyName => $valName){

                $dataWhere = array(
                    "user_id"=>$user_id,
                    "meta_key"=>$keyName,
                );
                //cek if meta key exist
                $cekRowAttribute = $this->account_model->cekGetRow($tableMeta ,$dataWhere);

                if($cekRowAttribute>0){
                    //cek if the same
                    $dataWhere_ts = array(
                        "user_id"=>$user_id,
                        "meta_key"=>$keyName,
                        "meta_value"=>$valName
                    );
                    $cekRowAttribute_ts = $this->account_model->cekGetRow($tableMeta ,$dataWhere_ts);
                    if($cekRowAttribute_ts== 0){
                        $dataValue = array(
                            "meta_value"=>$valName,
                        );
                       $resultQuery =  $this->account_model->updateValue($tableMeta,$dataValue,$dataWhere);

                    }
                }else{
                    $dataValue = array(
                        "user_id"=>$user_id,
                        "meta_key"=>$keyName,
                        "meta_value"=>$valName,
                    );
                    $resultQuery = $this->account_model->insertValue($tableMeta,$dataValue);

                }
                // update session meta
                if($resultQuery == true){
                    $user_data[$keyName] = $valName;
                    $this->session->set_userdata($user_data);
                }

            }//end attribute meta foreach
            if( empty($errorValue)){
                $errorValue = "err=3";
            }
           print "<script>window.location='".base_url()."account/#profile".$errorValue."'</script>";

        }
        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */