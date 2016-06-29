<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userhome extends CI_Controller {
	private $qmodel;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Question_model');
		$this->qmodel = new Question_Model();
	}

	public function index()
	{
		$data['questions'] = $this->qmodel->getRecentQuestions();
		$this->load->view('header');
		$this->load->view('user_home', $data);
		$this->load->view('footer');
	}

}

/* End of file Userhome.php */
/* Location: ./application/controllers/Userhome.php */
?>