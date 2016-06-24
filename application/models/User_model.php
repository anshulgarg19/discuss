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
		    	$q = $this->db->query("UPDATE user_profile SET profile_pic=? WHERE u_id=?", array($profilePicUrl, $this->id));
		    }
	    }

	    //model to mark user activated
	    public function _setActivated(){
	    	$query = 'select reset_link,activated from user_profile where email_id=?';
	    	$result = $this->db->query($query, array($_GET['email']));
	    	//var_dump($result->result());
	    	//bad activation request
	    	if( !$result->num_rows() )
	    		return BAD_REQUEST.' : no result found';

	    	$result_object = $result->row();
	    	//user not activated earlier

	    	if( $result_object->activated == '0')
	    	{
	    		if( $result_object->reset_link != $_GET['code'])
	    			return BAD_REQUEST.' : reset_link not valid';

	    		$query = 'update user_profile set activated=1,reset_link=NULL where email_id=?';
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
	    public function _updateProfilePicURL($filename){
	    	$query = 'update user_profile set profile_pic=?';
	    	$result = $this->db->query($query,array($filename));
	    }

	    // Function to verify a user's login credentials
	    public function loginCheck($userdata) {

	    	$q = "SELECT u_id, user_firstname FROM user_profile WHERE email_id=? AND password=?";
	    	$result = $this->db->query($q, array($userdata['email'], sha1($userdata['password'])));

	    	if ($result->num_rows() < 1)
	    		return false;

	    	$user = $result->row();
    		return array($user->u_id, $user->user_firstname);
	    }

	    // Function to create a database entry for a new user
	    public function registerUser($data, $activation_key) {
	    	$query = 'insert into user_profile(user_firstname,user_lastname,phone_num,email_id,reset_link,password) values(?,?,?,?,?,?)';
	    	$this->db->query($query, array($data['fname'],$data['lname'],$data['phone_num'],$data['email'],$activation_key,sha1($data['password'])));
	    }

	    // Save the reset link to the database
	    public function saveResetToken($token, $email_id) {

	    	$q = "UPDATE user_profile SET reset_link=? WHERE email_id=?";
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

	    	$q = "SELECT reset_link FROM user_profile WHERE email_id=?";
	    	$tokenres = $this->db->query($q, array($email));

	    	if(!$tokenres) {
	    		return false;
	    	}

	    	foreach($tokenres->result_array() as $dbtoken) {

	    		if($token != $dbtoken['reset_link']) {
	    			return false;
	    		}

	    		$q = "UPDATE user_profile SET password=?, reset_link=NULL WHERE email_id=?";

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