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

	    // Save the reset link
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
}	
?>