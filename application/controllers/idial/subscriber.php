<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Subscriber extends CI_Controller {

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
			$this->load->model(array('idial/subscriber_model'));


        }


        public function index() {
            $mConfig = $this->cor3->mainConfig();
            $variable = explode(',',$this->input->post('var'));
            if(IS_ARRAY($variable)){
               // print_r($variable);
                $mConfig['idP'] = $variable[0];
                $mConfig['nameP'] = $variable[1];
                $mConfig['uriP'] = $variable[2];
				$mConfig['qty'] = $variable[3];
            }else{
                $mConfig['idP'] = "";
                $mConfig['nameP'] = "";
                $mConfig['uriP'] =  "";
				$mConfig['qty'] =  "";
            }
            //$mConfig['nameP'] = explode($this->input->post('var'));
            //print  $this->input->post('uri');

        

            $this->load->view($mConfig['themes'].'/subscriber/subscriber',$mConfig);
	 }

        public function action() {
           //main config


           $uri         =  $this->input->post('uri');
           $pro_id      =  $this->input->post('id');
           $pro_name    =  $this->input->post('namep');
		   $qty    		=  $this->input->post('qty');
		 

           $user_name   =  $this->input->post('nameu');
           $email       =  $this->input->post('email');
           $address     =  $this->input->post('address');
		 

            if(empty($address)||empty($email)||empty($user_name)){
                print '1';
                exit();
            }
            if($this->isEmail($email)== 0) {
                if(!ctype_digit($email)){
                   print '2';
                    exit();

                }
            }

            $data = array(
					"contact_person"=>$email,
					"pro_id"=>$pro_id,
                    "order"=>"pending",
					);
            $row = $this->cor3->GetNumber_Row("jp_subscriber",$data);
            if($row>0){
                print '3';
                exit();

            }
            //insert db
            $data = array(
                    "name"=>$user_name,
                    "contact_person"=>$email,
                    "address"=>$address,
					"pro_id"=>$pro_id,
					"qty"=>$qty,
					"order"=>"pending",
					
            );
            $subscribe = $this->subscriber_model->insertValue("jp_subscriber",$data);
            if($subscribe['qstatus']!=true){
                print "error";
            }
			 $data = array(
                    "name"=>$user_name,
                    "contact_person"=>$email,
                    "address"=>$address,
					"custom"=>$qty." unit ".$pro_name 
            );
            // sent mail
            $this->sent_mail_user($data,$pro_name);

            $this->sent_mail_admin($data,$pro_name);
           // print $address;
			
			print '0';
        }

        public function sent_mail_user($data,$pro_name){
            $email = $data['contact_person'];
            $user_name=$data['name'];
			$product = $data['custom'];
			
            $mConfig    = $this->cor3->mainConfig();

            $subject    =  $pro_name." - iDialCorner.com";
            $mailfrom   =  "hello@idialcorner.com";
            $mailto     =  $email;
            $mailfname  = "iDial Corner";

            $mailbcc    = $mConfig['main_email'];
            $mConfig["name"]    =  $user_name;
            $mConfig["product"]=  $product;
			
			
            $themes     = "idial";
            $structure  = array("email/head","email/subscribe_product_user","email/footer");
            $plain_message="";
            $message    =  $this->cor3->html($themes,$structure,$mConfig);

            $this->cor3->sentEmail($subject,$message,$plain_message,$mailfrom,$mailfname,$mailto,$mailbcc);


        }

        public function sent_mail_admin($data,$pro_name){

            $mConfig    = $this->cor3->mainConfig();
            $subject    =  "New Buyer!! - iDialCorner.com";
            $mailfrom   =  "hello@idialcorner.com";
            $mailto     =  $mConfig['main_email'];
            $mailfname  =  "iDial Corner";

           // $mailbcc    = $mConfig['main_email'];
            $mConfig["email"]   = $data['contact_person'];
            $mConfig["name"]    =  $data['name'];
            $mConfig["add"]     =  $data['address'];
            $mConfig["product"]=  $data['custom'];
			

            $themes     = "idial";
            $structure  = array("email/head","email/subscribe_product_admin","email/footer");
            $plain_message="";
            $message    =  $this->cor3->html($themes,$structure,$mConfig);

            $this->cor3->sentEmail($subject,$message,$plain_message,$mailfrom,$mailfname,$mailto);
        }

        public function isEmail($email) {
            return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email));
        }



        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */