<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userhome extends CI_Controller {
	private $qmodel;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Questionlib');
	}

	public function index()
	{
		$data['questions'] = $this->questionlib->getRecentQuestions();
		$this->load->view('header');
		$this->load->view('user_home', $data);
		$this->load->view('footer');
	}

}

/* End of file Userhome.php */
/* Location: ./application/controllers/Userhome.php */
?>