<?php
defined('BASEPATH') or exit('No direct access to script allowed');

//controller for user profile
class Userprofile extends CI_controller{

	public function __construct(){
		parent::__construct();
	}

	//default method for a new user
	public function index(){
		$this->load->library("Userfactory");

		$data = array(
			"user" => $this->userfactory->getUser(1)
			);

		$this->load->view("header");
		$this->load->view("show_profile",$data);
		$this->load->view("footer");
	}

	//method to activate user profile
	public function activate(){
		$this->load->library("Userfactory");
		//var_dump($_GET);
		$response = $this->userfactory->activateProfile();

		$this->load->view("header");
		if( $response == ACK )
			$msg = "Email successfully Verified";
		else
			$msg = "Email already verified.";
		$data = array(
			"message" => $msg
			);
		
		$this->load->view("activation_status",$data);
		$this->load->view("footer");
	}

	public function changepic(){
		$this->config =  array(
	      //'upload_path'     => dirname($_SERVER["SCRIPT_FILENAME"])."/files/",
	      //'upload_url'      => base_url()."files/",
	      'allowed_types'   => "gif|jpg|png",
	      'overwrite'       => TRUE,
	      'max_size'        => "1000KB",
	      'max_height'      => "768",
	      'max_width'       => "1024"  
	    );
	    $this->load->library('upload', $this->config);
		if($this->upload->do_upload())
		{
		    echo "file upload success";
		}
		else
		{
		   echo "file upload failed";
		}
	}
};
?>