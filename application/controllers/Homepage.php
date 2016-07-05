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
		$this->load->helper('redirect_helper');
		$this->load->helper('email_helper');
		$this->load->helper('pic_helper');
	}

	public function index()
	{
		$this->load->library("session");
		if (isset($_SESSION['user_id']))
			redirection();
		$this->load->view('home_page');
	}
	
	//method to initiate registration in controller
	public function register() {
		
		$this->load->library("Userfactory");				

		$activation_key = sha1($_POST['email'].ACTIVATE_STRING);
		$response = $this->userfactory->createUser($_POST,$activation_key);

		$user_id = $response['user_id'];
		$filename = $user_id;
		$fileconfig = getfileconfigurations();
		$fileconfig['file_name'] = $filename;
		$this->load->library('upload',$fileconfig);

		if( !$this->upload->do_upload('userfile'))
		{
			//var_dump($this->upload->display_errors());
			$filename = DEFAULT_PIC;
		}
		else
		{
			$filedata = $this->upload->data();
			//var_dump($filedata);
			$filename = $filename.$filedata['file_ext'];
			//var_dump($filename);
			
		}

		$this->userfactory->updateProfilePicURI($user_id,$filename);	
		$this->sendactivationmail($_POST,$activation_key);
		$this->load->view('register_success');
		
	}

	//Function for server side validations
	public function validateuser(){
		$this->load->library("Userfactory");
		//var_dump($_POST['email'].ACTIVATE_STRING.' '.sha1($_POST['email'].ACTIVATE_STRING));

		$inputValid = true;
		$validation_errors = array();

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


		//validating if password and confirm passwords match
		if( $_POST['password'] != $_POST['confirm_password'] )
		{
			$validation_errors['error-mismatch-password'] = true;
			$inputValid = false;
		}

		if( !$inputValid )
		{
			http_response_code(400);
			echo json_encode($validation_errors);
			//die();
			return;
		}		

		$response = $this->userfactory->check_phone_num_email($_POST['phone_num'],$_POST['email']);
		
		if(isset($response['phone-exists']))
		{
			$validation_errors['phone-exists'] = true;
			$inputValid = false;
		}

		if( isset($response['email-exists']))
		{
			$validation_errors['email-exists'] = true;
			$inputValid = false;
		}

		if( !$inputValid)
		{
			http_response_code(400);
			echo json_encode($validation_errors);
			return;
		}
	}
	

	public function login() {

		$this->load->library("Userfactory");
		$this->load->model("Tag_model");

		$validation_errors = array();
		$type = null;

		if( !validate_email($_POST['email']))
		{
			$validation_errors['error-login_email'] = true;
			
			if(!validate_phonenumber($_POST['email'])) {
				echo json_encode($validation_errors);
				return;
			}
			else {
				$type = "phone_num";
			}
		}
		else {
			$type = "email";
		}

		if (!$this->userfactory->verifyLogin($_POST, $type)) {
			return;
		}

		redirection();
	}

	public function forgot() {

		$this->load->library("Userfactory");
		$this->userfactory->passwordResetInit($_POST['forgotmail']);
	}

	public function sendactivationmail($data,$activation_key) {
		$activate_uri = ACTIVATE_URI.'?code='.$activation_key.'&email='.$data['email'];
		$senddata = array();
		$senddata['to'] = $data['email'];
		$senddata['subject'] = 'Activation Email';
		$senddata['message'] = 'Activation uri is: '.$activate_uri;
		sendmail($senddata);
		
	}

	public function resendActivation() {
		$this->sendactivationmail($_POST, sha1($_POST['email'].ACTIVATE_STRING));
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
