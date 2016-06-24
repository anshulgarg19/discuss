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

	public function __construct() {
		parent::__construct();
	}
	public function index()
	{
		$this->load->view('home_page');
	}
	
	//method to initiate registration in controller
	public function register() {
		$this->load->library("Userfactory");
		//var_dump($_POST['email'].ACTIVATE_STRING.' '.sha1($_POST['email'].ACTIVATE_STRING));
		$activation_key = sha1($_POST['email'].ACTIVATE_STRING);
		$this->userfactory->createUser($_POST,$activation_key);
		$this->sendmail($activation_key);
		
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

	public function forgot() {

		$this->load->library("Userfactory");
		$this->userfactory->passwordResetInit($_POST['forgotmail']);
	}

	public function sendmail($activation_key) {
		$activate_uri = ACTIVATE_URI.'code='.$activation_key.'&email='.$_POST['email'];
		
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
        $this->email->to($_POST['email'],$_POST['fname']);

        $this->email->subject('Activate email');
        $this->email->message('Activation uri is: '.$activate_uri);  

        $this->email->send();

        echo $this->email->print_debugger();
	}

	public function PasswordReset() {

		if (array_key_exists('token',$_GET)) {
			$this->load->view("header");
			$this->load->view("password_reset");
			$this->load->view("footer");
		}
		else {
			echo "Password cannot be reset without a valid activation link";
		}
	}

	public function PasswordResetClose() {
		$this->load->library("Userfactory");
		if ($this->userfactory->PasswordResetClose($_POST['token'], $_POST['email'], $_POST['password'])) {
			echo "Your password was reset successfully.";
		}
		else {
			http_response_code(401);
			echo "The password reset was unsuccessful, are you sure you are using the link we sent you?";
		}
	}
	/*public function sendmail() {

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
	}*/
}
