<?php

	class Taglib {
		private $tag_model;
		
		function __construct() {

			$this->_ci =& get_instance();
			$this->_ci->load->model("Tag_model");
			$this->_ci->load->library("session");
			$this->tag_model = new Tag_Model();
		}

		// Function to return a list of all tags in the database for the view
		function getTagList($offset,$limit) {
			// Get the tag model
			return $this->tag_model->getTags($offset,$limit);
		}

		// A function to get the number of people who follow this tag
		function getNumFollowers($tagid) {
			return $this->tag_model->getFollowers($tagid);
		}
		// A function to enter user tag relationships into the database
		function saveUserTags($tags) {
			$values = array();

			foreach($tags as $tag) {
				$values[] = '('.$tag.', '.$_SESSION['user_id'].')';
			}
			
			if($this->tag_model->writeUserTags($values, $tags)) {
				return true;
			}
			else {
				return false;
			}
		}

		function getTagName($tag){
			return $this->tag_model->getTagName($tag);
		}

		function getQuestionsForTag($tag, $offset) {
			$result = $this->tag_model->getQuestionsForTagSolr($tag, $offset);
			if(!$result->response->docs)
				return array();

			return (array)$result->response->docs;
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

		function getUserTags($user){
			return $this->tag_model->get_user_tags($user);
		}
	}
?>