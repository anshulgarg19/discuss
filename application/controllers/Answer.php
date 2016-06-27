<?php
defined('BASEPATH') or exit('No direct access to script allowed');

class Answer extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('Answerlib');
	}

	//method to post answer
	public function postanswer(){
		//var_dump($_POST);
		$this->answerlib->postAnswer($_POST);
	}

	//method to fetch answers for a question
	public function showanswers(){
		$question_id = 20;
		return $this->answerlib->showAnswers($question_id);
	}
};
?>