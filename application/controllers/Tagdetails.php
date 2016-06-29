<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagdetails extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Taglib');
	}

	public function index()
	{
		$response = $this->taglib->getTagName($_GET['tag']);
		if( $response == BAD_REQUEST )
		{
			http_response_code(401);
			echo 'Tag not found';
			die();
		}

		$data['tag'] =  $response;
		$data['questions'] = $this->taglib->getQuestionsForTag($_GET['tag']);
				
		$data['following'] = $this->taglib->isFollowingTag($_GET['tag'], 40);
		$this->load->view("header");
		$this->load->view('tag_details', $data);		
		$this->load->view("footer");
	}

	public function changeFollowStatus()
	{
		$_SESSION['user_id'] = 40;
		$this->taglib->changeFollowStatus($_POST['tag'], $_SESSION['user_id'], !(int)$_POST["followstatus"]);
	}

}

/* End of file Tagdetails.php */
/* Location: ./application/controllers/Tagdetails.php */
?>