<?php
	
	class Tag_Model extends CI_Model {

		private $id;
		private $tag_name;

		function __construct() {
			parent::__construct();
			$this->load->helper("curl_helper");
		}

		// Get the list of all tags from the databse.
		public function getTags($offset,$limit) {

			$result = $this->db->query("SELECT tag_id,tag_name,user_count FROM Tags LIMIT ?,?",array($offset,$limit));

			if($result)
				return $result->result_array();
			else
				// return an empty result array
				return array();
		}

		public function writeUserTags($pairs,$tags) {

			$q = 'INSERT INTO Users_Tags (tag_id, user_id) VALUES '.implode(',', $pairs);
			
			$result = $this->db->query($q);

			if($result) {
				$this->db->query('UPDATE Tags set user_count = user_count + 1 WHERE tag_id IN ('.implode(',', $tags).')');
				return true;
			}

			else {

				return false;
			}
		}

		public function getQuestionsForTagSolr($tag, $offset)
		{
			// $q = "SELECT Questions.question_id, title, Questions.created_on, question_content, answer_count FROM Tags_Questions INNER JOIN Questions on Questions.question_id=Tags_Questions.question_id INNER JOIN Tags on Tags_Questions.tag_id = Tags.tag_id WHERE Tags.tag_id=? ORDER BY Questions.created_on DESC LIMIT 10";
			// $result = $this->db->query($q, array($tag));
			// if(!$result) {
			// 	return $this->error();
			// }
			return curlFetchArray(SOLR_URL."q=id_list%3A".$tag."&sort=last_modified+desc&start=".$offset."&rows=10&wt=json");
		}

		public function getFollowers($tagid) {
			$q = "SELECT user_count FROM Tags WHERE tag_id=?";
			$result = $this->db->query($q, array($tagid));

			return $result->row()->user_count;
		}

		public function getFollowing($tag, $userid)
		{
			$result = $this->db->query("SELECT * FROM Users_Tags WHERE user_id=? AND tag_id=?", array($userid, $tag));

			if($result->num_rows())
				return true;
			else
				return false;
		}

		public function unfollowTag($tag, $userid)
		{
			//$tagid = $this->db->query("SELECT tag_id FROM Tags WHERE tag_id=?", array($tag));
			$result = $this->db->query("DELETE FROM Users_Tags WHERE user_id=? AND tag_id=?",
				array($userid, $tag));
			$this->db->query('UPDATE Tags SET user_count = user_count-1 WHERE tag_id=?',array($tag));
		}

		public function followTag($tag, $userid)
		{
			$tagid = $this->db->query("SELECT tag_id FROM Tags WHERE tag_id=?", array($tag));
			$result = $this->db->query("INSERT INTO Users_Tags(user_id, tag_id) VALUES (?,?)",
				array($userid, $tagid->row()->tag_id));
			$this->db->query("UPDATE Tags set user_count=user_count+1 where tag_id=?",array($tag));
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
			$query = 'SELECT Tags.tag_id,Tags.tag_name,Tags.user_count from Users INNER JOIN Users_Tags on Users.user_id= Users_Tags.user_id INNER JOIN Tags on Tags.tag_id = Users_Tags.tag_id where Users.user_id=?
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

		// Function to query SOLR and get tags for recent questions
		public function getTagsForRecentsFromSolr($questions) {
			$idList = array();
			foreach($questions as $id => $tuple) {
				$idList[] = $id; 
			}
			$qp = implode("+OR+id%3A", $idList);
			$q = SOLR_URL."q=id%3A".$qp."&sort=last_modified+desc&fl=tag_names%2C+id%2C+id_list&wt=json&rows=2000";
			return curlFetchArray($q);
		}
	}
?>