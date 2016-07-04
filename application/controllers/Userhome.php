<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userhome extends CI_Controller {
	private $qmodel;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Questionlib');
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index()
	{
		$data['questions'] = $this->questionlib->getRecentQuestions(0);
		$data['followed_questions'] = $this->questionlib->getFollowedQuestions(0);
		$this->load->view('header');
		$this->load->view('user_home', $data);
		$this->load->view('footer');
	}

	public function moreQuestions() {
		if (!array_key_exists('offset', $_GET) && !defined($_GET['offset']))
			return;

		$offset = (int)$_GET['offset'];
		
		if($_GET['type'] == "recenttab") {
			$data['questions'] = $this->questionlib->getRecentQuestions($offset);
			$this->load->view('more_questions', $data);
		}
		else {
			$data['questions'] = $this->questionlib->getFollowedQuestions($offset);
			$this->load->view('more_questions', $data);
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('firstname');

		redirect('/','location');
	}
}

/* End of file Userhome.php */
/* Location: ./application/controllers/Userhome.php */
?>