<?php
	
	//helper function to validate phone number
	function validate_phonenumber($input_text){
		if(preg_match("/^[0-9]{10}$/", $input_text)) {
		  	return true;
		}
		return false;
	}

	//helper function to validate email
	function validate_email($input_text){
		$atpos = strpos($input_text,'@');
		$dotpos = strrpos($input_text, '.');
		if ( $atpos<1 || $dotpos < $atpos+2 || $dotpos+2>= strlen($input_text) ) {
	        return false;
	    }
	    return true;
	}

	//helper function to validate password
	function validate_password($input_text){
		$length = strlen($input_text);
		if( $length < 6 || $length > 20 )
			return false;
		return true;
	}

	function action_invalid_user(){
		http_response_code(400);
		echo "Not logged in";
		die();
	}


?>