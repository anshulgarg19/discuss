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
			$this->load->library('session');
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
	    public function getRecentQuestions($offset) {
	    	$q = "SELECT * FROM Questions ORDER BY last_modified_on DESC LIMIT ?,10";
	    	$result = $this->db->query($q, array($offset));
	    	$retval = array();
	    	foreach($result->result_array() as $row) {
	    		$retval[$row['question_id']] = array(
	    				"question_id" => $row['question_id'],
	    				"question_content" => $row['question_content'],
	    				"title" => $row['title'],
	    				"last_modified_on" => $row['last_modified_on'],
	    				"created_on" => $row['created_on'],
	    				"answer_count" => $row['answer_count'] 
	    			);
	    	}
	    	return $retval;
	    }

	    // Function to return questions for tags that the user was following recently

	    public function interestQuestion($user_id) {
	    	$q = "SELECT DISTINCT Questions.question_id FROM Questions INNER JOIN Tags_Questions INNER JOIN Users_Tags ON Questions.question_id = Tags_Questions.question_id WHERE Tags_Questions.tag_id = Users_Tags.tag_id AND Users_Tags.user_id=?";
	    	$result = $this->db->query($q, array($user_id));
	    }

	    //Function to store question into database
	    public function postQuestion( $data ){
	    	$tags = explode(',', $data['questionTags']);

	    	//insert question

	    	$insertData = array();
	    	$insertData['question_id'] = '';
	    	$insertData['question_content'] = $data['questionContent'];
	    	$insertData['title'] = $data['questionTitle'];

	    	$this->db->insert('Questions',$insertData);
	    	$insertedID = $this->db->insert_id();

	    	//
	    	//TO DO: change the user id from session id
	    	//

	    	//inserting in user question relation
	    	$query = 'INSERT into Users_Questions(user_id,question_id,type) values(?,?,"POST")';
	    	$result = $this->db->query($query,array( $_SESSION['user_id'], $insertedID));


	    	$tagData = array();

	    	$query = 'SELECT tag_id from Users_Tags where user_id=?';
	    	$result = $this->db->query($query, array( $_SESSION['user_id']));
	    	$followed_tags = $result->result_array();
	    	$followed_tags_assoc = array();
	    	$new_tags_followed = array();
	    	$new_tags = array();

	    	$new_question = array();

	    	//var_dump($followed_tags);
	    	foreach ($followed_tags as $followed_tag) {
	    		//var_dump($followed_tag);
	    		$followed_tags_assoc[$followed_tag['tag_id']]	= 1;
	    	}

	    	foreach($tags as $tag)
	    	{
	    		$tag = strtolower($tag);

	    		$query = 'SELECT tag_id from Tags where tag_name=?';
	    		$result = $this->db->query( $query, array($tag));

	    		//tag already present
	    		if( $result->num_rows() )
	    		{
	    			$response = $result->row();

	    			$tag_id = $response->tag_id;
	    			//update question count in Tags table
	    			$query = 'UPDATE Tags set question_count = question_count+1 where tag_id=?';
	    			$this->db->query($query, array($tag_id));

	    			
	    			//INSERT INTO Users_Tags VALUES (1, 1), (1, 2);

	    		}
	    		//tag not present
	    		else
	    		{
	    			$tagData['tag_id'] = '';
	    			$tagData['tag_name'] = $tag;
	    			$tagData['question_count'] = 1;
	    			//$tagData['user_count'] = 1;
	    			//insert new tag in Tags table
	    			$this->db->insert('Tags',$tagData);
	    			$tag_id = $this->db->insert_id();
	    		}

	    		if( !isset($followed_tags_assoc[$tag_id]) )
    			{
    				$new_tags_followed[] = '('.$tag_id.', '.$_SESSION['user_id'].')';
    				$new_tags[] = $tag_id;
    			}

    			$new_question[] = '('.$tag_id.', '.$insertedID.')';
    			
	    	}

	    	//inserting unfollowed tags in table
	    	
	    	if( count($new_tags_followed) ){
		    	$query = 'INSERT into Users_Tags(tag_id,user_id) VALUES '.implode(',',$new_tags_followed);
		    	$this->db->query($query);
		    	$query = 'UPDATE Tags set user_count = user_count+1 where tag_id in ('.implode(',',$new_tags).')';
		    	$this->db->query($query);
		    }

	    	//inserting new questions in table
	    	$query = 'INSERT into Tags_Questions(tag_id,question_id) VALUES '.implode(',', $new_question);
	    	$this->db->query($query);

	    	return $insertedID;
	    }

	    //Function to return question details 
	    public function getQuestionDetails($data, $current_user){
	    	$question_id = (int)$data['question'];
	    	$results = array();

	    	//$query = 'SELECT Users.user_id,firstname from Users INNER JOIN Users_Questions on Users.user_id = Users_Questions.user_id where question_id=?';
	    	$query = 'SELECT Users.user_id,firstname from Users INNER JOIN Users_Questions on Users.user_id = Users_Questions.user_id where question_id=? and type="POST"';

	    	$result = $this->db->query($query, array($question_id));

	    	if( !$result->num_rows() )
	    	{
	    		$results['question-not-found'] = true;
	    		return $results;
	    	}

	    	$result = $result->row();

	    	$results['user_id'] = $result->user_id;
	    	$results['user_name'] = $result->firstname;

	    	
	    	$results['posted'] = ($result->user_id == $current_user);

	    	$query = 'SELECT user_id from Users_Questions where question_id=? and user_id=? and type="FOLLOW"';
	    	$result = $this->db->query($query, array($question_id,$current_user));

	    	$results['following'] = ($result->num_rows() > 0 );

	    	$query ='select question_content,title,created_on,answer_count from Questions where question_id=?';
	    	$result = $this->db->query($query,array($question_id));
	    	$result =  $result->row();

	    	$results['question_id'] = $question_id;
	    	$results['title'] = $result->title;
	    	$results['question_content'] = $result->question_content;
	    	$results['created_on'] = $result->created_on;
	    	$results['answer_count'] = $result->answer_count;

	    	$query = 'select Tags.tag_id,Tags.tag_name from Tags_Questions INNER JOIN Tags on Tags_Questions.tag_id = Tags.tag_id where Tags_Questions.question_id=?';	//change 19 to $_SESSION['id']

	    	$result = $this->db->query($query, array($question_id));
	    	$result = $result->result();

	    	$results['tags'] = $result;

	    	return $results;

	    	/*$query = 'SELECT Tags.tag_name from Questions INNER JOIN Tags_Questions on Questions.question_id = Tags_Questions.question_id INNER JOIN Tags on Tags.tag_id = Tags_Questions.tag_id where Tags_Questions.question_id = ?';
	    	$result = $this->db->query($query, array($question_id));	*/

	    }

	    //Function to return questions posted by a user
	    public function getQuestionsForUser($user_id,$offset,$limit){
	    	$query = 'SELECT Questions.question_id, Questions.title, Questions.answer_count from Questions INNER JOIN Users_Questions on Questions.question_id = Users_Questions.question_id where Users_Questions.user_id =? order by Questions.created_on desc LIMIT ?,?';
	    	$result = $this->db->query($query, array($user_id,$offset,$limit));
	    	return $result->result();
	    }

	    public function getQuestionsForFollowedTags($taglist, $offset) {

	    	$q = "SELECT DISTINCT Questions.question_id as question_id, Questions.question_content, title, Questions.last_modified_on, Questions.created_on as created_on, Questions.answer_count FROM Questions INNER JOIN Tags_Questions ON Questions.question_id=Tags_Questions.question_id WHERE Tags_Questions.tag_id IN(?)ORDER BY Questions.last_modified_on DESC LIMIT ?,10";

	    	$result = $this->db->query($q, array(implode(',', $taglist), $offset));
	    	$retval = array();
	    	foreach($result->result_array() as $row) {
	    		$retval[$row['question_id']] = array(
	    				"question_id" => $row['question_id'],
	    				"question_content" => $row['question_content'],
	    				"title" => $row['title'],
	    				"last_modified_on" => $row['last_modified_on'],
	    				"created_on" => $row['created_on'],
	    				"answer_count" => $row['answer_count'] 
	    			);
	    	}
	    	return $retval;
	    }

	    public function getUserForQuestion( $question_id){
	    	$query = 'SELECT distinct(email_id) from Users INNER JOIN Users_Questions on Users.user_id= Users_Questions.user_id where Users_Questions.question_id=?';
	    	$result = $this->db->query($query, array($question_id));

	    	return $result->result_array();
	    }

	    public function getQuestionTitle($question_id){
	    	$query = 'SELECT title from Questions where question_id=?';
	    	$result = $this->db->query($query, array($question_id));

	    	$result = $result->row();
	    	return $result->title;
	    }

	    public function changeFollowStatus($data, $user_id){
	    	if( $data['following_question'] )
	    	{
	    		$query = 'DELETE from Users_Questions where user_id=? and question_id=? and type="FOLLOW"';
	    		$this->db->query($query, array($user_id, (int)$data['question_id']));
	    	}
	    	else
	    	{
	    		$query = 'INSERT into Users_Questions(user_id,question_id,type) VALUES(?,?,"FOLLOW")';
	    		$this->db->query($query, array($user_id, (int)$data['question_id']));
	    	}

	    	/*$query = 'SELECT type from Users_Questions where question_id=? and user_id=?';
	    	$result = $this->db->query($query, array($question_id,$user_id));

	    	if( $result->num_rows() )
	    	{
	    		$result = $result->row();
	    		if( $result->type == "FOLLOW"){
	    			$query = 'DELETE from Users_Questions where user_id=? and question_id=?';
	    			$this->db->query($query, array($user_id, $question_id));
	    		}
	    	}
	    	else
	    	{
	    		$query = 'INSERT into Users_Questions(user_id,question_id,type) VALUES(?,?,"FOLLOW")';
	    		$this->db->result($query, array($user_id, $question_id));
	    	}*/
	    }
	};
	/* End of file Question_model.php */
	/* Location: ./application/models/Question_model.php */
?>