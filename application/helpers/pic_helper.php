<?php
function getfileconfigurations(){
	$CI =& get_instance();

	$fileconfig['upload_path'] 			= $CI->config->item('upload_path');
    $fileconfig['allowed_types']        = $CI->config->item('allowed_types');
    $fileconfig['max_size']             = $CI->config->item('max_size');
    $fileconfig['max_width']            = $CI->config->item('max_width');
    $fileconfig['max_height']           = $CI->config->item('max_height');
    $fileconfig['overwrite']			= $CI->config->item('overwrite');
    return $fileconfig;
}
?>