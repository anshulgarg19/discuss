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
		$this->load->helper('validations_helper');
	}

	public function index()
	{
		$this->load->view('home_page');
	}
	
	//method to initiate registration in controller
	public function register() {
		
		$this->load->library("Userfactory");
		//var_dump($_POST['email'].ACTIVATE_STRING.' '.sha1($_POST['email'].ACTIVATE_STRING));

		$inputValid = true;
		$validation_errors = array();

		/* 
		** starting server side validations
		*/

		
		if( strlen($_POST['fname']) == 0 )
		{

			$validation_errors['error-first-name'] = true;
			$inputValid = false;
		}

		//validating phone number
		if( !validate_phonenumber($_POST['phone_num'] ))
		{
			$validation_errors['error-phone'] = true;
			$inputValid = false;
		}

		//valdating phone number
		if( !validate_email($_POST['email']))
		{
			$validation_errors['error-email'] = true;
			$inputValid = false;
		}

		//validating password
		if( !validate_password($_POST['password']) )
		{
			$validation_errors['error-password'] = true;
			$inputValid = false;
		}


		if( $_POST['password'] != $_POST['confirm_password'] )
		{
			$validation_errors['error-mismatch-password'] = true;
			$inputValid = false;
		}

		
		if( !$inputValid )
		{
			echo json_encode($validation_errors);
			//die();
			return;
		}

		
		$activation_key = sha1($_POST['email'].ACTIVATE_STRING);
		$response = $this->userfactory->createUser($_POST,$activation_key);

		$already_exists = false;
		if( isset($response['phone-exists']) || isset($response['email-exists']))
		{
			echo json_encode($response);
			//die()
			return;
		}

		$this->sendmail($activation_key);
		
	}

	/*public function setProfilePic() {

		$link = "https://github.com/rootavish/me";

		$this->load->model("User_model");

		$umodel = new User_Model();
		$umodel->_setId(1);
		$umodel->setProfilePic($link);
	}*/

	public function login() {

		$this->load->library("Userfactory");

		$validation_errors = array();

		if( !validate_email($_POST['email']))
		{
			$validation_errors['error-login_email'] = true;
			echo json_encode($validation_errors);
			//die();
			return;
		}

		if (!$this->userfactory->verifyLogin($_POST)) {
			// Wrong username or password, session was not set
			http_response_code(400);
			//die();
			return;
		}

		$this->load->library('session');
		//$this->session->set_userdata('user_id',56);

	}

	public function forgot() {

		$this->load->library("Userfactory");
		$this->userfactory->passwordResetInit($_POST['forgotmail']);
	}

	public function sendmail($activation_key) {
		$activate_uri = ACTIVATE_URI.'code='.$activation_key.'&email='.$_POST['email'];
		
		/*$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'discusswebservice@gmail.com',
		    'smtp_pass' => 'thisisubuntu',
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1'
		);

	    $config['newline'] = "\r\n";*/

	    
	    //email configuration settings
	    $emailconfig['protocol'] = $this->config->item('protocol');
	    $emailconfig['smtp_host'] = $this->config->item('smtp_host');
	    $emailconfig['smtp_port'] = $this->config->item('smtp_port');
	    $emailconfig['smtp_user'] = $this->config->item('smtp_user');
	    $emailconfig['smtp_pass'] = $this->config->item('smtp_pass');
	    $emailconfig['mailtype'] = $this->config->item('mailtype');
	    $emailconfig['charset'] = $this->config->item('charset');
	    $emailconfig['newline'] = $this->config->item('newline');

		$this->load->library('email', $emailconfig);
		$this->email->from(EMAIL_FROM);
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
