<?php

defined('BASEPATH') or exit('No direct access to script allowed');

class Question extends CI_Controller{
	private $question_object;

	public function __construct(){
		parent::__construct();
		$this->load->library('Questionlib');
		$this->load->library('Answerlib');
		$this->load->helper('url');
	}

	/*public function index(){
		$this->load->view('show_question');
		
	}*/

	public function showquestionform(){
		$this->load->view('header');
		$this->load->view('question_form');
		$this->load->view('footer');
	}

	public function postquestion(){
		$validation_errors = array();
		$inputValid = true;

		//var_dump($_POST);
		//if( strlen( $_POST['questionTitle']) == 0 )
		if( strlen( $_POST['questionTitle']) == 0 )
		{
			$validation_errors['error_question_title'] = true;
			$inputValid = false;
		}

		//non empty question content
		//if( strlen($_POST['questionContent']) == 0 )
		if( strlen($_POST['questionContent']) == 0 )
		{
			$validation_errors['error_question_content'] = true;
			$inputValid = false;
		}


		//TO DO: validation for  tags

		if( !$inputValid )
		{
			http_response_code(400);
			echo json_encode($validation_errors);
			//die();
			return;
		}

		http_response_code(200);
		$inserted_questionID = $this->questionlib->post_question($_POST);

		redirect('/question/questiondetails?question='.$inserted_questionID);
		
		//echo $this->load->view('posted_question',$_POST,true);
		die();
	}

	//Function to show question contents
	public function questiondetails(){
		
		
		$details = $this->questionlib->get_question_details($_GET);		

		if( isset($details['question-not-found']) )
		{
			http_response_code(401);
			echo 'No question found';
			die();
		}
		$details['answers'] = $this->answerlib->showAnswers($_GET['question']);
		//var_dump($details['answers']);

		
		
		$this->load->view('header');
		//$this->load->view('show_question');
		$this->load->view('show_question_details',$details);
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