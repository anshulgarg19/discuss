<?php

	class Taglib {
		private $tag_model;
		
		function __construct() {

			$this->_ci =& get_instance();
			$this->_ci->load->model("Tag_model");
			$this->tag_model = new Tag_Model();
		}

		// Function to return a list of all tags in the database for the view
		function getTagList() {
			// Get the tag model
			return $this->tag_model->getTags();
		}

		// A function to enter user tag relationships into the database
		function saveUserTags($tags) {
			$values = array();

			foreach($tags as $tag) {
				$values[] = '('.$tag.', '.$_SESSION['u_id'].')';
			}
			
			if($this->tag_model->writeUserTags($values)) {
				return true;
			}
			else {
				return false;
			}
		}

		function getQuestionsForTag($tag) {
			return $this->tag_model->getQuestionsForTag($tag);
		}

		function isFollowingTag($tag, $userid) {
			return $this->tag_model->getFollowing($tag, $userid);
		}

		function changeFollowStatus($tag, $userid, $follow) {
			if($follow)
				$this->tag_model->followTag($tag, $userid);
			else
				$this->tag_model->unfollowTag($tag, $userid);
		}
	}
?>