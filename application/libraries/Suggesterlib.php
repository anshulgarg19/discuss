<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suggesterlib
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
        $this->ci->load->helper('curl_helper');
	}

	public function getSuggestions($data) {
		$response = curlFetchArray(SOLR_SUGGEST_URL.$data)->suggest->mySuggester->$data;
		if($response->numFound) {
			$retval = array("query" => $data, "suggestions" => array());
			foreach($response->suggestions as $suggestion) {
				$retval["suggestions"][] = array("value" => $suggestion->term, "data" => $suggestion->weight);
			}
			return $retval;
		}
		else
			return array("query" => $data, "suggestions" => array());
	}

	public function getTaggingSuggestions($data) {
		$response = curlFetchArray(SOLR_SUGGEST_URL.$data)->suggest->mySuggester->$data;
		if($response->numFound) {
			$retval = array();
			foreach($response->suggestions as $suggestion) {
				$retval[] = array("text" => $suggestion->term, "id" => $suggestion->term);
			}
			return $retval;
		}
		else
			return array();
	}

}

/* End of file Suggesterlib.php */
/* Location: ./application/libraries/Suggesterlib.php */
