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
		
		//$obj = $this->_ci->db->prepare($query);

		//$obj->bind_param('ssiss',$data['fname'],$data['lname'],$data['phone_num'],$data['email'],sha1($data['password']));
		$this->_ci->db->query($query, array($data['fname'],$data['lname'],$data['phone_num'],$data['email'],sha1($data['password'])));
	}
};
?>