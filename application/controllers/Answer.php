<?php
defined('BASEPATH') or exit('No direct access to script allowed');

class Answer extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('Answerlib');
		$this->load->library('Questionlib');
		$this->load->helper('email_helper');
	}

	//method to post answer
	public function postanswer(){
		var_dump($_POST);
		$this->answerlib->postAnswer($_POST);
		
	}

	public function sendactivitymail(){
		$userList = array();
		$question_user = $this->questionlib->get_user_for_question($_POST['question']);
		$answer_user = $this->answerlib->get_user_for_answer($_POST['question']);
		$userList = array_merge($userList, $question_user);
		$userList = array_merge($userList, $answer_user);

		$question_title = $this->questionlib->get_question_title($_POST['question']);

		$senddata['subject'] = ACTIVITY_SUBJECT;
		$message = ACTIVITY_MESSAGE.$question_title.'? . Review the activity using the link: '.QUESTION_URI.'?question='.$_POST['question'];
		$senddata['message'] = $message;

		foreach ($userList as $user) {
			$senddata['to'] = $user;
			sendmail($senddata);
		}	
	}

	public function loadanswers(){
		$data['answers'] = $this->answerlib->showAnswers($_POST['question'], (int)$_POST['offset'], (int)$_POST['limit']);

		$this->load->view('loadanswers',$data);

	}
	//method to fetch answers for a question
	/*public function showanswers(){
		$question_id = 20;
		return $this->answerlib->showAnswers($question_id);
	}*/
};
?>