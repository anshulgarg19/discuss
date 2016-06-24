<?php
defined('BASEPATH') or exit('No direct scripts allowed');

class Userfactory{
	private $_ci;

	function __construct(){
		$this->_ci =& get_instance();
		$this->_ci->load->model("User_model");
	}

	//method to fetch user profile
	public function getUser($user_id){

		$query = $this->_ci->db->get_where("user_profile",array("u_id"=>$user_id));
		//var_dump($query->row());
		$data = $query->row();

		return $this->createUserObject($data);
	}

	//library method to set user credetials after successful regitration
	public function setUser($data,$activation_key){
		$query = 'insert into user_profile(user_firstname,user_lastname,phone_num,email_id,reset_link,password) values(?,?,?,?,?,?)';
		$this->_ci->db->query($query, array($data['fname'],$data['lname'],$data['phone_num'],$data['email'],$activation_key,sha1($data['password'])));
	}

	//library method to activate profile
	public function activateProfile(){
		//var_dump($_GET);
		$user_object = new User_Model();
		$response = $user_object->_setActivated();
		return $response;
	}

	public function verifyLogin($userdata) {

		$q = "SELECT u_id, user_firstname FROM user_profile WHERE email_id=? AND password=?";
		$result = $this->_ci->db->query($q, array($userdata['email'], sha1($userdata['password'])));

		foreach($result->result_array() as $row) {

			var_dump($row);
			$_SESSION['u_id'] = $row['u_id'];
			$_SESSION['firstname'] = $row['user_firstname'];
		}

		if ($result->num_rows() < 1)
			return false;

		$result->free_result();
		return true;
	}

	public function createUserObject( $data ){
		$user_object = new User_Model();
		$user_object->_setId($data->u_id);
		$user_object->_setFirstname($data->user_firstname);
		$user_object->_setLastname($data->user_lastname);
		$user_object->_setEmail($data->email_id);
		$user_object->_setPhone($data->phone_num);
		$user_object->_setProfilePicUrl($data->profile_pic);
		return $user_object;
	}
};
?>