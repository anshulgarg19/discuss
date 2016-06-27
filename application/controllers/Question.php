<?php

defined('BASEPATH') or exit('No direct access to script allowed');

class Question extends CI_Controller{
	private $question_object;

	public function __construct(){
		parent::__construct();
		$this->load->library('Questionlib');
		$this->load->library('Answerlib');
	}

	public function index(){
		$this->load->view('show_question');
		
	}

	public function showquestionform(){
		$this->load->view('header');
		$this->load->view('show_question');
		$this->load->view('question_form');
		$this->load->view('footer');
	}

	public function postquestion(){
		$validation_errors = array();
		$inputValid = true;

		
		if( strlen( $_POST['questionTitle']) == 0 )
		{
			$validation_errors['error-question-title'] = true;
			$inputValid = false;
		}

		//non empty question content
		if( strlen($_POST['questionContent']) == 0 )
		{
			$validation_errors['error-question-content'] = true;
			$inputValid = false;
		}


		if( !$inputValid )
		{
			echo json_encode($validation_errors);
			die();
		}

		$this->questionlib->post_question($_POST);
		
		echo $this->load->view('posted_question',$_POST,true);
		die();
	}

	//Function to show question contents
	public function questiondetails(){
		

		$details = $this->questionlib->get_question_details($_GET);		
		$details['answers'] = $this->answerlib->showAnswers($_GET['question']);
		//var_dump($details['answers']);

		
		
		$this->load->view('header');
		$this->load->view('show_question');
		$this->load->view('showQuestionDetails',$details);
		$this->load->view('footer');

		//var_dump($details);
		//die();

		/*$data = array('questionTitle' => $details['title'], 
					'question-Content' => $details['question_content'],
					'questionTags' => $details['tags']);

		$this->load->view('header');
		$this->load->view('show_question');
		$this->load->view('posted_question',$data);
		$this->load->view('footer');

		$this->load->view('header');
		$this->load->view('show_question');
		$this->load->view('')*/
	}
};

?>