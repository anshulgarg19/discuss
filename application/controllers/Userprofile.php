<?php
defined('BASEPATH') or exit('No direct access to script allowed');

//controller for user profile
class Userprofile extends CI_controller{

	public function __construct(){
		parent::__construct();
		$this->load->library("Userfactory");
	}

	//default method for a new user
	public function index(){
		$this->load->library("Userfactory");

		$data = array(
			"user" => $this->userfactory->getUser(41)
			);

		$this->load->view("header");
		$this->load->view("show_profile",$data);
		$this->load->view("footer");
	}

	//method to activate user profile
	public function activate(){

		//validating email and code presence in activation link or not
		if( !isset($_GET['email']) || !isset($_GET['code']) || count($_GET) != 2)
		{
			var_dump("get fileds not set");
			http_response_code(400);
			die();
		}		

		$this->load->library("Userfactory");
		//var_dump($_GET);
		$response = $this->userfactory->activateProfile();

		$this->load->view("header");
		if( $response == ACK )
			$msg = "Email successfully Verified";
		else if( $response == NACK )
			$msg = "Email already verified.";
		//bad $_GET parameters
		else 		
		{
			var_dump($response);
			http_response_code(400);
			die();
		}

		$data = array(
			"message" => $msg
			);

		$this->load->view("activation_status",$data);
		$this->load->view("footer");
	}

	public function changepic(){
		
		$filename = '1';
	    $config['upload_path']          = UPLOAD_DIR;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 1024*1024*1024*2;
        $config['max_width']            = 2000;
        $config['max_height']           = 2768;
        $config['file_name'] 			= $filename;

	    $this->load->library('upload', $config);

		if(!$this->upload->do_upload('userfile'))
		{
			var_dump($this->upload->display_errors());
		    echo "file upload failed";
		}
		else
		{
			$this->userfactory->updateProfilePic($filename);
			$this->index();
		   //echo "file upload success";

		}
	}
};
?>