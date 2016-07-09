<?php

	class Taglib {
		
		function __construct() {

			$this->_ci =& get_instance();
			$this->_ci->load->model("tag_model");
			$this->_ci->load->library("session");
		}

		// Function to return a list of all tags in the database for the view
		function getTagList($offset,$limit) {
			// Get the tag model
			return $this->_ci->tag_model->getTags($offset,$limit);
		}

		// A function to get the number of people who follow this tag
		function getNumFollowers($tagid) {
			return $this->_ci->tag_model->getFollowers($tagid);
		}
		// A function to enter user tag relationships into the database
		function saveUserTags($tags) {
			$values = array();
			
			
			foreach($tags as $tag) {
				$values[] = '('.$tag.', '.$_SESSION['user_id'].')';
			}

			
			if($this->_ci->tag_model->writeUserTags($values, $tags)) {
				return true;
			}
			else {
				return false;
			}
		}

		function getTagName($tag){
			return $this->_ci->tag_model->getTagName($tag);
		}

		function getQuestionsForTag($tag, $offset) {
			return $this->_ci->tag_model->getQuestionsForTagSolr($tag, $offset);
		}

		function isFollowingTag($tag, $userid) {
			return $this->_ci->tag_model->getFollowing($tag, $userid);
		}

		function changeFollowStatus($tag, $userid, $follow) {
			if($follow)
				$this->_ci->tag_model->followTag($tag, $userid);
			else
				$this->_ci->tag_model->unfollowTag($tag, $userid);
		}

		function getUserTags($user){
			return $this->_ci->tag_model->get_user_tags($user);
		}

		function unfollowTag($tag_id, $user_id){
			$this->_ci->tag_model->unfollowTag($tag_id,$user_id);
		}
	}
?>