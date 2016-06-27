<?php

defined('BASEPATH') or exit('No direct access to script allowed');

class Question extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('show_question');
		$this->load->model('Question_model');
	}

	public function showquestionform(){
		//var_dump('show question_form');
		//echo json_encode( array( 'form' => $this->load->view('question_form','',true)));
		//echo $this->load->view('question_form');
		$this->load->view('header');
		$this->load->view('show_question');
		$this->load->view('question_form');
		$this->load->view('footer');
	}

	public function postquestion(){
		$validation_errors = array();
		$inputValid = true;

		if( !strlen( $_POST['questionTitle']) )
		{
			$validation_errors['error-question-title'] = true;
			$inputValid = false;
		}

		if( !strlen($_POST['questionContent']) )
		{
			$
		}

		$this->model->postQuestion($_POST);
	}
};

?>