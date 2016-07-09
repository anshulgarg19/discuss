<?php
defined('BASEPATH') or exit('No direct access to script allowed');

//controller for user profile
class Userprofile extends CI_controller{

	public function __construct(){
		parent::__construct();
		$this->load->library("Userlib");
		$this->load->library("Questionlib");
		$this->load->library("Answerlib");
		$this->load->library("Taglib");
		$this->load->library("session");
		$this->load->helper("url");
		$this->load->helper("validations_helper");
		$this->load->helper("pic_helper");
	}

	//method for a new user
	public function showprofile(){
		if( !isset($_GET['user']) ){
			$user = $_SESSION['user_id'];
		}
		else{
			$user = $_GET['user'];
		}


		$data = array(
			"current_user" => $_SESSION['user_id'],
			"user_id" => $user,
			"user" => $this->userlib->getUser($user),
			"tags" => $this->taglib->getUserTags($user),
			"questions" => $this->questionlib->get_questions_for_user($user,DEFAULT_OFFSET,DEFAULT_LIMIT,"POST"),
			"answers" => $this->answerlib->get_answers_for_user($user,DEFAULT_OFFSET,DEFAULT_LIMIT),
			"followed_questions" => $this->questionlib->get_questions_for_user($user,DEFAULT_OFFSET,DEFAULT_LIMIT,"FOLLOW")
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
			http_response_code(400);
			return;
		}		

		$this->load->library("userlib");
		$response = $this->userlib->activateProfile();

		
		if( $response == ACK )
			$msg = "Email successfully Verified";
		else if( $response == NACK )
			$msg = "Email already verified.";
		//bad $_GET parameters
		else 		
		{
			http_response_code(400);
			die();
		}

		$data = array(
			"message" => $msg
			);

		$this->load->view("activation_status",$data);
	}

	public function changename(){
		if( !isset($_SESSION['user_id']))		
		{
			action_invalid_user();
			return;
		}

		$this->userlib->changeName($_SESSION['user_id'],$_POST['firstname'],$_POST['lastname']);
		$_SESSION['firstname'] = $_POST['firstname'];
	}

	public function changepic(){
		
		$filename = $_SESSION['user_id'];

        //file config details
        /*$fileconfig['upload_path'] 			= $this->config->item('upload_path');
        $fileconfig['allowed_types']        = $this->config->item('allowed_types');
        $fileconfig['max_size']             = $this->config->item('max_size');
        $fileconfig['max_width']            = $this->config->item('max_width');
        $fileconfig['max_height']           = $this->config->item('max_height');*/
        

        $fileconfig = getfileconfigurations();
        $fileconfig['file_name'] = $filename;

	    $this->load->library('upload', $fileconfig);

	    

		if(!$this->upload->do_upload('userfile'))
		{
			http_response_code(400);
		    echo $this->upload->display_errors();
		    return;
		}
		else
		{
			$filedata = $this->upload->data();
			$filename = $filename.$filedata['file_ext'];
			$this->userlib->updateProfilePicURI($_SESSION['user_id'],$filename);
			redirect('/userprofile/showprofile','location');
		}
	}


	public function unfollowtag(){
		$this->taglib->unfollowTag((int)$_POST['tag_id'], $_SESSION['user_id']);
	}
};
?>