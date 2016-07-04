<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagdetails extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Taglib');
		$this->load->library('session');
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

		$data['tag'] =  $_GET["tag"];
		$data['tag_name'] =  $response;
		$data['questions'] = $this->taglib->getQuestionsForTag($_GET['tag'], 0);
		$data['num_followers'] = $this->taglib->getNumFollowers($_GET['tag']);
		$data['following'] = $this->taglib->isFollowingTag($_GET['tag'], $_SESSION['user_id']);
		$this->load->view("header");
		$this->load->view('tag_details', $data);		
		$this->load->view("footer");
	}

	public function moreQuestions() {

		if(!isset($_GET['tag']) && !isset($_GET['offset']))
			return;
		$data['questions'] = $this->taglib->getQuestionsForTag($_GET['tag'], $_GET['offset']);
		$this->load->view("more_questions_tagpage.php", $data);
	}

	public function changeFollowStatus()
	{
		$this->taglib->changeFollowStatus($_POST['tag'], $_SESSION['user_id'], !(int)$_POST["followstatus"]);
	}

}

/* End of file Tagdetails.php */
/* Location: ./application/controllers/Tagdetails.php */
?>