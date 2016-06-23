<?php
defined('BASEPATH') or exit('No direct scripts allowed');

class Userfactory{
	private $_ci;

	function __construct(){
		$this->_ci =& get_instance();
		$this->_ci->load->model("User_model");
	}

	public function setUser($data){
		$query = 'insert into user_profile(user_firstname,user_lastname,phone_num,email_id,password) values(?,?,?,?,?)';
		$this->_ci->db->query($query, array($data['fname'],$data['lname'],$data['phone_num'],$data['email'],sha1($data['password'])));
	}


	public function verifyLogin($userdata) {

		$q = "SELECT u_id, user_firstname FROM user_profile WHERE email_id=? AND password=?";
		$result = $this->_ci->db->query($q, array($userdata['email'], sha1($userdata['password'])));

		foreach($result->result_array() as $row) {

			var_dump($row);
			$_SESSION['id'] = $row['u_id'];
			$_SESSION['firstname'] = $row['user_firstname'];
		}

		if ($result->num_rows() < 1)
			return false;

		$result->free_result();
		return true;
	}
};
?>