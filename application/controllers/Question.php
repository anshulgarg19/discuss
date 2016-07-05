<?php

defined('BASEPATH') or exit('No direct access to script allowed');

class Question extends CI_Controller{
	private $question_object;

	public function __construct(){
		parent::__construct();
		$this->load->library('Questionlib');
		$this->load->library('Answerlib');
		$this->load->helper('url');
		$this->load->helper('validations_helper');
	}

	/*public function index(){
		$this->load->view('show_question');
		
	}*/

	public function loadquestions(){
		$data["questions"] = $this->questionlib->get_questions_for_user((int)$_POST['user_id'],(int)$_POST['offset'],(int)$_POST['limit']);
		$this->load->view('loadquestions',$data);
	}

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
		
		if( !isset($_SESSION['user_id']) )
		{
			action_invalid_user();
		}
		//$_SESSION['user_id'] = 56;
		$details = $this->questionlib->get_question_details($_GET,$_SESSION['user_id']);		

		if( isset($details['question-not-found']) )
		{
			http_response_code(401);
			echo 'No question found';
			die();
		}
		$details['answers'] = $this->answerlib->showAnswers($_GET['question'],DEFAULT_OFFSET,DEFAULT_LIMIT);
		//var_dump($details['answers']);

		
		
		$this->load->view('header');
		//$this->load->view('show_question');
		$this->load->view('show_question_details',$details);
		$this->load->view('footer');

	}

	//Function to change question follow status
	public function changefollowstatus(){

		if( !isset($_SESSION['user_id']) )
			action_invalid_user();

		//$question_id = (int)$_POST['question_id'];
		//var_dump($question_id);
		$this->questionlib->change_follow_status($_POST,$_SESSION['user_id']);
	}
};

?>