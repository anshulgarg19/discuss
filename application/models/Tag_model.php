<?php
	
	class Tag_Model extends CI_Model {

		private $id;
		private $tag_name;

		function __construct() {
			parent::__construct();
		}

		// Get the list of all tags from the databse.
		public function getTags() {

			$result = $this->db->query("SELECT * FROM Tags");

			if($result)
				return $result->result_array();
			else
				// return an empty result array
				return array();
		}

		public function writeUserTags($pairs) {

			$q = 'INSERT INTO Users_Tags (tag_id, user_id) VALUES '.implode(',', $pairs);
			
			print_r($q);
			$result = $this->db->query($q);

			if($result) {
				return true;
			}

			else {

				print_r($result->error());
				return false;
			}
		}

		public function getQuestionsForTag($tag)
		{
			$q = "SELECT title, Questions.created_on, question_content, answer_count FROM Tags_Questions INNER JOIN Questions on Questions.question_id=Tags_Questions.question_id INNER JOIN Tags on Tags_Questions.tag_id = Tags.tag_id WHERE Tags.tag_id=? ORDER BY Questions.created_on DESC LIMIT 10";
			$result = $this->db->query($q, array($tag));
			if(!$result) {
				return $this->error();
			}

			return $result->result_array();
		}

		public function getFollowing($tag, $userid)
		{
			$result = $this->db->query("SELECT * FROM Users_Tags JOIN Tags on Users_Tags.tag_id=Tags.tag_id WHERE user_id=? AND Tags.tag_name=?", array($userid, $tag));

			if($result->num_rows())
				return true;
			else
				return false;
		}

		public function unfollowTag($tag, $userid)
		{
			$tagid = $this->db->query("SELECT tag_id FROM Tags WHERE tag_name=?", array($tag));
			$result = $this->db->query("DELETE FROM Users_Tags WHERE user_id=? AND tag_id=?",
				array($userid, $tagid->row()->tag_id));
		}

		public function followTag($tag, $userid)
		{
			$tagid = $this->db->query("SELECT tag_id FROM Tags WHERE tag_name=?", array($tag));
			$result = $this->db->query("INSERT INTO Users_Tags(user_id, tag_id) VALUES (?,?)",
				array($userid, $tagid->row()->tag_id));
		}

		// Utility function to check whether user is following any tags at all
		function isFollowingTags($user_id) {

			if($this->db->query("SELECT * FROM Users_Tags WHERE user_id=?", array($user_id))->num_rows() > 0) {
				return true;
			}
			else
				return false;
		}

		function get_user_tags($user){
			$query = 'select Tags.tag_id,Tags.tag_name from Users INNER JOIN Users_Tags on Users.user_id= Users_Tags.user_id INNER JOIN Tags on Tags.tag_id = Users_Tags.tag_id where Users.user_id=?
				';
			$result = $this->db->query($query,array((int)$user));
			return $result->result();
		}

		function getTagName($tag){
			$query = 'select tag_name from Tags where tag_id=?';
			$result = $this->db->query($query,array($tag));
			if( !$result->num_rows() )
				return BAD_REQUEST;
			return $result->row()->tag_name;
		}
	}
?>