<?php
	// Controller for the tag follow page
	class Followtags extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->library('Taglib');
			$this->load->helper('url');
		}

		function index() { 
			$this->load->library('session');
			$tags = $this->taglib->getTagList(DEFAULT_OFFSET,DEFAULT_LIMIT);

			$data['tags'] = $tags;

			$this->load->view("follow_tag_header");
			$this->load->view("follow_tags", $data);
			$this->load->view("footer");
		}

		function TagSelect() {
			$tagsSelected = $_POST['tag'];

			// Save this user's tags
			if(!$this->taglib->saveUserTags($tagsSelected)) {
				http_response_code(500);
			}
			else {
				http_response_code(200);
				return redirect('/userhome', 'location');
			}
		}

		function loadtags(){
			$tags = $this->taglib->getTagList((int)$_POST['offset'], (int)$_POST['limit']);
			$data['tags'] = $tags;

			$this->load->view("loadtags",$data);

		}
	}
?>