<?php
defined('BASEPATH') or exit('No direct scripts allowed');

class Userfactory{
	private $_ci;
	private $user_object;
	
	function __construct(){
		$this->_ci =& get_instance();
		$this->_ci->load->model("User_model");
		$this->user_object = new User_Model();
	}

	//method to fetch user profile
	public function getUser($user_id){

		$data = $this->user_object->retrieveUser($user_id);		

		return $this->createUserObject($data);
	}

	//library method to set user credetials after successful regitration
	public function createUser($data,$activation_key){
		$this->user_object->registerUser($data, $activation_key);
	}

	//library method to activate profile
	public function activateProfile(){
		$response = $this->user_object->_setActivated();
		return $response;
	}

	public function passwordResetInit($email) {
		
		// Generate a reset token of length 64 bytes
		$token = bin2hex(openssl_random_pseudo_bytes(64));

		// Now write this token to the database		
		if($this->user_object->saveResetToken($token, $email)) {

			$link = "https://discuss.io/index.php/Homepage/PasswordReset?token=".$token."&email=".$email;

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

			$this->_ci->load->library('email', $config);
			$this->_ci->email->from('discusswebservice@gmail.com');
	        $this->_ci->email->to($email);

	        $this->_ci->email->subject('Password reset email');
	        $this->_ci->email->message('Reset uri is: '.$link);  

	        $this->_ci->email->send();

	        echo $this->_ci->email->print_debugger();
		}
		else {
			http_response_code(500);
		}
	}

	public function passwordResetClose($token, $email, $newpass) {
		// Finally reset the password
		
		if(!$this->user_object->resetPass($token, $email, $newpass)) {
			return false;
		}

		return true;
	}

	// Function to check if the user credentials are correct
	public function verifyLogin($userdata) {
		if($result = $this->user_object->loginCheck($userdata)) {
			$_SESSION['user_id'] = $result[0];
			$_SESSION['firstname'] = $result[1];
			return true;
		}
		else {
			return false;
		}
	}

	public function createUserObject( $data ){
		$u_object = new User_Model();
		$u_object->_setId($data->user_id);
		$u_object->_setFirstname($data->firstname);
		$u_object->_setLastname($data->lastname);
		$u_object->_setEmail($data->email_id);
		$u_object->_setPhone($data->phone_num);
		$u_object->_setProfilePicUrl($data->profile_pic);
		return $u_object;
	}
};
?>