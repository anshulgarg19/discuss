<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("Suggesterlib");
	}

	public function suggest()
	{
		if(strlen($_GET['query']) == 0)
			return;
		echo json_encode($this->suggesterlib->getSuggestions(strtolower($_GET['query'])));
	}

}

/* End of file Search.php */
/* Location: ./application/controllers/Search.php */