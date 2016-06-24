<?php
	
	class Tag_Model extends CI_Model {

		private $id;
		private $tag_name;

		function __construct() {
			parent::__construct();
		}

		// Get the list of all tags from the databse.
		public function getTags() {

			$result = $this->db->query("SELECT * FROM tag");

			if($result)
				return $result->result_array();
			else
				// return an empty result array
				return array();
		}

		public function writeUserTags($pairs) {

			$q = 'INSERT INTO user_tag (tag_id, u_id) VALUES '.implode(',', $pairs);
			
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
	}
?>