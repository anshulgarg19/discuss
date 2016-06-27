<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Question_Model extends CI_Model {
		private $q_id;
		private $content;
		private $created;
		private $answer_count;
		private $title;

		function __construct() {
			parent::__construct();
		}


		
	    /**
	     * Gets the value of q_id.
	     *
	     * @return mixed
	     */
	    public function getQId()
	    {
	        return $this->q_id;
	    }

	    /**
	     * Sets the value of q_id.
	     *
	     * @param mixed $q_id the q id
	     *
	     * @return self
	     */
	    public function _setQId($q_id)
	    {
	        $this->q_id = $q_id;

	        
	    }

	    /**
	     * Gets the value of content.
	     *
	     * @return mixed
	     */
	    public function getContent()
	    {
	        return $this->content;
	    }

	    /**
	     * Sets the value of content.
	     *
	     * @param mixed $content the content
	     *
	     * @return self
	     */
	    public function _setContent($content)
	    {
	        $this->content = $content;

	        
	    }

	    /**
	     * Gets the value of created.
	     *
	     * @return mixed
	     */
	    public function getCreated()
	    {
	        return $this->created;
	    }

	    /**
	     * Sets the value of created.
	     *
	     * @param mixed $created the created
	     *
	     * @return self
	     */
	    public function _setCreated($created)
	    {
	        $this->created = $created;

	        
	    }

	    /**
	     * Gets the value of answer_count.
	     *
	     * @return mixed
	     */
	    public function getAnswerCount()
	    {
	        return $this->answer_count;
	    }

	    /**
	     * Sets the value of answer_count.
	     *
	     * @param mixed $answer_count the answer count
	     *
	     * @return self
	     */
	    public function _setAnswerCount($answer_count)
	    {
	        $this->answer_count = $answer_count;
	    }

	    /**
	     * Gets the value of title.
	     *
	     * @return mixed
	     */
	    public function getTitle()
	    {
	        return $this->title;
	    }

	    /**
	     * Sets the value of title.
	     *
	     * @param mixed $title the title
	     *
	     * @return self
	     */
	    public function _setTitle($title)
	    {
	        $this->title = $title;

	        
	    }

	    // Function to return a collection of the ten most recent questions
	    public function getRecentQuestions() {
	    	$q = "SELECT question_id, question_content, created_on, title, answer_count FROM Questions ORDER BY created_on DESC LIMIT 10";
	    	$result = $this->db->query($q);
	    	return $result->result_array();
	    }

	    public function interestQuestion($user_id) {
	    	$q = "SELECT DISTINCT Questions.question_id FROM Questions INNER JOIN Tags_Questions INNER JOIN Users_Tags ON Questions.question_id = Tags_Questions.question_id WHERE Tags_Questions.tag_id = Users_Tags.tag_id AND Users_Tags.user_id=?";
	    	$result = $this->db->query($q, array($user_id));

	    	
	    }
	}
	
	/* End of file Question_model.php */
	/* Location: ./application/models/Question_model.php */
?>