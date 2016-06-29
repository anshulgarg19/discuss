<?php 
	
	function redirection() {

		$CI =& get_instance();
		$CI->load->library('session');
		$CI->load->model('Tag_model');
		$CI->load->helper('url');

		if ((new Tag_Model())->isFollowingTags($_SESSION['user_id'])) {
			redirect("/userhome", 'location');
		}
		else {
			redirect("/followtags", 'location');
		}
	}
?>