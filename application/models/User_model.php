<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	// Model for the user information
	class User_Model extends CI_Model {
		
		// Details of user		
		private $id;
		private $firstname;
		private $lastname;
		private $phone;
		private $email;
		private $profilePicUrl;

		// invoke the parent class constructor
		function __construct() {
			parent::__construct();
		}


	    // Getters
	    public function getId()
	    {
	        return $this->id;
	    }

	    public function _setId($id)
	    {
	        $this->id = $id;
	    }

	    public function getFirstname()
	    {
	        return $this->firstname;
	    }

	    public function _setFirstname($firstname)
	    {
	        $this->firstname = $firstname;
	    }

	    public function getLastname()
	    {
	        return $this->lastname;
	    }

	    public function _setLastname($lastname)
	    {
	        $this->lastname = $lastname;
	    }

	    public function getPhone()
	    {
	        return $this->phone;
	    }

	    public function _setPhone($phone)
	    {
	        $this->phone = $phone;
	    }

	    public function getEmail()
	    {
	        return $this->email;
	    }

	    public function _setEmail($email)
	    {
	        $this->email = $email;
	    }

	    public function getProfilePicUrl() {
	    	return $this->profilePicUrl;
	    }

	    public function _setProfilePicUrl($profilePic) {
	    	$this->profilePicUrl = $profilePic;
	    }

	    public function setProfilePic($profilePicUrl) {

	    	if($this->id > 0) {
		    	$q = $this->db->query("UPDATE Users SET profile_pic=? WHERE user_id=?", array($profilePicUrl, $this->id));
		    }
	    }

	    //model to mark user activated
	    public function _setActivated(){
	    	$query = 'SELECT reset_link,activated from Users where email_id=?';
	    	$result = $this->db->query($query, array($_GET['email']));
	    	
	    	//bad activation request
	    	if( !$result->num_rows() )
	    		return BAD_REQUEST.' : no result found';

	    	$result_object = $result->row();
	    	//user not activated earlier

	    	if( $result_object->activated == '0')
	    	{
	    		if( $result_object->reset_link != $_GET['code'])
	    			return BAD_REQUEST.' : reset_link not valid';

	    		$query = 'update Users set activated=1,reset_link=NULL where email_id=?';
	    		$result = $this->db->query($query, array($_GET['email']));
	    		return ACK;
	    	}
	    	//user already activated
	    	else
	    	{
	    		return NACK;
	    	}
	    }

	    //model to update profile pic url
	    public function _updateProfilePicURL($user_id,$filename){
	    	$query = 'UPDATE Users set profile_pic=? where user_id=?';
	    	$result = $this->db->query($query,array($filename,$user_id));
	    }

	    // Function to verify a user's login credentials
	    public function loginCheck($userdata, $type) {

	    	if($type == "email")
	    		$q = "SELECT user_id, firstname, activated FROM Users WHERE email_id=? AND password=?";
    		else
    			$q = "SELECT user_id, firstname, activated FROM Users WHERE phone_num=? AND password=?";
	    	$result = $this->db->query($q, array($userdata['email'], sha1($userdata['password'])));

	    	if ($result->num_rows() < 1)
	    		return false;

	    	$user = $result->row();
	    	if($user->activated == 0)
	    		return "not_active";

    		return array($user->user_id, $user->firstname);
	    }

	    //Function to retrieve user profile
	    public function retrieveUser($user_id){
	    	$query = 'SELECT user_id,firstname,lastname,email_id,phone_num,profile_pic from Users where user_id=?';
	    	$result = $this->db->query($query,array($user_id));
	    	return $result->row();
			
	    }

	    // Function to create a database entry for a new user
	    public function registerUser($data, $activation_key) {
	    	
	    	$insert_data['firstname'] = $data['fname'];
	    	if(!isset($data['lname']))
	    		$data['lname'] = '';
	    	$insert_data['lastname'] = $data['lname'];
	    	$insert_data['phone_num'] = $data['pnum'];
	    	$insert_data['email_id'] = $data['email'];
	    	$insert_data['reset_link'] = $activation_key;
	    	$insert_data['password'] = sha1($data['password']);
	    	$this->db->insert('Users',$insert_data);
	    	$request['user_id'] = $this->db->insert_id();
	    	return $request;
	    
	    }

	    public function checkPhoneNumEmail($phone_num,$email){
			$query = 'SELECT user_id from Users where phone_num=?';
	    	$result = $this->db->query($query, array($phone_num));

	    	$error_data = array();

	    	if($result->num_rows() )
	    	{
	    		$error_data['phone-exists'] = true;
	    	}

	    	$query = 'SELECT user_id from Users where email_id=?';
	    	$result = $this->db->query($query,array($email));
	    	if( $result->num_rows() )
	    	{
	    		$error_data['email-exists'] = true;
	    	}	    	
	    	return $error_data;
	    }

	    // Save the reset link to the database
	    public function saveResetToken($token, $email_id) {

	    	$q = "UPDATE Users SET reset_link=? WHERE email_id=?";
	    	$result = $this->db->query($q, array($token, $email_id));

	    	if (!$result) {
	    		return $result->error();
	    	}

	    	else {
	    		return true;
	    	}
	    }

	    // Function to reset the password stored in the database
	    public function resetPass($token, $email, $password) {

	    	$q = "SELECT reset_link FROM Users WHERE email_id=? AND activated=1";
	    	$tokenres = $this->db->query($q, array($email));

	    	if(!$tokenres) {
	    		return false;
	    	}

	    	foreach($tokenres->result_array() as $dbtoken) {

	    		if($token != $dbtoken['reset_link']) {
	    			return false;
	    		}

	    		$q = "UPDATE Users SET password=?, reset_link=NULL WHERE email_id=?";

	    		$result = $this->db->query($q, array(sha1($password), $email));

	    		if(!$result) {
	    			return false;
	    		}
	    		else {
	    			return true;
	    		}
	    	}

	    }
}	
?>