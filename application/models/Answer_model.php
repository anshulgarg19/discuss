<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Answer_Model extends CI_Model {
	private $answer_id;
	private $user_id;
	private $question_id;
	private $created_on;
	private $answer_content;

	public function __construct()
	{
		parent::__construct();
	}	

    /**
     * Gets the value of answer_id.
     *
     * @return mixed
     */
    public function getAnswerId()
    {
        return $this->answer_id;
    }

    /**
     * Sets the value of answer_id.
     *
     * @param mixed $answer_id the answer id
     *
     * @return self
     */
    public function _setAnswerId($answer_id)
    {
        $this->answer_id = $answer_id;
    }

    /**
     * Gets the value of user_id.
     *
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Sets the value of user_id.
     *
     * @param mixed $user_id the user id
     *
     * @return self
     */
    public function _setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Gets the value of question_id.
     *
     * @return mixed
     */
    public function getQuestionId()
    {
        return $this->question_id;
    }

    /**
     * Sets the value of question_id.
     *
     * @param mixed $question_id the question id
     *
     * @return self
     */
    public function _setQuestionId($question_id)
    {
        $this->question_id = $question_id;
    }

    /**
     * Gets the value of created_on.
     *
     * @return mixed
     */
    public function getCreatedOn()
    {
        return $this->created_on;
    }

    /**
     * Sets the value of created_on.
     *
     * @param mixed $created_on the created on
     *
     * @return self
     */
    public function _setCreatedOn($created_on)
    {
        $this->created_on = $created_on;
    }

    /**
     * Gets the value of answer_content.
     *
     * @return mixed
     */
    public function getAnswerContent()
    {
        return $this->answer_content;
    }

    /**
     * Sets the value of answer_content.
     *
     * @param mixed $answer_content the answer content
     *
     * @return self
     */
    public function _setAnswerContent($answer_content)
    {
        $this->answer_content = $answer_content;
    }

    //public function addAnswerToQuestion($questionid, $userid, $answer_content) {
    public function addAnswerToQuestion($data){

        $query = 'insert into Answers(question_id,user_id,answer_content) values(?,?,?);';
        $this->db->query($query, array($data['question'],$data['user_id'],$data['answer_content']));
        $this->db->query('UPDATE Questions SET answer_count=answer_count + 1 WHERE question_id=?', array($data['question']));        
    }

    public function getAnswersToQuestion($question_id,$offset,$limit) {

    	$answers = $this->db->query("SELECT firstname, Users.user_id, Answers.created_on, answer_content FROM Users INNER JOIN Answers ON Answers.user_id=Users.user_id WHERE Answers.question_id=? order by created_on desc limit ?,?;", array($question_id,$offset,$limit));
    	return $answers->result_array();
    }

    public function getUserForAnswer($question_id){
        $query = 'SELECT distinct(email_id) from Users INNER JOIN Answers on Users.user_id=Answers.user_id where Answers.question_id=?';
        $result = $this->db->query($query, array($question_id));
        if( $result->num_rows() )
        {
            return $result->result_array();
        }
    }

    public function getAnswersForUser($user,$offset,$limit){
        $query = 'SELECT Questions.question_id,Questions.title,Answers.answer_content from Questions INNER JOIN Answers on Questions.question_id = Answers.question_id WHERE Answers.user_id = ? order by Answers.created_on desc limit ?,?';
        $result = $this->db->query($query, array($user,$offset,$limit));
        return $result->result();
    }
}

/* End of file Answer_model.php */
/* Location: ./application/models/Answer_model.php */
?>