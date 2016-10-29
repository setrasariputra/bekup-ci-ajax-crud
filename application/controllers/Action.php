<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {

	function __Construct()
	{
		parent::__Construct();
		$this->load->library('filter');
		$this->load->model('crud');
	}

	function get_CSRF_token()
	{
		$this->crud->GetCSRFToken();
	}
	
	function todo()
	{
		$this->filter->FilterAjaxRequest();
		$this->load->model('todo/todo_model'); 
		$uri3=$this->filter->FilterInput($this->uri->segment(3));
		switch($uri3) {
			case 'tabledata' :
			$this->todo_model->Tabledata();
			break;
			
			case 'insert' :
			$this->todo_model->Insert();
			break;
			 
			case 'delete' :
			$this->todo_model->Delete();
			break;			
			
			case 'update' :
			$this->todo_model->Update();
			break;

			case 'form_insert' :
			$this->todo_model->FormInsert();
			break;
			
			case 'form_update' :
			$this->todo_model->FormUpdate();
			break;			
		}
	}
}
?>