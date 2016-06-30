<?php
defined('BASEPATH') or exit('No direct access to scripts allowed');

class Answerlib{
	private $_ci;
	private $answer_object;

	public function __construct(){
		
		$this->_ci =& get_instance();
		$this->_ci->load->model("Answer_model");
		$this->answer_object = new Answer_model();
	}

	public function postAnswer($data){
		//var_dump($data['question']);
		//$this->answer_object->addAnswerToQuestion($data['question'],56,$data['answer_content']);
		$data['user_id'] = $_SESSION['user_id'];		//change to $_SESSION['id']
		$this->answer_object->addAnswerToQuestion($data);
	}

	public function showAnswers($question_id){
		return $this->answer_object->getAnswersToQuestion($question_id);
	}
}
?>