<?php
defined('BASEPATH') or exit('No direct access to scripts allowed');

class Answerlib{
	private $_ci;
	private $answer_object;

	public function __construct(){
		
		$this->_ci =& get_instance();
		$this->_ci->load->model("answer_model");
		$this->_ci->load->library('session');
	}

	public function postAnswer($data){
		//$this->_ci->answer_model->addAnswerToQuestion($data['question'],56,$data['answer_content']);
		$data['user_id'] = $_SESSION['user_id'];		//change to $_SESSION['id']
		$this->_ci->answer_model->addAnswerToQuestion($data);
	}

	public function showAnswers($question_id,$offset, $limit){
		return $this->_ci->answer_model->getAnswersToQuestion($question_id,$offset,$limit);
	}

	public function get_user_for_answer($question_id)
	{
		return $this->_ci->answer_model->getUserForAnswer($question_id);
	}

	public function get_answers_for_user($user,$offset,$limit){
		return $this->_ci->answer_model->getAnswersForUser($user,$offset,$limit);
	}
}
?>