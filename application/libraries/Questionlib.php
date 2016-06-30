<?php
defined('BASEPATH') or exit('No direct access to scripts allowed');

class Questionlib{
	private $_ci;
	private $question_model;

	function __construct(){
		$this->_ci =& get_instance();
		$this->_ci->load->model("Question_model");
		$this->_ci->load->model("Tag_model");
		$this->_ci->load->library("session");
		$this->question_model = new Question_model();
		$this->tag_model = new Tag_Model();
	}

	// Function to get recent questions and combine them with tags fetched
	// from Solr, used to render the homepage
	public function getRecentQuestions() {
		$questions = $this->question_model->getRecentQuestions();
		$tags = $this->tag_model->getTagsForRecentsFromSolr($questions);

		foreach($tags->response->docs as $tag) {
			$questions[(int)$tag->id]["tag_names"] = $tag->tag_names;
			$questions[(int)$tag->id]["id_list"] = $tag->id_list;
		}

		return $questions;
	}

	// Function to return recent questions posted in the categories
	// that are followed by the user.
	public function getFollowedQuestions() {
		$tagsFollowed = $this->tag_model->get_user_tags($_SESSION['user_id']);
		$ids = array();
		foreach($tagsFollowed as $tag) {
			$ids[] = $tag->tag_id;
		}
		$questions = $this->question_model->getQuestionsForFollowedTags($ids);
		$tags = $this->tag_model->getTagsForRecentsFromSolr($questions);

		foreach($tags->response->docs as $tag) {
			$questions[(int)$tag->id]["tag_names"] = $tag->tag_names;
			$questions[(int)$tag->id]["id_list"] = $tag->id_list;
		}
		return $questions;
	}

	public function post_question($data){
		//$this->question_model->postQuestion($_POST);
		return $this->question_model->postQuestion($data);
	}

	public function get_question_details($data){
		return $this->question_model->getQuestionDetails($data);
	}

	public function get_questions_for_user($user_id){
		return $this->question_model->getQuestionsForUser($user_id);
	}
};

?>