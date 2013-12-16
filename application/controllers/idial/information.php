<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Information extends CI_Controller {

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
			$this->load->model(array('idial/info_model'));


        }

        public function contact() {
            $mConfig = $this->cor3->mainConfig();


            $head       = $mConfig;
            $body       = $mConfig;
            $content    = $mConfig;
			
			$status = $this->input->get('e');
			
			if($status=="1"){
				
				$content['form_contact_align'] ='style="text-align:center;padding-right: 50px"';
				$content['form_contact'] = '
				<h3>Hello ,</h3> 
				<p style="color:#762B90">Thank you for your message , we will contact you immediately.</p>
				<br><br>';
				
			}else{
				$content['form_contact_align'] ='padding-right: 50px';
				$content['form_contact'] = '
				
				<form id="contactForm" method="post" action="'.base_url().'action/contact">
				<fieldset>
                        <span class="required">*</span>
                        <input type="text" placeholder="Name" name="name" class="validate[required]">
                        <span class="required">*</span>
                        <input type="text" placeholder="Email" name="email" class="validate[required,custom[email]] text-input">
                        <span class="required">*</span>
                        <input type="text" class="validate[required]" name="subject" placeholder="Subject">
                    </fieldset>

                <label>Message<span class="required">*</span></label>
                <textarea name="message" rows="3" class="validate[required]"></textarea>
				<p><button class="btn" type="submit">Send Request</button></p>
				</form>
				';
				
				
			}
            $footer     = $mConfig;
            $fcontent   = $mConfig;
            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/contact/head-ext',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/contact/contact',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/contact/fcontact',$fcontent);
        }
        public function action_contact() {
            $mConfig = $this->cor3->mainConfig();

            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $subject =  $this->input->post('subject');
            $message =  $this->input->post('message');
            $mailto = "hello@idialcorner.com";
            $mailbcc =  $mConfig['main_email'];
			
			$data = array(
					"name" => $name,
					"email" => $email,
					"message" => $message,
					"mbaseurl" => $mConfig['mbaseurl'],
				);
			$dataSave = array(
						"name" => $name,
						"contact_person" => $email,
						"message" => $message,
						);
			$result = $this->info_model->insertValueSubscriber("subscriber_cs",$dataSave);
			$themes     ="idial";
            $structure  = array("email/head","email/contact","email/footer");
            $plain_message="";
            $message    =  $this->cor3->html($themes,$structure,$data);
			
			
            if($result['qstatus']!=false){
				$this->cor3->sentEmail($subject,$message,$plain_message="",$email,$name,$mailto, $mailbcc);
				 print '<script>window.location="'.base_url().'contact/?e=1";</script>';
			}else{
				 print '<script>window.location="'.base_url().'contact/?e=2";</script>';
			}
			
			
        }
        public function aboutus() {
            $mConfig = $this->cor3->mainConfig();


            $head       = $mConfig;
            $body       = $mConfig;
            $content    = $mConfig;
            $footer     = $mConfig;
            $fcontent   = $mConfig;
            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/aboutus/aboutus',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/aboutus/faboutus',$fcontent);
        }

        public function privacypolicy() {
            $mConfig = $this->cor3->mainConfig();


            $head       = $mConfig;
            $body       = $mConfig;
            $content    = $mConfig;
            $footer     = $mConfig;
            $fcontent   = $mConfig;
            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/privacy/privacy',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/privacy/fprivacy',$fcontent);
        }

        public function terms() {
            $mConfig = $this->cor3->mainConfig();


            $head       = $mConfig;
            $body       = $mConfig;
            $content    = $mConfig;
            $footer     = $mConfig;
            $fcontent   = $mConfig;
            $this->load->view($mConfig['themes'].'/head',$head);
            $this->load->view($mConfig['themes'].'/body',$body);
            $this->load->view($mConfig['themes'].'/terms/terms',$content);
            $this->load->view($mConfig['themes'].'/footer',$footer);
            $this->load->view($mConfig['themes'].'/terms/fterms',$fcontent);
        }
		
		







        
    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php */