<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://discuss.io
	 *	- or -
	 * 		http://discuss.io
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __contruct() {
		parent::__contruct();
	}
	public function index()
	{
		$this->load->view('home_page');
	}
	
	public function register() {
		$this->load->library("Userfactory");
		$this->userfactory->setUser($_POST);
		var_dump($_POST);
		
	}

	public function setProfilePic() {

		$link = "https://github.com/rootavish/me";

		$this->load->model("User_model");

		$umodel = new User_Model();
		$umodel->_setId(1);
		$umodel->setProfilePic($link);
	}

	public function login() {

		$this->load->library("Userfactory");
		if (!$this->userfactory->verifyLogin($_POST)) {
			// Wrong username or password, session was not set
			http_response_code(400);
			die();
		}
	}

	public function sendmail() {
		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'discusswebservice@gmail.com',
		    'smtp_pass' => 'thisisubuntu',
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1'
		);

	    $config['newline'] = "\r\n";

		$this->load->library('email', $config);
		$this->email->from('discusswebservice@gmail.com');
        $this->email->to('avishkar.gupta.delhi@gmail.com','avishkar');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');  

        $this->email->send();

        echo $this->email->print_debugger();
	}
}
