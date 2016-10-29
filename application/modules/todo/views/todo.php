<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to my Task</title>
	<?php echo $this->template_default->HeadDefault();?>
	
	<script type="text/javascript">
		function dialogSetting()
		{
			dialogResponsive("form-insert-todo",400,250);
			dialogResponsive("form-update-todo",400,250);
		}
		$(document).ready(dialogSetting);
		$(window).resize(dialogSetting)		
	</script>			
								
	<script type="text/javascript">
		$(document).ready(function() {
			$("#ajax-loader").show();
			$("#todo-tabledata").load('<?php echo site_url('action/todo/tabledata');?>/0/0/0/'+Math.random(), function() {
				$("#todo").hide();
				$("#todo").fadeIn('medium');

				var maxpaging=$(".max-paging-todo").val();
				$(".display-max-paging-todo").html(maxpaging);
	
				$("#ajax-loader").hide();
				$("input[type='submit']").attr("disabled",false);
				$("input[type='button']").attr("disabled",false);					
			});	
			$(".default-number-paging").val('0');
		});	
	</script>		

</head>
<body>
	<?php echo $this->template_default->AjaxLoader();?>

	<input type="hidden" id="sort" value="asc" />
	<input type="hidden" id="sort-field-todo" />
	<input type="hidden" id="sort-todo" />
	<input type="hidden" id="number-paging-todo" class="default-number-paging" value="0" />

	<div id="form-insert-todo" title="Form Insert Todo" style="display:none;">
		<div class="form-insert-todo"></div>
	</div>	
	<div id="form-update-todo" title="Form Update Todo" style="display:none;">
		<div class="form-update-todo"></div>
	</div>	


<div id="container">
	<div id="body">
		<h3>Welcome to my Task!</h3>
		<table width="100%" border="0">
			<tr>
				<td width="80%"><input type="button" name="button" class="btn btn-primary btn-sm load-dialog" id="form-insert-todo##<?php echo site_url("action/todo/form_insert")?>##form-insert-todo" value="Add Task" /></td>
				<td width="" align="right"><div class="paging" lang="none" name="prev##<?php echo site_url('action/todo/tabledata');?>##todo-tabledata##sort-field-todo##sort-todo##number-paging-todo##display-number-paging-todo##max-paging-todo">prev</div></td>
				<td align="center"><b class="display-number-paging-todo">1</b> of <b class="display-max-paging-todo">0</b></td>
				<td width="" align="left"><div class="paging" lang="none" name="next##<?php echo site_url('action/todo/tabledata');?>##todo-tabledata##sort-field-todo##sort-todo##number-paging-todo##display-number-paging-todo##max-paging-todo">next</div></td>
			</tr>
		</table>	
		<br />
		<div id="todo-tabledata"></div>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>