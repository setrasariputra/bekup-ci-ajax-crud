<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function CreateToken()
	{
		?>
		<input type="hidden" class="csrf-token" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
		<?php
	}

	function GetCSRFToken()
	{
		$output = array('output' => 'false');

		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);	

		$output = $csrf;	

		echo json_encode($output);
	}

	function EmptyValidation($arrayvalues)
	{
		$msg=false;
		
		foreach($arrayvalues as $key => $value) {
			if($value == '') {
				$msg.=ucwords($key).' ';
			}
		}
		
		if(!empty($msg)) {
			$msg=trim($msg);
		}
		
		$msg=str_replace(' ',', ',$msg);
		$msg=ucwords(str_replace('_',' ',$msg));
		$msg=str_replace(' Id','',$msg);
		$msg=str_replace('Of','of',$msg);		
				
		return $msg;		
	}

	function DuplicateValidation($table,$arraywhere)
	{
		$msg=false;
		
		foreach($arraywhere as $key => $val) {
			$this->db->where($key,$val);
		}
		$query=$this->db->get($table);
		
		if($query->num_rows() > 0) {
			$msg=$key;
		}
		
		return $msg;
	}	
		
	function InsertDefault($table,$arrayvalues)
	{
		$output = false;

		$query=$this->db->insert($table,$arrayvalues);
		if($query) {
			$output = true;			
		}

		return $output;
	}
		
	function DeleteDefault($table,$arraywhere)
	{	
		$output = false;

		if(!empty($arraywhere)) {
			$querycheck=$this->db->get_where($table,$arraywhere);
			$numcheck=$querycheck->num_rows();
			if(!empty($numcheck)) {
				foreach($arraywhere as $key => $val) {
					$this->db->where($key,$val);
				}
				$query=$this->db->delete($table);
				if($query) {
					$output = true;			
				}
			}
		}

		return $output;
	}
	
	function UpdateDefault($table,$arrayvalues,$arraywhere)
	{	
		$output = false;

		if(!empty($arraywhere)) {
			$querycheck=$this->db->get_where($table,$arraywhere);
			$numcheck=$querycheck->num_rows();
			if(!empty($numcheck)) {
				foreach($arraywhere as $key => $val) {
					$this->db->where($key,$val);
				}
				$query=$this->db->update($table,$arrayvalues);
				if($query) {
					$output = true;			
				}				
			}
		}

		return $output;
	}	

}
?>