<?php
	// Controller for the tag follow page
	class Followtags extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->library('Taglib');
		}

		function index() {

			$tags = $this->taglib->getTagList();

			$data['tags'] = $tags;

			$this->load->view("header");
			$this->load->view("follow_tags", $data);
			$this->load->view("footer");
			$this->load->library('session');
			var_dump($_SESSION);
		}

		function TagSelect() {

			$tagsSelected = json_decode(stripslashes($_POST['data']));

			// Save this user's tags
			if(!$this->taglib->saveUserTags($tagsSelected)) {
				http_response_code(500);
			}
			else {
				http_response_code(200);
			}
		}
	}
?>