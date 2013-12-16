<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Homeroot extends CI_Controller {
        
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
            $this->load->library(array('cor3'));//'usersecure','jpupload','cor3_model'
			 $this->load->model(array('home_model'));

        }
        
        public function index() {
            $data=array('pag_id'=>1);
            $desc = $this->cor3_model->getSQLvalue_where("jp_page",$data,"desc");
            $name = $this->cor3_model->getSQLvalue_where("jp_page",$data,"name");
			$themes ="cs";
            $structure = array("head","body-cs","footer");
            $subscribe = '<h3 style="color:#9B67AD">'.$name.'</h3>
                    <form class="form-inline" action="{site_url}homeroot/subscribe" method="post">
                        <input type="text" name="email" placeholder="Masukan email / No Hp">
                        <button type="submit" id="submit" class="btn">Submit</button>
                        <img id="loadform" src="'.base_url().'assets/cs/img/loading-animation.gif" title="iDial load" width=""/>
                    </form>
                    <div class="success-message"></div>
                    <div class="error-message"></div>';
            $data = array(
                "site_url"=>base_url(),
                "title_page"=>"iDial Corner | Jual iPhone 5s , iPhone 5c, iPad mini | Toko iPhone , iPad , Android & Blackberry",
                "disabled"=>"",
                "goback"=>"",
                "back"=>"<a href='".base_url()."price-list'>CHECKOUT</br>PRICE LIST</a>",
                "desc"=>$desc,
                "subscribe"=>$subscribe,
            );

			print $this->cor3->html($themes,$structure,$data);
        }
        public function priceList() {
            $data=array('pag_id'=>2);

            $desc = $this->cor3_model->getSQLvalue_where("jp_page",$data,"desc");
            $name = $this->cor3_model->getSQLvalue_where("jp_page",$data,"name");
            $themes ="cs";
            $structure = array("head","body-cs","footer");
            $data = array(
                "site_url"=>base_url(),
                "title_page"=>"iDial Corner | PRICE LIST | Toko iPhone , iPad , Android & Blackberry",
                "disabled"=>"",
                "goback"=>"",
                "back"=>"<a href='".base_url()."'>HOME</br>PAGE</a>",
                "desc"=>$desc,
                "subscribe"=>' <h3 style="color:#9B67AD">'.$name.'</h3>',
            );

            print $this->cor3->html($themes,$structure,$data);
        }
		
		public function subscribe(){
		
			
			if($_POST) {
			
				// Enter the email where you want to receive the notification when someone subscribes
				//$emailTo = 'contact.azmind@gmail.com';
			
				$subscriber_email = ($_POST['email']);
				$valid_email = $this->isEmail($subscriber_email);
				
				if($valid_email== 0) {
					if(!ctype_digit($subscriber_email)){
						$array = array();
						$array['valid'] = 0;
						$array['message'] = "Maaf , anda salah memasukan format EMAIL / Nomor Ponsel";
						echo json_encode($array);
					}else{
						$cekRow = $this->home_model->cekSubscribe($subscriber_email,"contact_person");
						if($cekRow>0){
							$array = array();
							$array['valid'] = 0;
							$array['message'] = "Maaf , Nomor Ponsel anda telah terdaftar . Silahkan Coba Nomor Ponsel anda yg lain.";
							echo json_encode($array);
						}else{
							
							$idsama = true;
							/* cek $order_id di database, ulangi trs sampe $order_id yang digenerate benar2 blm ada */
							while ($idsama) {
								$code = "iD";
								$rand_string = "0123456789";
								$lenght = 5;
								$code .= $this->cor3->get_random_string($rand_string, $lenght);
								
								
								$cekCode =  $this->home_model->cekSubscribe($code,"code");
								if ($cekCode == 0) {
									$idsama = false;
								}
							}
							$data =array(
								"contact_person"=>$subscriber_email,
								"code"=>$code,
							);	
							$this->home_model->insert_data_cs($data);
							//print 
							$array = array();
							$array['valid'] = 1;
							$array['message'] = '<div class="terimakasih" align="center">Terima kasih , Simpan Kode Voucher dibawah ini :<br>
							<div class="code_tr"><b>'.$code.'</b></div>
							<br>Hubungi / kunjungi toko kami untuk mendapatkan <b>BONUS</b> yang tersedia.<br/>
							ITC Kuningan, Jembatan 1, Lantai 3, No.07 Jakarta, Indonesia 12940 | Tel: 021 - 91799788 | BBM: 2A9B4867</div>';
							echo json_encode($array);
							
							// Send email
							$mailfrom = "admin@idialcorner.com";
							$mailfname = "iDial Corner";
							$mailto = "ivan.agust@yahoo.com";
							$mailbcc = "jaka.pondang@gmail.com";
							
							$subject = 'iDialCorner.com New Subscriber !';
							$message = "You have a new subscriber!\n\nNo.Handphone: " . $subscriber_email."<br>";
							$message .= "Voucher Code: " . $code;
							
							
							$this->cor3->sent_email($subject,$message,$mailfrom,$mailto,$mailbcc,$mailfname);
						}
					}
				}
				else {
					$cekRow = $this->home_model->cekSubscribe($subscriber_email,"contact_person");
						if($cekRow>0){
							$array = array();
							$array['valid'] = 0;
							$array['message'] = "Maaf , EMAIL anda telah terdaftar . Silahkan Coba EMAIL anda yg lain.";
							echo json_encode($array);
						}else{
							
							$idsama = true;
							/* cek $order_id di database, ulangi trs sampe $order_id yang digenerate benar2 blm ada */
							while ($idsama) {
								$code = "iD";
								$rand_string = "0123456789";
								$lenght = 5;
								$code .= $this->cor3->get_random_string($rand_string, $lenght);
								
								
								$cekCode =  $this->home_model->cekSubscribe($code,"contact_person");
								if ($cekCode == 0) {
									$idsama = false;
								}
							}
							$data =array(
								"contact_person"=>$subscriber_email,
								"code"=>$code,
							);	
							$this->home_model->insert_data_cs($data);
							
							$array = array();
							$array['valid'] = 1;
							$array['message'] = '<div class="terimakasih" align="center">Terima kasih , Simpan Kode Voucher Dibawah ini :<br>
							<div class="code_tr"><b>'.$code.'</b></div>
							<br>Hubungi / kunjungi toko kami untuk mendapatkan <b>BONUS</b> yang tersedia.<br/>
							ITC Kuningan, Jembatan 1, Lantai 3, No.07 Jakarta, Indonesia 12940 | Tel: 021 - 91799788 | BBM: 2A9B4867
							</div>';
							echo json_encode($array);
					
							// Send email
							$mailfrom = "admin@idialcorner.com";
							$mailfname = "iDial Corner";
							$mailto = "ivan.agust@yahoo.com";
							$mailbcc = "jaka.pondang@gmail.com";
							
							$subject = 'iDialCorner.com New Subscriber!';
							$message = "You have a new subscriber!\n\nEmail: " . $subscriber_email."<br>";
							$message .= "Voucher Code: " . $code;
							
							
							$this->cor3->sent_email($subject,$message,$mailfrom,$mailto,$mailbcc,$mailfname);
						// uncomment this to set the From and Reply-To emails, then pass the $headers variable to the "mail" function below
						//$headers = "From: ".$subscriber_email." <" . $subscriber_email . ">" . "\r\n" . "Reply-To: " . $subscriber_email;
						//mail($emailTo, $subject, $body);
								
							
							
							
						}
				}
			
			}
		}
		
		public function isEmail($email) {
				return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email));
			}
		 
		 public function debug(){
             $data = $this->jpupload->singleUpload('brand');
           print_r($data);
           // foreach($data as $key =>$row ){
             //   print $key."<br/>";
            //}

	    }
        public function viewDebug(){
			print 1;
			$data = array(
					"name" => "wew",
					"message" => "wewe",
				);
            $themes     ="idial";
            $structure  = array("email/head","email/contact","email/footer");
            $plain_message="";
            $message    =  $this->cor3->html($themes,$structure,$data);
        }

        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */