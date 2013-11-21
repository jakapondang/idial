<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Cor3 {
	
	function Cor3(){
			$this->CI =& get_instance();
			$this->CI->load->database();
			$this->CI->load->helper(array('url'));
			$this->CI->load->library(array('parser','email'));
			//,'session','email'
			//$this->CI->load->model(array('general_model'));
			
	}
	
    public function html($themes="html", $structure = array("head"),$data_inject="")
    {
        $content = "";
        $themes_css = explode("/", $themes);


        $data = array(
            'base_url'=>base_url()."assets/".$themes_css[0]."/",
        );
        if(!empty($data_inject)||($data_inject!="")):
            $data = $result = array_merge($data, $data_inject);
        endif;
        if(!empty($structure)||($structure!="")):
            $row = count($structure);
            for($i=0;$i<$row;$i++):

                $content .=  $this->CI->parser->parse($themes.'/'.$structure[$i], $data, TRUE);
            endfor;
        else:

        endif;



        return $content;
        //$content  =  $this->CI->parser->parse('html/html', $data, TRUE);
        //return $base_url;
        //$head = '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="id" lang="id"><head>#headcontent</head>';
    }


    public function get_random_string($valid_chars, $length) {
			// start with an empty random string
			$random_string = "";
		
			// count the number of chars in the valid chars string so we know how many choices we have
			$num_valid_chars = strlen($valid_chars);
		
			// repeat the steps until we've created a string of the right length
			for ($i = 0; $i < $length; $i++)
			{
				// pick a random number from 1 up to the number of valid chars
				$random_pick = mt_rand(1, $num_valid_chars);
		
				// take the random character out of the string of valid chars
				// subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
				$random_char = $valid_chars[$random_pick-1];
		
				// add the randomly-chosen char onto the end of our string so far
				$random_string .= $random_char;
			}
		
			// return our finished random string
			return $random_string;
		}
	public function sent_email($subject,$message,$mailfrom,$mailto,$mailbcc="",$mailfname="",$plain_message=""){
			$this->CI->email->clear();
			$config['charset'] = 'utf-8';
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = 'html';
			$this->CI->email->initialize($config);
			$this->CI->email->from($mailfrom, $mailfname);
			$this->CI->email->bcc($mailbcc); 
			$this->CI->email->to($mailto); 
			$this->CI->email->subject($subject);
			$this->CI->email->message($message);
			$this->CI->email->set_alt_message($plain_message);	
			$this->CI->email->send();
		}

    public function sentEmail($subject,$message,$plain_message="",$mailfrom,$mailfname="",$mailto){
        $mailbcc="";

        $this->CI->email->clear();

        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->CI->email->initialize($config);
        $this->CI->email->from($mailfrom, $mailfname);
        $this->CI->email->bcc($mailbcc);
        $this->CI->email->to($mailto);
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);
        $this->CI->email->set_alt_message($plain_message);
        $this->CI->email->send();

        }
}
?>
