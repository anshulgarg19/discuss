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
		return $this->user_object->registerUser($data, $activation_key);
	}

	public function check_phone_num_email($phone_num,$email){
		return $this->user_object->checkPhoneNumEmail($phone_num,$email);
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

			$link = RESET_URI."?token=".$token."&email=".$email;

			

			$senddata = array();
			$senddata['to'] = $email;
			$senddata['subject'] = 'Password reset email';
			$senddata['message'] = 'Reset uri is: '.$link;


			sendmail($senddata);
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
			if($result == "not_active") {
				http_response_code(403);
				return false;
			}
			$this->_ci->load->library('session');
			$_SESSION['user_id'] = $result[0];
			$_SESSION['firstname'] = $result[1];
			return true;
		}
		else {
			http_response_code(401);
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

	public function updateProfilePicURI($user_id, $filename ){
		$this->user_object->_updateProfilePicURL($user_id,$filename);
	}
};
?>