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

	    public function _setProfilePicUrl(profilePic) {
	    	$this->profilePicUrl = profilePic;
	    }
}
?>