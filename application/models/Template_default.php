<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Template_default extends CI_Model {
	
	function __Construct()
	{
		parent::__Construct();
	}

	function AjaxLoader()
	{
		?>
		<div id="ajax-loader">Please wait...</div>
		<?php
	}

	function HeadDefault()
	{
		?>
		<!-- Start Jquery -->
		<script type="text/javascript" src="<?php echo base_url();?>assets/plugin/jquery-ui/external/jquery/jquery.js" language="javascript"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/plugin/jquery-ui/external/jquery/jquery-migrate.js" language="javascript"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/plugin/jquery-ui/jquery-ui.js" language="javascript"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugin/jquery-ui/jquery-ui.css" />

		<!-- Start Bootstrap -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugin/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugin/bootstrap/css/bootstrap-theme.min.css" />
		<script type="text/javascript" src="<?php echo base_url();?>assets/plugin/bootstrap/js/bootstrap.min.js" language="javascript"></script>

		<!-- Start My Style -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css" />
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/general.js" language="javascript"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/dialog.js" language="javascript"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/load_dialog.js" language="javascript"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/form_submit.js" language="javascript"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/delete.js" language="javascript"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/paging.js" language="javascript"></script>				
		<?php
	}
}