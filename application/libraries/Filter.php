<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filter
{						
	function FilterAjaxRequest()
	{
		$CI =& get_instance();
		if($CI->input->is_ajax_request()) {
			return true;
		}else{
			echo 'Invalid user access...';
			exit();
		}		
	}	

	function FilterInput($data)
	{
		$data=trim(strip_tags($data));
		return $data;
	}

}

?>