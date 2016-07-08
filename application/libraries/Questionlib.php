<?php
defined('BASEPATH') or exit('No direct access to scripts allowed');

class Questionlib{

	function __construct(){
		$this->_ci =& get_instance();
		$this->_ci->load->model("question_model");
		$this->_ci->load->model("tag_model");
		$this->_ci->load->library("session");
	}

	// Function to get recent questions and combine them with tags fetched
	// from Solr, used to render the homepage
	public function getRecentQuestions($offset) {
		$questions = $this->_ci->question_model->getRecentQuestions($offset);
		if(count($questions) == 0)
			return array();

		return $questions;
	}

	// Function to return recent questions posted in the categories
	// that are followed by the user.
	public function getFollowedQuestions($offset) {
		$tagsFollowed = $this->_ci->tag_model->get_user_tags($_SESSION['user_id']);
		$ids = array();
		foreach($tagsFollowed as $tag) {
			$ids[] = $tag->tag_id;
		}
		$questions = $this->_ci->question_model->getQuestionsForFollowedTags($ids, $offset);
		// var_dump($questions);
		if(count($questions) == 0)
			return array();

		$tags = $this->_ci->tag_model->getTagsForRecentsFromSolr($questions);

		foreach($tags->response->docs as $tag) {
			$questions[(int)$tag->id]["tag_names"] = $tag->tag_names;
			$questions[(int)$tag->id]["id_list"] = $tag->id_list;
		}
		return $questions;
	}

	public function post_question($data){
		//$this->_ci->question_model->postQuestion($_POST);
		return $this->_ci->question_model->postQuestion($data);
	}

	public function get_question_details($data,$current_user){
		return $this->_ci->question_model->getQuestionDetails($data,$current_user);
	}

	public function get_questions_for_user($user_id,$offest, $limit,$type){
		return $this->_ci->question_model->getQuestionsForUser($user_id,$offest,$limit,$type);
	}

	public function get_user_for_question($question_id){
		return $this->_ci->question_model->getUserForQuestion($question_id);
	}

	public function get_question_title($question_id)
	{
		return $this->_ci->question_model->getQuestionTitle($question_id);
	}

	public function change_follow_status($data,$user_id){
		return $this->_ci->question_model->changeFollowStatus($data, $user_id);
	}

	
};

?>