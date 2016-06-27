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
		$data['questions'] = $this->taglib->getQuestionsForTag($_GET['tag']);
		$data['tag'] = $_GET['tag'];
		$data['following'] = $this->taglib->isFollowingTag($_GET['tag'], 40);
		$this->load->view("header");
		$this->load->view('tag_details', $data);		
		$this->load->view("footer");
	}

	public function changeFollowStatus()
	{
		var_dump($_POST);
		$_SESSION['user_id'] = 40;
		$this->taglib->changeFollowStatus($_POST['tag'], $_SESSION['user_id'], !(int)$_POST["followstatus"]);
	}

}

/* End of file Tagdetails.php */
/* Location: ./application/controllers/Tagdetails.php */
?>