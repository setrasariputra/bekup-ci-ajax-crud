<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends CI_Controller {

	function __Construct()
	{
		parent::__Construct();
		$this->load->model('template_default');
	}	

	public function index()
	{
		$this->load->view('todo');
	}
}
