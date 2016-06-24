<?php

	class Taglib {

		function __construct() {

			$this->_ci =& get_instance();
			$this->_ci->load->model("Tag_model");
		}

		// Function to return a list of all tags in the database for the view
		function getTagList() {
			// Get the tag model
			$tag_model = new Tag_Model();
			return $tag_model->getTags();
		}

		// A function to enter user tag relationships into the database
		function saveUserTags($tags) {
			$tag_model = new Tag_Model();
			$values = array();

			foreach($tags as $tag) {
				$values[] = '('.$tag.', '.$_SESSION['u_id'].')';
			}
			
			if($tag_model->writeUserTags($values)) {
				return true;
			}
			else {
				return false;
			}
		}
	}
?>