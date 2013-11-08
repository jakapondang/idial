<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
            
            $this->load->library('cor3');
           // $this->load->model(array('cart_product_model','cart_user_model','home_model'));
        }
	public function index()
	{
		$var = $this->cor3->html_head();
		print $var;
		//print "1231";
		$this->load->view('welcome_message');
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */