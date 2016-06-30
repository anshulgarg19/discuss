<?php
defined('BASEPATH') or exit('No direct access to script allowed');

//Function to get email configurations
function getemailconfiguration(){
	$CI =& get_instance();
	$emailconfig = array();
	$emailconfig['protocol'] = $CI->config->item('protocol');
    $emailconfig['smtp_host'] = $CI->config->item('smtp_host');
    $emailconfig['smtp_port'] = $CI->config->item('smtp_port');
    $emailconfig['smtp_user'] = $CI->config->item('smtp_user');
    $emailconfig['smtp_pass'] = $CI->config->item('smtp_pass');
    $emailconfig['mailtype'] = $CI->config->item('mailtype');
    $emailconfig['charset'] = $CI->config->item('charset');
    $emailconfig['newline'] = $CI->config->item('newline');

    return $emailconfig;
}

//Function to send email
function sendmail($data){
	$emailconfig = getemailconfiguration();
	$CI =& get_instance();
	$CI->load->library('email',$emailconfig);
	$CI->email->from(EMAIL_FROM);
    $CI->email->to($data['to']);

    $CI->email->subject($data['subject']);
    $CI->email->message($data['message']);  

    $CI->email->send();

    echo $CI->email->print_debugger();
}

?>