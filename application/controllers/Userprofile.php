<?php
defined('BASEPATH') or exit('No direct access to script allowed');

//controller for user profile
class Userprofile extends CI_controller{

	public function __construct(){
		parent::__construct();
		$this->load->library("Userfactory");
		$this->load->library("Questionlib");
		$this->load->library("Taglib");
		$this->load->library("session");
		$this->load->helper("url");
	}

	//method for a new user
	public function showprofile(){
		//$this->load->library("Userfactory");

		//$_SESSION['user_id'] = 56;

		if( !isset($_GET['user']) ){
			$user = $_SESSION['user_id'];		//change to $_SESSION['id']
		}
		else{
			//var_dump($_GET['user']);
			/*if( $_GET['user'] != $_SESSION['user_id'] )
			{
				http_response_code(401);
				echo "You are not logged in as user you are trying to access profile of.";
				die();
			}*/

			$user = $_GET['user'];
		}
		$data = array(
			"user_id" => $user,
			"user" => $this->userfactory->getUser($user),
			"tags" => $this->taglib->getUserTags($user),
			"questions" => $this->questionlib->get_questions_for_user($user,DEFAULT_OFFSET,DEFAULT_LIMIT)
			);

		//var_dump($data['tags']);
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
		//$this->load->view("footer");
	}

	public function changepic(){
		
		var_dump($_POST);

		$filename = $_SESSION['user_id'];
		var_dump($filename);
		//$this->load->config('config',TRUE);
		
/*	    $config['upload_path']          = UPLOAD_DIR;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 1024*1024*1024*2;
        $config['max_width']            = 2000;
        $config['max_height']           = 2768;*/

        //file config details
        $fileconfig['upload_path'] 			= $this->config->item('upload_path');
        $fileconfig['allowed_types']        = $this->config->item('allowed_types');
        $fileconfig['max_size']             = $this->config->item('max_size');
        $fileconfig['max_width']            = $this->config->item('max_width');
        $fileconfig['max_height']           = $this->config->item('max_height');
        $fileconfig['file_name'] 			= $filename;


	    $this->load->library('upload', $fileconfig);

	    

		if(!$this->upload->do_upload('userfile'))
		{
			var_dump($this->upload->display_errors());
		    echo "file upload failed";
		}
		else
		{
			$filedata = $this->upload->data();
			$filename = $filename.$filedata['file_ext'];
			var_dump($filename);
			$this->userfactory->updateProfilePicURI($_SESSION['user_id'],$filename);
			redirect('/userprofile/showprofile');
			//$this->showprofile();
		   //echo "file upload success";

		}
	}
};
?>