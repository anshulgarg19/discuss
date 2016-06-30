<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("Suggesterlib");
		$this->load->helper("url");
	}

	public function suggest()
	{
		if(strlen($_GET['query']) == 0)
			return;
		echo json_encode($this->suggesterlib->getSuggestions(strtolower($_GET['query'])));
	}

	public function getresults() {
		return redirect('tagdetails?tag='.$_GET['value'],'location');
	}
}

/* End of file Search.php */
/* Location: ./application/controllers/Search.php */