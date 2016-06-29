<?php
defined('BASEPATH') or exit('No direct access to scripts allowed');

class Questionlib{
	private $_ci;
	private $question_model;

	function __construct(){
		$this->_ci =& get_instance();
		$this->_ci->load->model("Question_model");
		$this->question_model = new Question_model();
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